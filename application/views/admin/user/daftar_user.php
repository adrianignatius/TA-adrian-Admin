
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
                                    <th>Tipe akun</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ((array)$users as $user): ?>                   
                                <tr>
                                    <td><?php echo $user['nama_user'] ?></td>
                                    <td><?php echo $user['telpon_user']; ?></td>
                                    <td>
                                        <?php if ($user['status_user'] == 0): ?>
                                            <div class="label label-table label-success">Free Account</div>
                                        <?php else: ?>
                                            <div class="label label-table label-info">Premium Account</div>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?php if ($user['status_aktif_user'] == 0): ?>
                                            <div class="label label-table label-danger">Inactive</div>
                                        <?php elseif($user['status_aktif_user']==99): ?>
                                            <div class="label label-table label-warning">Pending</div>  
                                        <?php else: ?>
                                            <div class="label label-table label-success">Active</div>
                                        <?php endif ?>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="btn-group">
                                        <?php if ($user['status_aktif_user'] == 1): ?>    
                                        <a href="<?php echo base_url('admin/user/deactive/'.$user['id_user']) ?>" data-toggle="tooltip" data-original-title="Deactive"><button style="min-width:80px;max-width:80px;" type="button" class="btn-sm btn-danger ">Deactive</button></a>
                                        <?php elseif($user['status_aktif_user']==99): ?>
                                            <a href="<?php echo base_url('admin/user/accept/'.$user['id_user']) ?>" data-toggle="tooltip" data-original-title="Accept"><button style="min-width:80px;max-width:80px;" type="button" class="btn-sm btn-success">Accept</button></a>
                                        <?php else: ?>
                                        <a href="<?php echo base_url('admin/user/active/'.$user['id_user']) ?>" data-toggle="tooltip" data-original-title="Activate"><button style="min-width:80px;max-width:80px;" type="button" class="btn-sm btn-success">Activate</button></a>
                                                                                <?php endif ?>
                                        </div>
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