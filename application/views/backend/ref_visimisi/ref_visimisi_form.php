<section class="content-header">
      <h1>
        Visi dan Misi
        <small>Kabupaten Donggala</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
</section>

    <!-- Main content -->
<section class="content container-fluid">

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Input Visi dan Misi</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="visimisi">Visi dan Misi <?php echo form_error('visimisi') ?></label>
            <textarea class="form-control" rows="20" name="visimisi" id="visimisi" placeholder="Visimisi"><?php echo $visimisi; ?></textarea>
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	</form>
