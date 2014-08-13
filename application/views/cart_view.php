<html>
<head>
<title></title>
<meta name="" content="">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap-theme.min.css"')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/style.css')?>">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="<?=base_url('public/js/casousel.js')?>"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>

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
                    $("#message").slideDown();
                    $("#message .messageclass").text(data.error);
                    $("#message").trigger('hide_error_message');
                }
            }

        });

    });// login function ends


$("#message").on('hide_error_message',function(){
	setTimeout(function(){
		$("#message").slideUp();
	},2000);
});

$(".checkout").click(function(){

          $(this).toggleClass('active');

});

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
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>

      	<form class="navbar-form navbar-left" role="Search">
						<div class="form-group">
						<input type="text" name="q" class="form-control" placeholder="Search">

						</div>
					<button type="submit"  class="btn btn-default">Submit</button>
	</form>
<?php
if (!$logged_in):?>
<form id="login_form" class="navbar-form navbar-right" role="login">
		<div class="form-group">
		<input type="text" name="useremail" class="form-control" placeholder="john@gmail.com">
		<input type="password" name="userpassword" class="form-control" placeholder="type password">
				<button type="submit" id="login_btn" class="btn btn-default">Submit</button>
	</form>
<?php
else:?>
<ul class="nav navbar-nav navbar-right">

	<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user_name
?><span class="caret"></span></a>
	<ul class="dropdown-menu" role="menu">
			<li><a href="#">Action</a></li>
			<li><a href="#">Another action</a></li>
			<li><a href="#">Something else here</a></li>
			<li class="divider"></li>
			<li><a href="<?php echo base_url('index.php/home/logout')?>">Logout</a></li>
		</ul>
		</li>
	</ul>
<?php
endif;?>
</div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">


<div class="row">
<?php echo form_open(base_url('index.php/cart/update'));?>
<table class="table table-bordered table-condensed table-hover" >

<tr class="active">
  <th>QTY</th>
  <th>Item Description</th>
  <th style="text-align:right">Item Price</th>
  <th style="text-align:right">Sub-Total</th>
</tr>

<?php $i = 1;?>

<?php foreach ($this->cart->contents() as $items):?>

<?php echo form_hidden($i.'[rowid]', $items['rowid']);?>

	<tr>
	  <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5'));?>
        <?php echo form_input(array('name' => $i.'[pid]', 'value' => $items['id'], 'type' => 'hidden'));?>
</td>
	  <td>
<?php echo $items['name'];?>

<?php if ($this->cart->has_options($items['rowid']) == TRUE):?>
<p>
<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value):?>


	 <strong><?php echo $option_name;
?>:</strong>
	<br />


<?php echo $option_value;
?>
<?php if (count($this->session->userdata($items['rowid'])) > 0 && !empty($this->session->userdata($items['rowid']))):?>
    <?php foreach ($this->session->userdata($items['rowid']) as $colors):?>
<option value="<?=$colors?>"><?=$colors?></option>
<?php endforeach;?>
  <?php endif;?>


<?php endforeach;?>
</select>
	</p>

<?php endif;?>

		  </td>
		  <td style="text-align:right"><?php echo $this->cart->format_number($items['price']);?></td>
		  <td style="text-align:right">$<?php echo $this->cart->format_number($items['subtotal']);?></td>
		</tr>

<?php $i++;?>

<?php endforeach;?>

	<tr class="info">
	  <td colspan="2"></td>
	  <td class="right"><strong>Total</strong></td>
	  <td class="right">$<?php echo $this->cart->format_number($this->cart->total());?></td>
	</tr>

	</table>

	<p><button class="btn btn-primary"> Update Cart</button></p>
<?=form_close();?>
  <p><a href="<?=base_url('index.php/cart/checkout')?>" class="btn btn-default has-spinner checkout">

    <span class="spinner"><i class="glyphicon glyphicon-refresh"></i></span>
    Checkout


   </a></p>

	</div>
	</div>
	</body>
	</html>