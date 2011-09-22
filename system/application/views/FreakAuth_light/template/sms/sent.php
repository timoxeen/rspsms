<ul data-role="listview">	
<?php $count = 0; $temparray=array();?>	
<?php foreach ($list as $item) :?>
<?php $temparray[] = $item->ondate; ?>
<?php  if(!$count) :?>
<li data-role="list-divider"><?php echo $item->ondate;?><span class="ui-li-count"></span></li>
<?php endif;?>
<?php  if($count)if($temparray[$count-1] != $item->ondate):?>


<li data-role="list-divider"><?php echo $item->ondate;?><span class="ui-li-count"></span></li>
<?php endif;?>
<?php 

$toList = explode(';',$item->to_list);

if($item->to_numbers != null || count($toList) <=1) :?>
		<li>
				<h3><a href="index.html"><?php echo ($item->to_numbers == null) ? $item->to_list : $item->to_numbers ?></a></h3>
				<p><strong><?php if($item->status == 0) { echo '<font color="#720091">Pending</font>'; } else if($item->status == 1) { echo '<font color="#FFBC05">Sent</font>'; } else if($item->status == 2) { echo '<font color="#009100">Delivered</font>'; } else if($item->status == 3) { echo '<font color="#D1000A">May not be delivered(DND)</font>'; }else if($item->status == 4) { echo '<font color="#D1000A"> Failed (DND Number) </font>'; }?></strong></p>
				<p><?php echo $item->message ?></p>

				<p class="ui-li-aside"><?php echo $item->attime;?></p>
		</li>
<?php else: ?>

<li>
<?php 
$toStatus = explode(',',$item->status);
$conbined= array_combine($toList,$toStatus);

$final = array();
$sub2 = array();
$sub1 = array();
$sub3 = array();
$sub4 = array();
foreach($conbined as $key => $value)
{
	if($value == 2)
	{
		$sub2[] = $key;
	}
	if($value == 1)
	{
		$sub1[] = $key;
	}
	if($value == 3)
	{
		$sub3[] = $key;
	}
	if($value == 4)
	{
		$sub4[] = $key;
	}	
}
$final[1] = implode(',',$sub1);
$final[2] = implode(',',$sub2);
$final[3] = implode(',',$sub3);
$final[4] = implode(',',$sub4);

?>
				<h3><a href="#"><?php echo ($item->to_numbers == null) ? $item->to_list : $item->to_numbers ?></a></h3>
				
				<?php foreach($final as $key => $numbers): ?>
				<?php if(!empty($numbers)) : ?>
				<p><strong><?php if($key == 0) { echo '<font color="#720091">Pending</font>'; } else if($key == 1) { echo '<font color="#FFBC05">Sent</font>'; } else if($key == 2) { echo '<font color="#009100">Delivered</font>'; } else if($key == 3) { echo '<font color="#D1000A">May not be delivered(DND)</font>'; }else if($key == 4) { echo '<font color="#D1000A"> Failed (DND Number) </font>'; }?></strong></p>
				<p><?php echo $numbers; ?></p>
				<?php endif;?>
				<?php endforeach; ?>
				<p><?php echo $item->message ?></p>
				<p class="ui-li-aside"><?php echo $item->attime;?></p>
</li>
<?php endif; ?>
<?php $count++;?>
<?php endforeach; ?>	

<?php if($count ==0):?>
<li style="height:200px;text-align:center;padding-top:80px;"><span>No Sent Messages Found</span> </li>
<?php endif; ?>	
</ul>	
			