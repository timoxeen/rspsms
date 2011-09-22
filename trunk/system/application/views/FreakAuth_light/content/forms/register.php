<!--jquery mobile app-->

	<div data-role="content" role="main">
		<div class="user">
				<?=form_open($this->uri->uri_string(), array('id' => 'register_form'))?>
				<div data-role="fieldcontain">
					<label for='user_name'><?=$this->lang->line('FAL_user_name_label')?>:</label>
					<?=form_input(array('name'=>'user_name', 
				                       'id'=>'user_name',
				                       'maxlength'=>'45', 
				                       'size'=>'45',
				                       'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'user_name'} : '')))?>
			    	<?=(isset($this->fal_validation) ? $this->fal_validation->{'user_name'.'_error'} : '')?>
				</div>
				<div data-role="fieldcontain">
					<label for='email'><?=$this->lang->line('FAL_user_email_label')?>:</label>
					<?=form_input(array('name'=>'email', 
				                       'id'=>'email',
				                       'maxlength'=>'120', 
				                       'size'=>'45',
				                       'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'email'} : '')))?>
			    	<?=(isset($this->fal_validation) ? $this->fal_validation->{'email'.'_error'} : '')?>
				</div>
				<div data-role="fieldcontain">
					<label for='password'><?=$this->lang->line('FAL_user_password_label')?>:</label>
					<?=form_password(array('name'=>'password', 
					                       'id'=>'password',
					                       'maxlength'=>'16', 
					                       'size'=>'16',
				    	                   'value'=>''))?>
			    	<?=(isset($this->fal_validation) ? $this->fal_validation->{'password'.'_error'} : '')?>
				</div>
				<div data-role="fieldcontain">
					<label for='password_confirm'><?=$this->lang->line('FAL_user_password_confirm_label')?>:</label>
					<?=form_password(array('name'=>'password_confirm', 
					                       'id'=>'password_confirm',
					                       'maxlength'=>'16', 
					                       'size'=>'16',
				    	                   'value'=>''))?>
			    	<?=(isset($this->fal_validation) ? $this->fal_validation->{'password_confirm'.'_error'} : '')?>
				</div>
					
	            <!--CAPTCHA (security image)-->
				<?php
				if ($this->config->item('FAL_use_captcha_register'))
				{?>
				<p><label for="security"><?=$this->lang->line('FAL_captcha_label')?>:</label>
				<?=form_input(array('name'=>'security', 
				                    'id'=>'security',
				                    'maxlength'=>'45', 
				                    'size'=>'45',
				                    'value'=>''))?>
			    <?=(isset($this->fal_validation) ? $this->fal_validation->{'security'.'_error'} : '')?>
			    <?=$this->load->view($this->config->item('FAL_captcha_img_tag_view'), null, true)?></p>
			    <?php }?>
			    <!-- END CAPTCHA (security image)-->
			    
			    <div data-role="fieldcontain">
			    <fieldset data-role="controlgroup" data-type="horizontal" data-role="fieldcontain">
			    	<legend><?php echo $this->lang->line('FAL_user_gender_label')?>:</legend>
			         	<input type="radio" name="gender" id="radio-choice-1" value="M" checked="checked" />
			         	<label for="radio-choice-1">He</label>
			
			         	<input type="radio" name="gender" id="radio-choice-2" value="F"  />
			         	<label for="radio-choice-2">She</label>
			
			    </fieldset>
				</div>
				<div data-role="fieldcontain">
				<label for="select-choice-1" class="select">Date Of Birth:</label>
				<div data-role="fieldcontain">
				<select name="month" id="select-choice-1">
					<option value="">Month</option>
					<option value = "1">January</option>
					<option value = "2">February</option>
					<option value = "3">March</option>
					<option value = "4">April</option>
					<option value = "5">May</option>
					<option value = "6">June</option>
					<option value = "7">July</option>
					<option value = "8">August</option>
					<option value = "9">September</option>
					<option value = "10">October</option>
					<option value = "11">November</option>
					<option value = "12">December</option> 
				</select>
				<?php 
				$options = array();
				$options['']= 'Date';
				for($i=1;$i<31;$i++)
				{
					$options[$i] = $i;
				}
				?>
				<?php echo form_dropdown('Date',$options) ;
				$options = array();
				$options[''] = 'Year';
				for($i=1975;$i<2002;$i++)
				{
					$options[$i] = $i;
				}
				 echo form_dropdown('year',$options);?>
				
				</div>
			</div>
			<div data-role="fieldcontain">
					<label for='mobile'><?=$this->lang->line('FAL_user_mobile_label')?>:</label>
					<?=form_input(array('name'=>'mobile', 
				                       'id'=>'mobile',
				                       'maxlength'=>'120', 
				                       'size'=>'45',
									   'type'=>'tel',
				                       'value'=>(isset($this->fal_validation) ? $this->fal_validation->{'mobile'} : '')))?>
			    	<?=(isset($this->fal_validation) ? $this->fal_validation->{'mobile'.'_error'} : '')?>
			</div>
			    
			    
			    
				<?php
				if ($this->config->item('FAL_use_country'))
				{?>    
			    <div data-role="fieldcontain"><label><?=$this->lang->line('FAL_user_country_label')?>:</label>
				<?=form_dropdown('country_id',
				                 $countries,
				                 (isset($this->fal_validation) ? $this->fal_validation->country_id : 0))?>
			    <?=(isset($this->fal_validation) ? $this->fal_validation->{'country_id'.'_error'} : '')?></div>
				<?php
				}
				$buttonSubmit = $this->lang->line('FAL_register_label');
				$buttonCancel = $this->lang->line('FAL_cancel_label');
				$callConfirm = '';
				if ($this->lang->line('FAL_terms_of_service_message') != '')
				{
			    	$buttonSubmit = $this->lang->line('FAL_agree_label');
			    	$buttonCancel = $this->lang->line('FAL_donotagree_label');
			    	$callConfirm = 'confirmDecline();';
				?>	
				<div data-role="fieldcontain">
					<textarea name="rules" class="textarea" rows="8" cols="50" readonly="readonly">
					<?=$this->lang->line('FAL_terms_of_service_message')?>
					</textarea>
				</div>
				<?php    
				}?>
				<div class="ui-body ui-body-b">
				
			<fieldset class="ui-grid-a">
						<div class="ui-block-a">	
					<?=form_submit(array('name'=>'register',
							   			 'class'=>'submit',  
				                         'value'=>$buttonSubmit))?>
					</div>
					<div class="ui-block-b">
					<?=form_submit(array('type'=>'button',
					                     'name'=>'cancel',
					                     'class'=>'button',
					                     'value'=>$buttonCancel,
					                     'onclick'=>$callConfirm))?>
					 </div>
				 </fieldset>
			    </div>
				<?=form_close()?>
			
	</div><!--
	<div data-role="footer" data-position="fixed">
		<p class="left p10">&copy; 2010 jQuery Mobile MVC Framework</p>
		<ul class="right simplenav p10">
			<li><a href="./about" data-icon="info" class="ui-btn-right">About</a></li>

			<li><a href="./terms" data-icon="add">Terms of Service</a></li>
		</ul>
	</div>
--><script language="JavaScript" type="text/javascript">
<!--
function confirmDecline() 
{
    if (confirm('<?=$this->lang->line('FAL_register_cancel_confirm')?>')) 
		location = '<?=site_url()?>';
} 
//-->
</script></div>
