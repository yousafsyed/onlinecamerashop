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
<?php $this->load->view('header.php');?>
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

<img alt="buy now with PayPal" border="0" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_buynow_pp_142x27.png" />
   </a></p>

	</div>
    
	</div>
    <?php $this->load->view('footer.php');?>
	</body>
	</html>