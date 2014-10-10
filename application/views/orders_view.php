<html>
<head>
<title></title>
<meta name="" content="">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap-theme.min.css"')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/style.css')?>">
<script src="<?= base_url('public/js/jquery-latest.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public/js/casousel.js') ?>"></script>
<!-- Latest compiled and minified JavaScript -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/js/nivo_style.css" />
<script src="<?= base_url('public/js/bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url() ?>public/js/nivo_script.js"></script>
    
<script>
function UrlExists(url)
{
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}

$(document).ready(function(){

    // login user
    $("#login_btn").click(function(e){
    	$("#login_btn").attr('disabled','disabled');

        e.preventDefault();
        $.ajax({
            url :"<?php echo base_url('index.php/home/login_request')?>",
            type:"POST",
            data:$("#login_form").serialize(),
            dataType:"json",
            success:function(data){
            	$("#login_btn").removeAttr('disabled');

                if(typeof(data.error) == "undefined"){
                    setTimeout(function(){
                        window.location = "<?php echo base_url('index.php/home')?>"
                    },500);
                }else{
                   $("#message").addClass('alert-danger');
                	$("#message").removeClass('alert-success');
                    $("#message").slideDown();
                    $("#message .messageclass").text(data.error);
                    $("#message").trigger('hide_message');
                }
            }

        });

    });// login function ends



$("#message").on('hide_message',function(){
	setTimeout(function(){
		$("#message").slideUp();
	},2000);
});
// add item to cart


// add item to cart ends


});// document ready ends
</script>
</head>
<body>

<div id="message" style="display:none;margin:0;border-radius:0; position: fixed;
top: 51;
width: 100%;
z-index: 10000" class="alert alert-danger fade in" role="alert">

      <span class="messageclass"></span>
</div>
<?php $this->load->view('header.php');?>
<div class="container">

<table class="table table-bordered ">
	<thead>
		<tr>
			<th>#</th>
			<th>Transaction Id</th>
			<th>Method</th>
			<th>Status</th>
			<th>Total</th>
			<th>Total Items #</th>
			<th>Dispatched Status</th>
			<th>Created On</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($orders as $key => $order) {?>
																			 <tr>
																			 	<td><?=$order['id']?></td>
																			 	<td><?=$order['txn_id']?></td>
																			 	<td>Paypal</td>
																			 	<td><?php

	if ($order['order_status'] == 'PAID') {
		echo '<span class="label label-success">'.$order['order_status'].'</span>';
	} else {
		echo '<span class="label label-danger">'.$order['order_status'].'</span>';
	}

	?></td>
																			 	<td><?=$order['mc_gross']?></td>
																			 	<td><?=$order['num_cart_items']?></td>
																			 	<td>
	<?php
	if ($order['dispatched_status'] == '1') {
		echo '<span class="label label-success">Yes</span>';
	} else {
		echo '<span class="label label-danger">No</span>';
	}

	?>


								</td>
									<td><?=$order['created_at']?></td>
									<td style="text-align:center">
									 	<a href="<?=base_url('index.php/home/viewOrder/'.$order['id'])?>" class="button button-default"><span class="glyphicon glyphicon-print"></span></a>
									</td>
								</tr>
	<?php }?>
	</tbody>

</table>


</div>
</body></html>