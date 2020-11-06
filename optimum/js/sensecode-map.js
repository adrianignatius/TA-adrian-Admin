
class SensecodeMap{
    constructor(){
        let isCoverageAlwaysTrue = true;
        this.map = null;
        let currObject = this;
        SensecodeMap.isProduction = false;
        SensecodeMap.configObject = {
            animateAddingMarkers : false,
            animate: true,
            spiderfyOnMaxZoom: false,
            showCoverageOnHover: !isCoverageAlwaysTrue, // turn this on if show coverage is off
            chunkedLoading: true, 
            chunkInterval: 200, // Default 200
            chunkDelay: 50, // Default 50
            chunkProgress: (processed, total, elapsed, layersArray) => {
                currObject.updateProgressBar(processed, total, elapsed, layersArray, currObject.map);
            },
            disableClusteringAtZoom: 18,
            maxClusterRadius: function (zoom) { // Default 80
                // return (zoom <= 16) ? 100: 1;
                return (zoom <= 5) ? 100: (zoom<=10) ? 85 : (zoom<=15) ? 75 : (zoom <= 17) ? 65 : 1; // radius in pixels
                return (zoom <= 14) ? 100: (zoom<=28) ? 80 : (zoom<=28) ? 80 : (zoom <= 50) ? 70 : (zoom<=80) ? 60 : 1; // radius in pixels
                return (zoom <= 14) ? 40 : 1; // radius in pixels
            },
            iconCreateFunction: function(cluster) {
                    return ("iconCreateFunction" in args) ? args.iconCreateFunction(cluster) : 
                    L.divIcon({
                        html: "<div class='cluster-inner'><div>" + cluster.getChildCount() + "</div></div>",
                        className: 'cluster-container',
                        iconSize: L.point(40, 40)
                    });                
            }
        };

        // Init First Center of Map
        this.centerLatlng = L.latLng(-7.250445, 112.768845);

        this.clusterGroups = [];
        this.coveragesLayer = null;
        this.markersLists  = [];
        this.mergeUnit = true;
        this.tiles = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png?boundary=administrative', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 19,
	        // minZoom    : 1,
	        // maxZoom    : 19
        });
        this.buttons = [];
        this.resetAreaParam();
    }

    initDrawable(){
        this.drawable    = true;
        this.drawnStatus = false;
        // Initialise the FeatureGroup to store editable layers
        this.editableLayers = new L.FeatureGroup();
        this.map.addLayer(this.editableLayers);
        this.drawPluginOptions = {
            position: 'topright',
            draw    : {
                polygon: {
                    allowIntersection: false,   // Restricts shapes to simple polygons
                    drawError        : {
                        color  : '#e1e100',                                        // Color the shape will turn when intersects
                        message: '<strong>Oh snap!<strong> you can\'t draw that!'  // Message that will show when intersect
                    },
                    shapeOptions: {
                        color: '#97009c'
                    }
                },
                // disable toolbar item by setting it to false
                polyline : false,
                circle   : false,   // Turns off this drawing tool
                rectangle: false,
                marker   : false,
            },
            edit: {
                featureGroup: this.editableLayers,   //REQUIRED!!
                remove      : false
            }
        };
        this.drawControl = new L.Control.Draw(this.drawPluginOptions);
        this.map.addControl(this.drawControl);

        this.drawnLayers = [];
        let editableLayers = this.editableLayers;
        let drawnLayers = this.drawnLayers;
        this.map.on('draw:created', function(e) {
            var type = e.layerType,
            layer = e.layer;
            if (type === 'marker') {
                layer.bindPopup('A popup!');
            }
            drawnLayers.push(e.layer);

            editableLayers.addLayer(layer);
        });        
    }

    alwaysShowCoverageOnMainLayer(groupLayer){
        this.coveragesLayer = new L.LayerGroup();
        const currentInstance = this;
        groupLayer.on("animationend", function() {
            currentInstance.coveragesLayer.clearLayers();
            groupLayer._featureGroup.eachLayer(function(layer) {
                if (layer instanceof L.MarkerCluster && layer.getChildCount() > 2) {
                    // groupLayer._showCoverage({ layer: layer });
                    currentInstance.coveragesLayer.addLayer(L.polygon(layer.getConvexHull()));
                }
                currentInstance.coveragesLayer.addTo(currentInstance.map);
            });
        });
    }
    
    createAdminBoundaryLayer(args = {administration_level: 5, muniscipality: null, village: null}){
        this.boundaryLayer = new L.LayerGroup();
        this.map.addLayer(this.boundaryLayer);
        this.adminBoundaryPolygonOri = [];
        this.adminBoundaryPolygonClean = [];
        this.lastAdminBoundaryCity = null;
        this.lastAdminBoundaryLevel = null;
    }

    showAdminBoundaryLayer(args = {data_kecamatan:null, administration_level: 5, city:null , muniscipality: null, village: null, callback: null}){
        if (!('boundaryLayer' in this)) {
            this.createAdminBoundaryLayer(args);
        }
        this.boundaryLayer.clearLayers();

        if( args.city === null ) return;
        if (this.lastAdminBoundaryCity === args.city && this.lastAdminBoundaryLevel === args.administration_level) {
            return this.generateAdminBoundaryLayer(args);
        } 

        this.lastAdminBoundaryCity = args.city;
        this.lastAdminBoundaryLevel = args.administration_level;

        $.getJSON(`../optimum/admin_${args.city}.json`, {},
            ({RECORDS}, _, __) => {
                this.adminBoundaryPolygonOri = RECORDS;
                const {administration_level, muniscipality, village} = args;
                this.adminBoundaryPolygonClean = this.adminBoundaryPolygonOri.filter((location) => {
                    return +location.admin_level == administration_level;
                    if (!muniscipality && !village) return +location.admin_level == administration_level;
                    if (!village) return +location.admin_level == administration_level && location.in_village != village;
                    if (!muniscipality) return +location.admin_level == administration_level && location.in_muniscipality != muniscipality;
                });
                this.adminBoundaryPolygonClean = this.adminBoundaryPolygonClean.map((location)=>{
                    let {SHAPE} = location;
                    if (SHAPE[0] === 'M') {
                        SHAPE = SHAPE.replace(/MULTIPOLYGON/g,"").replace(/\,\s/g, ',').substr(1).slice(0,-1);
                        SHAPE = SHAPE.split(')),((').map((location)=>location.replace('((','')).map((location)=> (location.split(',').map((location)=> [...(location.split(' ').map((longlat)=> parseFloat(longlat)).reverse())])))
                    } else if (SHAPE[0] === 'P') {
                        SHAPE = SHAPE.replace(/POLYGON[\(]+|\)/g,"").replace(/\,\s/g, ',');
                        SHAPE = SHAPE.split(',').map((location)=> [...(location.split(' ').map((longlat)=> parseFloat(longlat)).reverse())]);
                    } else {
                        console.log("Unexpected Value On : " + location.name);
                    }
                    location.SHAPE = SHAPE;
                    return location;
                })
                this.generateAdminBoundaryLayer(args);
            }
        );
    }

    generateAdminBoundaryLayer(args) {
        const {data_kecamatan, administration_level, muniscipality, village} = args;
        let selectedPolygon = null;
        this.adminBoundaryPolygonClean.forEach(location => {
            var opacity = 0.3;
            var isSelected = false;
            if (location.name in data_kecamatan){
                opacity = data_kecamatan[location.name];
                isSelected = true;
            }
            // const  = location.name === muniscipality || location.name === village;
            try {
                const polygonObj = L.polygon(location.SHAPE, {
                    // color: isSelected ? 'red':'black',
                    color: isSelected ? `rgb(${255-((1-opacity)*255)},${255-(opacity*255)}, 0)`:'black',
                    fillOpacity: 0.5,
                    weight: 0.3,
                    className: isSelected ? 'active area':'area'
                });
                if(isSelected){
                    selectedPolygon = polygonObj;
                }
                this.boundaryLayer.addLayer(polygonObj);
                polygonObj.on('click', (e)=>{
                    // console.log({e});
                    // console.log(this);
                    // console.log({location});
                    if (!isSelected) {
                        // alert('Go To '+ location.name + ', admin level :'+ location.admin_level);
                        ( !!args.callback ) && args.callback(location) || console.log(location);
                        this.showAdminBoundaryLayer({...args, muniscipality: location.name, city: location.is_in_city})
                    }
                });
                polygonObj.on('mouseover', (e)=>{
                    if (!isSelected) {
                        polygonObj.setStyle({
                            color: 'green'
                        });
                    }
                });
                polygonObj.on('mouseout', (e)=>{
                    if (!isSelected) {
                        polygonObj.setStyle({
                            color: 'black'
                        });
                    }
                });
            } catch (error) {
                console.log(location);
            }
        });
        !!selectedPolygon && selectedPolygon.bringToFront();
    }
    

    /**
     * Function to add New Button to map
     * @param {object} args you can place many options here
     * possible args
     *      position : string // One of these bottomright, topright, bottomleft, topleft
     *      innerHTML : string // text to be written in button
     *      onClick : function // function to be executed when button is clicked
     *      customClass : string // class for container button
     */
    addNewButtons(args){
        let className = 'sensecode-map-button leaflet-bar leaflet-control leaflet-control-custom leaflet-draw-toolbar leaflet-bar leaflet-draw-toolbar-top' + (('customClass' in args) ? " " + args.customClass : '');
        var newButton = L.Control.extend({        
            options: {
                position: ('position' in args) ? args.position: 'bottomright'  // Default value is bottom right
            },        
            onAdd: function (map) {
                var container           = L.DomUtil.create('div', className);
                    container.style     = ("customStyle" in args) ? args.customStyle : "";
                    container.innerHTML = ('innerHTML' in args) ? args.innerHTML : "New Button"
                    container.onclick   = ('onClick' in args) ? args.onClick : function(){
                    // console.log(innerHTML + " button is clicked");
                    // console.log("Please set your event onClick in args param");
                }
                return container;
            }
        });
        //this.buttons.push(newButton);
        this.map.addControl(new newButton());
    }
    
    clearDrawnLayer(){
        if (this.drawable && this.drawnLayers.length > 0) {
            for (let index = this.drawnLayers.length-1; index >= 0; index--) {
                this.editableLayers.removeLayer(this.drawnLayers[index]);			
            }
        }
    }

    /**
     * function to "Add" more on click option, by default it will set area param and you can only "add" more, not erase this function
     * @param {Function} clickFunction Define your click function(e) you want to Add, if you dont need a variable, just give it null value
     * @param {Boolean} defaultOff Turn this true if you dont want to record area param
     */
    
    addOnClickMap(clickFunction = null , defaultOff = false){
        // Get Area
        let map = this.map;
        if (defaultOff) {
            if (typeof clickFunction != null) { 
                map.on('click', clickFunction(e))
            }
        } else {
            let ob = this;
            map.on('click', function(e) {
                if (e.latlng.lng>ob.areaParam[1]) {ob.areaParam[1] = e.latlng.lng;}
                if (e.latlng.lng<ob.areaParam[3]) {ob.areaParam[3] = e.latlng.lng;}
                if (e.latlng.lat<ob.areaParam[2]) {ob.areaParam[2] = e.latlng.lat;}
                if (e.latlng.lat>ob.areaParam[0]) {ob.areaParam[0] = e.latlng.lat;}
                if (typeof clickFunction != null) { clickFunction(); }
            });
        }
    }
     
    /**
     * function to "Add" function on hover cluster
     * @param {ClusterGroup} clusterGroup Cluster Group You can get from this instance.clusterGroups
     * @param {Function} eventHandler add eventHandler(c) for c is cluster instance
     */
    addOnHoverCluster(clusterGroup, eventHandler){
        clusterGroup.on('clustermouseover', function(c){
            eventHandler(c);
        })
        // Example
        //  function (c) {
        //     return console.log(c);
        //     console.log('cluster ' + a.layer.getAllChildMarkers().length);
        // });
    }
    
    /**
     * function to "Add" function on mouseout cluster
     * @param {ClusterGroup} clusterGroup Cluster Group You can get from this instance.clusterGroups
     * @param {Function} eventHandler add eventHandler(c) for c is cluster instance
     */
    addOnMouseOutCluster(clusterGroup, eventHandler){
        clusterGroup.on('clustermouseout', function(c){
            eventHandler(c);
        });
        // Example
        //  function(c){
        //     return console.log(c);
        //     if (childData.separate) {
        //         map.closePopup();
        //     }
        // })
    }

    /**
     * function to "Add" function on mouseout cluster
     * @param {ClusterGroup} clusterGroup Cluster Group You can get from this instance.clusterGroups
     * @param {Function} eventHandler add eventHandler(c) for c is cluster instance
     */
    addOnMouseClickCluster(clusterGroup, eventHandler){
        let map = this.map;
        clusterGroup.on('clusterclick',function(c){
            map.closePopup();
            if (!childData.separate) {
                let offsetY = -18;
                let domPopup = `<div class='flex flex-ver' style='width:320px;'>
                                    <div class="flex flex-ver" style='border-bottom: 2px solid var(--gray); margin-bottom: 10px;'>
                                        <div class='label' style='font-size:1.25em;'>`+ c.layer._childCount +` Unit</div>`
                                        // <a href='javascript:void(0)' class='my-2' style='font-size:1.25em;'><i class="fa fa-lock"></i> Sign in for more details</a>
                                +`</div>
                                    <div class='map-listing-item-container minimalistScrollbar' style='max-height:188px; overflow-y:auto;'>`;
                childData.listings.reverse();
                childData.listings.forEach(listing => {			
                    domPopup +=			`<div class='flex flex-hor flex-vertical-center flex-separate py-2'>
                                            <div class='squared div-image ratio69' default-image="`+IMAGE_URL+`/assets/img/placeholderimage11.jpg" load-image="`+IMAGE_URL+`/assets/img/listing/`+listing.id_listing+`/1.jpg" style='width:37%;'></div>
                                            <div class="flex flex-ver" style='width:58%;'>
                                                <div>Unit di`+ (listing.jenis_transaksi == "0" ? "jual" : "sewakan") +`</div>
                                                <div class="hoverable truncate" onclick="clickUnit(this);" data-idx="`+listing.indexMarker+`" idx-showed="`+listing.idxShowed+`"><b>`+ listing.judul_listing +`</b></div>
                                                <div>Rp. `+  shortNumber(listing.harga) +`</div>`+
                                                // <div>`+(listing.kamar_tidur != null ? listing.kamar_tidur +` bed. ` : '') + (listing.kamar_mandi != null ? listing.kamar_mandi +` bath. ` : '') + (listing.luas_bangunan != null ? listing.luas_bangunan +` sq.ft.` : '') + `</div>
                                            `</div>
                                        </div>`
                });
                domPopup += 		`</div>
                                </div>`;
                childData.listings.reverse();
                new L.Rrose({ offset: new L.Point(0, offsetY), closeButton: false, autoPan: true, position : "s" })
                            .setContent(domPopup)
                            .setLatLng(c.latlng)
                            .openOn(map);
                checkAllImage()
                // c.originalEvent.preventDefault();
                // map.fitBounds(map.getBounds());
            }
        });
    }

    initMap(mapContainer){
        this.map = L.map(mapContainer, {center: this.centerLatlng, zoom: 15, layers: [this.tiles], drawControl: true});
        //this.turnOnClusterGroup();
    }

    resetAreaParam(){
        this.areaParam = [-90, -180, 90, 180]; // Atas, Kanan, Bawah, Kiri, The value is inverted for searching maximum border
    }

    updateProgressBar(processed, total, elapsed, layersArray){
        if (processed === total) {
            if (total !== 0 && typeof this.map !== 'undefined') {        
                setTimeout(() => {
                    this.map.fitBounds(this.clusterGroups[0].getBounds());
                }, 50);        
            } //else return console.trace();
        }
        if (SensecodeMap.isProduction) return;
        //return console.log("Map Progress Runing",{processed, total, elapsed, layersArray});
        // if (elapsed > 1000) {
        //     // if it takes more than a second to load, display the progress bar:
        //     progress.style.display = 'block';
        //     progressBar.style.width = Math.round(processed/total*100) + '%';
        // }

        // if (processed === total) {
        //     // all markers processed - hide the progress bar:
        //     progress.style.display = 'none';
        // }
    }

    /**
     * Function to add New ClusterGrouping to map
     * @param {object} args you can place many options here
     * possible args
     *      spiderfyOnMaxZoom : bool // Let spiderfy do its job when map reach the max zoom level
     *      animateAddingMarkers : bool // Animation on adding new marker to cluster group
     *      chunkedLoading : bool // Chunked loading for better performance
     */    
    addClusterGroup(args = {}){
        const groupClusterConfig = {
            ...SensecodeMap.configObject,
            ...args
        };

        const markerList   = [];
        const clusterGroup = L.markerClusterGroup(groupClusterConfig);
        this.clusterGroups.push(clusterGroup);
        this.markersLists.push(markerList);
        this.map.addLayer(clusterGroup);
        if (this.clusterGroups.length === 1 && !groupClusterConfig.showCoverageOnHover) {
            this.alwaysShowCoverageOnMainLayer(clusterGroup);
        }
        return {clusterGroup,  markerList};
    }

    /**
     * function to make icon using div structure
     * @param {object} args
     * 
     * ### Possible Args
     * 
     * ------------
     * 
     *      html : string string for dom icon in map 
     *      className : string // add class to cluster container
     *      iconSize : {x : xValue, y : yValue} // icon size in cartesius coordinates
     * 
     */
    createIcon(args, noDefault){
        
        return (noDefault) ? L.divIcon(args) : L.divIcon({
            html: ("html" in args) ? args.html : "<div class='cluster-inner'><div>Testing</div></div>",
            className: 'cluster-container' + ("className" in args) ? " " + args.className : "",
            iconSize: L.point(("iconSize" in args) ? args.iconSize.x : 40, ("iconSize" in args) ? args.iconSize.y : 40)
        });
    }

    /**
     * Check markers if all markers in the same place (same long lat)
     * usually used to check marker inside clusterer
     * @param {array<marker>} childMarkers 
     */
    checkMarkerSeparate(childMarkers){
        let diffPosition = false; let lastPos = null;
        if (this.mergeUnit == false){
            return true;
        }
        for (let index = 0; index < childMarkers.length; index++) {
            let el = childMarkers[index];
            if (lastPos != null && (lastPos.lat != el._latlng.lat || lastPos.lng != el._latlng.lng)) {
                return true;
            }
            lastPos = el._latlng;
        }        
        return diffPosition;
    }

    /**
     * Update merge unit
     *
     */
    updateMergeUnit(status){
        this.mergeUnit = status;
    }

    /**
     * 
     * @param {Array} datas Array of data you want to populate in map, must have lat and lng properties in each data
     * @param {*} args 
     */
    async addAllMarkersOld(datas, args = {}){
        if (!("markerList" in args)) { args.markersList = this.markersLists[0];}
        if (!("groupTargetLayer" in args)) { args.groupTargetLayer = this.clusterGroups[0];}
        
		args.groupTargetLayer.clearLayers();
        //let chunkSize = (getUrlVars()["chunkSize"] !== undefined) ? getUrlVars()["chunkSize"] : 10;
        let chunkSize = ("chunkSize" in args) ? args.chunkSize : 10;
        let chunkCount = datas.length / chunkSize;
        let promises = [];
        let indexes = [];
        for (let index = 0; index < chunkCount; index++) {
            let chunkData = datas.splice(0, chunkSize);
            promises.push((ob)=>{ob.addMarkersOld(chunkData, args)});
            indexes.push({index: index});
        }
        let map = this.map;
        Promise.all(indexes.map(index=>promises[index.index](this))).then(function(){
            map.fitBounds(args.groupTargetLayer.getBounds());
            if ("callbackOnFinish" in args) {
                args.callbackOnFinish();
            }
        });
    }

    addAllMarkers(datas, args = {}){
        if (!("markerList" in args)) { args.markersList = this.markersLists[0];}
        if (!("groupTargetLayer" in args)) { args.groupTargetLayer = this.clusterGroups[0];}
        
		args.groupTargetLayer.clearLayers();
        this.addMarkers(datas, args);
        
        if ("callbackOnFinish" in args) {
            
            args.callbackOnFinish();
        }
    }
    
    addMarkersOld(datas, args = {}){
        datas.forEach(data => {
            if ("additionalData" in data) {
                args.additionalData = data.additionalData;
            }
            if ("icon" in data) {
                args.icon = data.icon;
            }
            this.addMarkerOld(data.lat, data.lng, args);
        });
    }

    addMarkers( datas, args = {} ){
        if (!("markerList" in args)) { args.markersList = this.markersLists[0];}
        if (!("groupTargetLayer" in args)) { args.groupTargetLayer = this.clusterGroups[0];}

        datas.forEach(data => {
            if ("additionalData" in data) {
                args.additionalData = data.additionalData;
            }
            if ("icon" in data) {
                args.icon = data.icon;
            }
            this.addMarker(data.lat, data.lng, args);
        });
        
        args.groupTargetLayer.addLayers(args.markersList);
        
    }

    addMarker(lat, lng, args = {}) {
        if (!("markerList" in args)) { args.markersList = this.markersLists[0];}
        if (!("groupTargetLayer" in args)) { args.groupTargetLayer = this.clusterGroups[0];}
        var m;
        if ("icon" in args) {
            m = L.marker(new L.latLng(lat, lng), {icon : args.icon});
        } else {
            m = L.marker(new L.latLng(lat, lng));
        }

        if ("additionalData" in args) {
            for(let property in args.additionalData) {
                m[property] = args.additionalData[property];
            }
        }

        if ("popupHtml" in args) {
            m.bindPopup(args.popupHtml).openPopup();
        } else {
            // if ( !("defaultPopup" in args) || ( "defaultPopup" in args && args.defaultPopup != false)) {
            //     m.bindPopup("<b>"+args.additionalData.name+"</b>").openPopup(); 
            // }
        }
        args.markersList.push(m);
        
        // args.groupTargetLayer.addLayer(m);
    }
    addMarkerOld(lat, lng, args = {}) {
        if (!("markerList" in args)) { args.markersList = this.markersLists[0];}
        if (!("groupTargetLayer" in args)) { args.groupTargetLayer = this.clusterGroups[0];}
        var m;
        if ("icon" in args) {
            m = L.marker(new L.latLng(lat, lng), {icon : args.icon});
        } else {
            m = L.marker(new L.latLng(lat, lng));
        }

        if ("additionalData" in args) {
            for(let property in args.additionalData) {
                m[property] = args.additionalData[property];
            }
        }

        if ("popupHtml" in args) {
            m.bindPopup(args.popupHtml).openPopup();
        } else {
            if ( !("defaultPopup" in args) || ( "defaultPopup" in args && args.defaultPopup != false)) {
                m.bindPopup("<b>"+args.additionalData.name+"</b>").openPopup(); 
            }
        }
        args.markersList.push(m);
        args.groupTargetLayer.addLayer(m);
    }
}