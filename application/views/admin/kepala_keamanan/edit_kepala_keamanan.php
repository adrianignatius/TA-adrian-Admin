
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
                <div class="panel-heading"> 
                     <i class="fa fa-pencil"></i> &nbsp;Edit Kepala Keamanan<a href="<?php echo base_url('admin/user/all_user_list') ?>" class="btn btn-info btn-sm pull-right"><i class="fa fa-list"></i> All Users </a>

                </div>
                <div class="panel-body table-responsive">
				
				 <?php $error_msg = $this->session->flashdata('error_msg'); ?>
            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">�</span> </button>
                </div>
            <?php endif ?>
			
			
                    <form method="post" action="<?php echo base_url('admin/kepala_keamanan/update/'.$kepala_keamanan["id_user"]) ?>" class="form-horizontal" novalidate>
                       <div class="form-group">
                 	<label class="col-md-12" for="example-text">Nama Lengkap</label>
                    <div class="col-sm-12">
                   <input type="text" name="nama_user" class="form-control" value="<?php echo $kepala_keamanan["nama_user"]; ?>">
                                        </div>
                                    </div>

                          <div class="form-group">
                 	<label class="col-md-12" for="example-text">Kecamatan</label>
                    <div class="col-sm-12">
                      <select class="form-control form-control-line" name="kecamatan_user">

                                                    <?php foreach ($kecamatan as $kn): ?>
                                                        <?php 
                                                            if($kn['id_kecamatan'] == $kepala_keamanan["id_kecamatan_user"]){
                                                                $selec = 'selected';
                                                            }else{
                                                                $selec = '';
                                                            }
                                                        ?>
                                                        <option <?php echo $selec; ?> value="<?php echo $kn['id_kecamatan']; ?>"><?php echo $kn['nama_kecamatan']; ?></option>
                                                    <?php endforeach ?>

                                                </select>
                                        </div>
                                    </div>
										
  <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info btn-rounded btn-sm"> <i class="fa fa-plus"></i>&nbsp;&nbsp;Save</button>
                            </div>
                        </div>
                           
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Page Content -->