<div data-role="content" role="main">
		<?php $attr = array('data-transition'=>'slide');?>
		<ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="b">
			<li data-role="list-divider">User Navigation:</li>
									<li><?php echo anchor('auth/register','Register',$attr) ?></li>
			<li><?php echo anchor('auth/login','Login',$attr) ?></li>
		
						<li data-role="list-divider">Pages:</li>
			<li><a href="./about" data-transition="slide">About</a></li>
			<li><a href="./terms" data-transition="slide">Terms of Service</a></li>
		</ul>	</div>
