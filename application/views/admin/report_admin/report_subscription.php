    <!-- Start Page Content -->
    
    <div class="row">
        <div class="col-lg-12">

        <div class="white-box">
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> Daftar semua transaksi akun premium
				</div>
                <div class="panel-body table-responsive">
				
				 <?php $msg = $this->session->flashdata('msg'); ?>
            <?php if (isset($msg)): ?>
                <div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>

            <?php $error_msg = $this->session->flashdata('error_msg'); ?>
            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>
							<table id="tableKomentar" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Nama User</th>
                                    <th>No. Telp</th>
                                    <th>Tanggal transaksi</th>
                                    <th>Total transaksi</th>  
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ((array)$data_transaksi as $t): ?>                   
                                <tr>
                                    <td><?php echo $t['id_order'] ?></td>
                                    <td><?php echo $t['nama_user'] ?></td>
                                    <td><?php echo $t['telpon_user']?></td>
                                    <td><?php echo $t['order_date']; ?></td>
                                    <td><?php echo $t['order_ammount']; ?></td>
                                </tr>

                            <?php endforeach ?>

                            </tbody>


                        </table>
                </div>
					
					
            </div>
        </div>
    </div>

 </div>

 <script>
     $(document).ready(function() {
        $('#tableKomentar').DataTable( {
            "order": [[ 4, "desc" ]]
        } );
    } );
    $(".sa").click(function(){
        var id_komentar=$(this).attr('tag');
        swal({   
            title: "Apakah anda yakin ingin menghapus komentar ini",      
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Ya",   
            cancelButtonText: "Tidak",   
            closeOnConfirm: false,   
            closeOnCancel: false 
        }, function(isConfirm){     
            if (isConfirm) {
                window.location.href = "<?php echo site_url('admin/komentar/delete/');?>"+id_komentar;
            } else {     
                swal("Cancelled", "Komentar batal untuk dihapus", "error");   
            } 
        });
    });

 </script>
    <!-- End Page Content -->