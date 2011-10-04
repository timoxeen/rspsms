<?=form_open('sms', array('id' => 'contacts_add'))?>
<div data-role="fieldcontain">
    
    <?php if(!empty($contacts)) : ?>
    <?php 
    $gConacts = array();
    foreach($contacts as $contactG)
    {
    	if($contactG['mobile']!=0)
    	{
    		$gConacts[$contactG['mobile']] = $contactG['name'];
    	}
    }
    ?>
    <fieldset data-role="controlgroup">
    	<legend>Choose contacts:</legend>
    	 <?php foreach($gConacts as $key => $contact) :?>
         	<input type="checkbox" name="mobilenos[]" id="radio-choice-<?=$key ?>" value="<?=$key ?>" />
         	<label for="radio-choice-<?=$key ?>"><?=$contact ?></label>
		 <?php endforeach;?>
         	
    </fieldset>
     
</div>
<div data-role="fieldcontain">
	<?=form_submit(array('name'=>'add', 
	                     'id'=>'submit-b', 
	                     'value'=>'Send Message',
						 'data-theme' => 'b',
						 'data-icon' => 'check',
	))?>
	</div>
	<?=form_close() ?>
	<?php else: ?>
	<div style="text-align:center;padding: 15px 0"> No Contacts Added yet</div>
	<?php endif; ?>