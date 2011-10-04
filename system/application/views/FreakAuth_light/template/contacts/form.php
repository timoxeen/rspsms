<?=form_open($this->uri->uri_string(), array('id' => 'contacts_add'))?>
 <?php $attributes = array('for'=>'mobile_no');
 	$attributes_name = array('for'=>'full_name');
 ?>
  <div data-role="fieldcontain">
 <?=form_label($this->lang->line('SMS_mobileno_label').':','',$attributes) ;?>

 <?=form_input(array('name'=>'mobileno', 
				                       'id'=>'mobile_no',
				                       'maxlength'=>'12', 
				                       'size'=>'12',
				                       'type'=>'tel',
 									 'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'mobileno'} : '')
 )); ?>
	  <?=(isset($this->fal_validation) ? $this->fal_validation->{'mobileno'.'_error'} : '')?>				                       
  </div>
  
  <div data-role="fieldcontain">
 <?=form_label($this->lang->line('SMS_fullname_label').':','',$attributes_name) ;?>

 <?=form_input(array('name'=>'full_name', 
				                       'id'=>'full_name',
				                       'maxlength'=>'45', 
				                       'size'=>'45',
 									'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'full_name'} : '')
 )); ?>
  </div>
  <div data-role="fieldcontain">
	<?=form_submit(array('name'=>'add', 
	                     'id'=>'submit-b', 
	                     'value'=>'ADD',
						 'data-theme' => 'b',
						 'data-icon' => 'check',
	))?>
	</div>
<?=form_close(); ?>

<?php 
echo $gconnect;
?>