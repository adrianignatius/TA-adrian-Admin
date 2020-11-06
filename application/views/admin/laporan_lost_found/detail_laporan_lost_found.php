  <!-- .row -->
  <div class="row">
                  <div class="col-md-12">
                     <div class="white-box">
                        <div class="row align-items-center justify-content-center m-b-30">
                            <img class="img-fluid" src="http://adrian-webservice.ta-istts.com/public/uploads/<?php echo $laporan["thumbnail_gambar"]?>"/>
                        </div>
                        <h2 class="font-bold m-t-20">Judul Laporan</h2>
                        <h3><?php echo $laporan["judul_laporan"]?></h3>
                        <h2 class="font-bold m-t-20">Jenis Laporan</h2>
                        <h3><?php 
                           if($laporan["jenis_laporan"]==1){
                               echo "Penemuan Barang";
                           }else{
                               echo "Kehilangan Barang";
                           }
                            ?></h3>
                        <h2 class="font-bold m-t-20">Jenis Barang</h2>
                        <h3><?php echo $laporan["jenis_barang"]?></h3>
                        <h2 class="font-bold m-t-20">Tanggal Laporan</h2>
                        <h3><?php 
                            setlocale (LC_TIME, 'id_ID');
                            $date = strftime( "%d %B %Y", strtotime($laporan["tanggal_laporan"]));
                            echo $date;
                        ?> Pukul <?php echo $laporan["waktu_laporan"]?></h3>
                        <h2 class="font-bold m-t-20">Lokasi Laporan</h2>
                        <h3><?php echo $laporan["alamat_laporan"]?> (Kecamatan: <?php echo $laporan["kecamatan"]?> )</h3>
                        <h2 class="font-bold m-t-20">Deskripsi Laporan</h2>
                        <h3><?php echo $laporan["deskripsi_barang"]?></h3>
                        <div class="row button-box">
                            <div class="col-lg-6 col-xs-12">
                            <button tag="1" id="btnverif" value=<?php echo $laporan["id_laporan"];?> type="button" class="btn btn-block btn-success sa-params">Verifikasi</button>
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <a><button tag="0" class="btn btn-block btn-danger sa-params">Tolak</button></a>
                            </div>
                        </div>
                     </div>
                    
                  </div>
               </div>
               <!-- .row -->
<script>
    $('.sa-params').click(function(event){
        var tag=$(this).attr('tag');
        var jenis_konfirmasi=tag==0 ? "Menolak Laporan" : "Memverifikasi Laporan";
        swal({   
            title: "Apakah anda yakin ingin "+jenis_konfirmasi+"?",      
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Ya",   
            cancelButtonText: "Tidak",   
            closeOnConfirm: false,   
            closeOnCancel: false 
        }, function(isConfirm){     
            if (isConfirm) {
                var id_laporan=$("#btnverif").attr("value");
                if(tag==1){
                    window.location.href = "<?php echo site_url('admin/Laporan_lost_found/verifikasiLaporan/'.$laporan["id_laporan"]);?>";
                }else{
                    window.location.href = "<?php echo site_url('admin/Laporan_lost_found/declineLaporan/'.$laporan["id_laporan"]);?>";
                }
            } else {     
                swal("Cancelled", "Laporan batal diverifikasi", "error");   
            } 
        });
    });
</script>