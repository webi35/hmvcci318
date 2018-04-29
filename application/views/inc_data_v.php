<div class="col-md-12">
	<div class="row">

    <div class="col-md-12">
			<div class="form-group">
				<?php echo form_open_multipart($ctl.'/save', array('id' => 'form_data')); ?>
			</div>
		</div>

    <div class="col-md-12">
			<div class="form-group">
				<?php echo form_input(['name' => 'user_firstname', 'placeholder' => 'Nama']); ?>
				<?php echo form_error('user_firstname'); ?>
			</div>
		</div>

    <div class="col-md-12">
			<div class="form-group">
        <?php echo form_close(); ?>
			</div>
		</div>

  </div>
</div>
<script type="text/javascript">

formid = 'form_data';
$( "#other" ).click(function() {
  $( "#"+formid ).submit();
});

</script>
