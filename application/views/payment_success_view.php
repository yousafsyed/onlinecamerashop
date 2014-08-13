<html>
<head>


	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap-theme.min.css"')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/style.css')?>">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="<?=base_url('public/js/casousel.js')?>"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" bgcolor='#e6e6e6' font-family='verdana'>
<div style="width: 900px;
margin: auto;
background-color: #fff;
padding: 20px;
box-shadow: 0px 1px 5px #A6A5A5;
margin-top: 65px;
border-radius: 5px;
margin-bottom: 30px;
border: 1px solid #BFBFBF;">
<table width="100%"cellpadding="10" cellspacing="0" class="backgroundTable" bgcolor='#e6e6e6' >
<tr>
<td valign="top" align="center">

<table width="100%" cellpadding="0" cellspacing="0" bgcolor='#ffffff'>
<tr height="122px"><td valign="top" align="center"><h1>Order</h1></td></tr>
<tr height="110px"><td align="left" valign="top" style="padding-top:20px;padding-left:20px;padding-right:20px">
 <p style="font-size:20px; font-family: Trebuchet MS,Helvetica;">Thank you for your purchase</p>
 <p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">This is a confirmation email.  <br>Your order has been received and will be dispatched within 5 business day. You can track the progress of your order in your account. <a href="<?=base_url()?>">Go Back to Home</a></p>
</td></tr>
</table>

<table class="table table-bordered table-condensed table-hover" width="801px" cellpadding="0" cellspacing="0" bgcolor='#ffffff'>

<tr><td align="right" valign="top" style="padding-top:5px;padding-left:10px;padding-right:10px;padding-bottom:5px;"><p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">Name</p></td><td align="left" valign="top" style="padding-top:5px;padding-left:10px;padding-right:10px;padding-bottom:5px;"><p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;"><?=$first_name?> <?=$last_name?></p></td></tr>
<tr><td align="right" valign="top" style="padding-top:5px;padding-left:10px;padding-right:10px;padding-bottom:20px;"><p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">Delivery address</p></td><td align="left" valign="top" style="padding-top:5px;padding-left:10px;padding-right:10px;padding-bottom:20px;"><p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;"><?=$address_name?><br><?=$address_street?><br><?=$address_city?><br><?=$address_state?><br><?=$address_zip?><br><?=$address_country?></p></td></tr>
</table>

<table class="table table-bordered table-condensed table-hover" width="801px" cellpadding="0" bgcolor='#ffffff'>
<tr><td style="padding-left:20px;padding-right:5px;padding-top:10px;"><p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;font-weight:bold;">Item</p></td><td style="padding-left:5px;padding-right:5px;padding-top:10px;"><p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;font-weight:bold;">Quantity</p></td><td style="padding-left:5px;padding-right:5px;padding-top:10px;"><p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;font-weight:bold;">Cost per item</p></td><td style="padding-left:5px;padding-right:5px;padding-top:10px;"><p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;font-weight:bold;">Total cost</p></td></tr>
<?php foreach ($items as $key => $i) {
	?>
	<tr><td style="padding-left:20px;padding-right:5px;"><p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">

	<?=$i['item_name']?></td>
													<td align="right" style="padding-left:5px;padding-right:5px;">
													<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">
	<?=$i['quantity']?></p></td>
													<td align="right" style="padding-left:5px;padding-right:5px;">
													<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">
	<?=$i['cost_per_item']?></p></td>
													<td align="right" style="padding-left:5px;padding-right:20px;">
													<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">
	<?=$i['mc_gross']?></p>
													</td></tr>
	<?php }?>
<tr>
<td style="padding-left:20px;padding-right:5px;padding-top:5px;" colspan="3">
<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">Shipping</p></td>
<td align="right" style="padding-left:20px;padding-right:20px;padding-top:5px;">
<p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">
<?=$mc_shipping?></p></td></tr>
<tr><td style="padding-left:20px;padding-right:5px;padding-top:5px;" colspan="3"><p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">Discount</p></td><td align="right" style="padding-left:20px;padding-right:20px;padding-top:5px;"><p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">-<?=$discount?></p></td></tr>
<tr><td style="padding-left:20px;padding-right:5px;padding-top:0px;" colspan="3"><p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">TOTAL</p></td><td align="right" style="padding-left:20px;padding-right:20px;padding-top:5px;"><p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;font-weight:bold;"><?=$mc_gross?></p></td></tr>
<tr><td style="padding-left:20px;padding-right:20px;padding-top:15px;padding-bottom:20px;" colspan="4"><p style="font-size:12px; font-family: Lucida Sans Unicode,Lucida Grande;">If you have any questions regarding your order, don't hesitate to contact us on CHANGEME@CHANGEME.com</p>
</table>

</td>
</tr>
</table>
</div>
</body>
</html>