
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> All Users
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
                                    <th>Nama</th>
                                    <th>No. Handphone</th>
                                    <th>Kecamatan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ((array)$kepala_keamanan as $user): ?>                   
                                <tr>
                                    <td><?php echo $user['nama_user'] ?></td>
                                    <td><?php echo $user['telpon_user']; ?></td>
                                    <td><?php echo $user['kecamatan_user']; ?></td>

                                    <td>
                                        <?php if ($user['status_aktif_user'] == 0): ?>
                                            <div class="label label-table label-danger">Inactive</div>
                                        <?php else: ?>
                                            <div class="label label-table label-success">Active</div>
                                        <?php endif ?>
                                    </td>
                                    <td class="text-nowrap">
                                    <a href="<?php echo base_url('admin/kepala_keamanan/update/'.$user['id_user']) ?>"><button type="button" class="btn btn-info btn-circle btn-xs" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></button></a>
                                        <?php if ($user['status_aktif_user'] == 1): ?>    
                                        <a href="<?php echo base_url('admin/kepala_keamanan/deactive/'.$user['id_user']) ?>" data-toggle="tooltip" data-original-title="Deactive"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
                                                                                     <?php else: ?>
                                        <a href="<?php echo base_url('admin/kepala_keamanan/active/'.$user['id_user']) ?>" data-toggle="tooltip" data-original-title="Activate"><button type="button" class="btn btn-success btn-circle btn-xs"><i class="fa fa-check"></i></button></a>
                                                                                <?php endif ?>
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