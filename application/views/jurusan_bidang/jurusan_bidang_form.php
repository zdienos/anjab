<?php $this->load->view('templates/header');?><!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
     
      <!-- Default box -->
      <div class="box">
      
        <div class="box-body">          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Jurusan bidang <?php echo $button ?></h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            <div class="box-body">
              <div class="row">
              
              
	    <div class="form-group col-md-6">
            <label for="int" class="control-label">Jurusan<?php echo form_error('jurusan_id') ?></label>
            <?php echo cmb_dinamis('jurusan_id','jurusans','nama_jurusan','id',$jurusan_id); ?>
        </div>
	    <div class="form-group col-md-6">
            <label for="varchar" class="control-label">Nama Bidang <?php echo form_error('nama_bidang') ?></label>
            <input type="text" class="form-control" name="nama_bidang" id="nama_bidang" placeholder="Nama Bidang" value="<?php echo $nama_bidang; ?>" />
        </div>
	    <div class="form-group col-md-6">
            <label for="int" class="control-label">Jpendidikan <?php echo form_error('jpendidikan_id') ?></label>
            <?php echo cmb_dinamis('jpendidikan_id','jpendidikans','nama','id',$jpendidikan_id); ?>
        </div></div><div class="box-footer">
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jurusan_bidang') ?>" class="btn btn-default">Cancel</a>
	

              
            </div>
            </div>
            <!-- /.box-body -->
            </form>
          
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<?php $this->load->view('templates/footer');?>