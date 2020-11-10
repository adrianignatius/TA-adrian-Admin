
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> Laporan Kriminalitas belum terverifikasi
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
							<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Judul Laporan</th>
                                    <th>Jenis Kejadian</th>
                                    <th>Tanggal Laporan</th>
                                    
                                    <th>Kecamatan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ((array)$laporan_kriminalitas as $laporan  ): ?>                   
                                <tr>
                                    <td><?php echo $laporan['judul_laporan'] ?></td>
                                    <td><?php echo $laporan['jenis_kejadian']; ?></td>
                                    <td><?php echo $laporan['tanggal_laporan']. "Pukul ". $laporan["waktu_laporan"]; ?></td> 
                                    <td><?php echo $laporan['kecamatan']; ?></td>
                                    <td class="text-nowrap">
                                        <a href="<?php echo base_url('admin/laporan_kriminalitas/detail/'.$laporan['id_laporan']) ?>"><button type="button" class="btn-sm btn-success">Lihat Detail</button></a>
                                    </td>
                                </tr>

                            <?php endforeach ?>

                            </tbody>


                        </table>
                    </div>
					
					
            </div>
        </div>
    </div>

 </div>

    <!-- End Page Content -->