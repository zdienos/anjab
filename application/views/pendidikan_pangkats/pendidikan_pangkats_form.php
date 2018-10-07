<?php $this->load->view('templates/header');?><!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
     
      <!-- Default box -->
      <div class="box">
      
        <div class="box-body">          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Pendidikan pangkats <?php echo $button ?></h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            <div class="box-body">
              <div class="row">
              
              
	    <div class="form-group col-md-6">
            <label for="varchar" class="control-label">Jpendidikan <?php echo form_error('jpendidikan_id') ?></label>
            <?php echo cmb_dinamis('jpendidikan_id','jpendidikans','nama','id',$jpendidikan_id); ?>
        </div>
	    <div class="form-group col-md-6">
            <label for="varchar" class="control-label">Golongan <?php echo form_error('golongan_id') ?></label>
            <?php echo cmb_dinamis('golongan_id','golongans','nama_gol','id',$golongan_id); ?>
        </div>
	    <div class="form-group col-md-6">
            <label for="varchar" class="control-label">Ruang Id <?php echo form_error('ruang_id') ?></label>
           <?php echo cmb_dinamis('ruang_id','ruangs','nama_ruang','id',$ruang_id); ?>
        </div>
	    <div class="form-group col-md-6">
            <label for="varchar" class="control-label">Pangkat Id <?php echo form_error('pangkat_id') ?></label>
            <?php echo cmb_dinamis('pangkat_id','pangkats','nama_pangkat','id',$pangkat_id); ?>
        </div></div><div class="box-footer">
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pendidikan_pangkats') ?>" class="btn btn-default">Cancel</a>
	

              
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