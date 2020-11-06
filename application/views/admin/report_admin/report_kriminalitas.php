
    <!-- Start Page Content -->
    <link rel="stylesheet" href="../Leaflet.markercluster-1.4.1/dist/leaflet.css">
<link rel="stylesheet" href="../Leaflet.markercluster-1.4.1/dist/MarkerCluster.css">
<link rel="stylesheet" href="../Leaflet.markercluster-1.4.1/dist/MarkerCluster.Default.css">
<link rel="stylesheet" href="../Leaflet.markercluster-1.4.1/dist/leaflet.draw.css">
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="../optimum/js/sensecode-map.js"></script>
<script src="../Leaflet.markercluster-1.4.1/dist/leaflet-src.js"></script>
<script src="../Leaflet.markercluster-1.4.1/dist/leaflet.markercluster-src.js"></script>
<script src="../Leaflet.markercluster-1.4.1/dist/leaflet.draw.js"></script>
<script src="../Leaflet.markercluster-1.4.1/dist/leaflet.rrose-src.js"></script>
    <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-lg-6 col-xs-12">
                        <div class="white-box">
                            <div id="chartKejadian" style="height: 300px; width: 100%;"></div>
                        </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xs-12">
                        <div class="white-box">
                            <div id="chartKecamatan" style="height: 300px; width: 100%;"></div>
                        </div>
                </div>
                
            </div>
    </div>
    
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <h1>Visualisasi Data Laporan Per Kecamatan</h1>
                <div style="height:70vh" id="mapdiv">
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Content -->
<script>
    var data_kejadian=<?php echo json_encode($data_kejadian);?>;
    var dataKejadianForChart=[];
    data_kejadian.forEach(function(obj){
        dataKejadianForChart.push({y:obj.jumlah_laporan,label:obj.nama_kategori});
    });
    var data_chart=<?php echo json_encode($data_chart);?>;
    var dataChartKecamatan=[];
    data_chart.forEach(function(obj){
        dataChartKecamatan.push({y:obj.jumlah_laporan,label:obj.nama_kecamatan});
    });

    var chart = new CanvasJS.Chart("chartKejadian", {
            title:{
                text: "Jumlah Laporan Kriminalitas Per Kejadian"              
            },
            data: [{
                type: "doughnut",
                dataPoints: dataKejadianForChart
            }]
    });
    var chart_kecamatan = new CanvasJS.Chart("chartKecamatan", {
        title:{
            text: "5 Kecamatan dengan jumlah laporan terbanyak"              
        },
        data: [{
            type: "pie",
            dataPoints: dataChartKecamatan
        }]
    });    
    chart.render();
    chart_kecamatan.render();
    var marker=<?php echo json_encode($marker);?>;
    var kecamatan=<?php echo json_encode($data_kecamatan);?>;
    var max=<?php echo $max_laporan;?>;
    var data={};
    kecamatan.forEach(function(obj) { 
        var percentage=obj.jumlah_laporan/max;
        data[obj.nama_kecamatan]=percentage;
        });
    var temp = prepareDataforMarker(marker);
    let senseMap = new SensecodeMap();
    senseMap.initMap("mapdiv");
    senseMap.addClusterGroup({
        "iconCreateFunction" : function(cluster){
            let childMarkers = cluster.getAllChildMarkers();
            if (senseMap.checkMarkerSeparate(childMarkers)) {
                return L.divIcon({
                    html     : "<div class='cluster-inner'><div>" + cluster.getChildCount() + "</div></div>",
                    className: 'cluster-container',
                    iconSize : L.point(20, 20)
                });
            } 
        }
    });
senseMap.addAllMarkers(temp);
function prepareDataforMarker(data) {
  let targetData = ("data" in data) ? data.data : data;

  let ctrCard = 0;
  targetData.forEach(element => {
   let domIcon = ` <div indexMarker='${ctrCard}'>`;
   domIcon += `<div class="achievement-container">
      </div>`;
  });
  return targetData;
 }
 senseMap.showAdminBoundaryLayer({
      data_kecamatan: data,
      administration_level: 6, 
      city    : "Surabaya",
     });
</script>