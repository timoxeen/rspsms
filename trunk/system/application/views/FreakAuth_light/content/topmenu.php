<?php
$activemenu = array('class'=>'ui-btn-active');
		
		$showcontacts = array();
		$contactslist = array();
		$menusubgroup = $this->uri->segment(2, 0);
		
		if($menusubgroup)
		if($menusubgroup == 'show')
		{
			$showcontacts = $activemenu;
		}
		else
		if($menusubgroup == 'add')
		{
			$contactslist = $activemenu;
		}
		$showcontacts['id'] = 'show-contacts';
		$menugroup = $this->uri->segment(1, 0);
		if($menugroup)
		if($menugroup == 'contacts')
		{
			?>
			<div data-role="navbar">
			<ul>
				<li> <?php echo anchor('contacts/show','List',$showcontacts);  ?></li>
				<li><?php echo anchor('contacts/add','Add',$contactslist);  ?></li>
			</ul>
			</div>
			<?php 
		}else
		if($menugroup == 'sms')
		{
			$sms = array();
		$contacts = array();
		$feedback = array();
		if($menu_sms == true)
		{
			$sms = $activemenu;
		}
		if($menu_contact == true)
		{
			$contacts = $activemenu;
		}
		if($menu_feedback == true)
		{
			$feedback = $activemenu;
		}
		$sms['id'] = 'smsid';
		?>
		<div data-role="navbar">
			<ul>
				<li> <?php echo anchor('sms','Send Sms',$sms);  ?></li>
				<li><?php echo anchor('sms/sent','Sms Sent',$contacts);  ?></li>
				<li><?php echo anchor('sms/feedback','Feedback',$feedback); ?></li>

			</ul>
		</div>
		<?php 
		}
		?>
		