<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
<title><?=$heading.' &raquo; '.$this->config->item('FAL_website_name')?></title>
<link href="<?=base_url().$this->config->item('FAL_assets_shared').'/'.$this->config->item('FAL_css');?>/jquery.mobile-1.0a3.min.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url().$this->config->item('FAL_assets_front').'/'.$this->config->item('FAL_css');?>/common.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url().$this->config->item('FAL_assets_shared').'/'.$this->config->item('FAL_js');?>/jquery-1.5.min.js" type="text/javascript"></script>

<script src="<?=base_url().$this->config->item('FAL_assets_front').'/'.$this->config->item('FAL_js');?>/common.js" type="text/javascript"></script>

<script src="<?=base_url().$this->config->item('FAL_assets_shared').'/'.$this->config->item('FAL_js');?>/jquery.mobile-1.0a3.min.js" type="text/javascript"></script>
<script type="text/javascript">
<!--



//-->
</script>


<style type="text/css">
body {
	font-family: arial, sans-serif;
	font-size: 13px;
}

strong {
	font-weight: 700;
}

em {
	font-style: italic;
}

p {
	line-height: 19px;
	margin: 0 0 20px;
}

.left {
	float: left;
}

.right {
	float: right;
}

.p10 {
	padding: 10px;
}

.mr10 {
	margin: 0 10px 0 0;
}

ul.simplenav {
	list-style-type: none;
	margin: 0;
}

ul.simplenav li {
	float: left;
	margin-left: 5px;
}
.ui-header .ui-btn-right{
	top: 0em !important;
}
</style>
</head>
<body>
<div data-role="page" data-theme="c"><?php //$this->load->view($this->config->item('FAL_template_dir').'template/menu');?>
<?php if(!isset($register)) $register = false;?>
<?php if(isset($header)) { if($header) {?>
<div data-role="header" data-theme="a">
<div data-role="controlgroup" data-type="horizontal" class="ui-btn-right" >
<?=loginAnchor(null,null,null,null,$register);?> </div>
<h1><?php echo $heading ?></h1>
<?php echo displayMenu();?>
</div>
<?php } else {?>

<center>
<h1><?php echo $heading ?></h1>
</center>
<?php }} else
{?>
<div data-role="header" data-theme="a">
<div data-role="controlgroup" data-type="horizontal" style="float: right;">

<?=loginAnchor(null,null,null,null,$register);?> 


</div>
<h1><?php echo $heading ?></h1>
</div>

<?php 
}?>
