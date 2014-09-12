<html>
<head>
<title>Item::Page</title>
<meta name="" content="">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap-theme.min.css"')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/style.css')?>">
<style type="text/css">

.thumbwrapper{
	padding: 0px;
	margin: 1px;
	width: 31.666667%;
}

</style>
<script src="http://code.jquery.com/jquery-latest.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
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
$(document).on('click','.addtocart',function(){
	var self = $(this);

	self.attr('disabled','disabled');
	self.text('Processing...');


	$.ajax({
            url :"<?php echo base_url('index.php/cart/add')?>",
            type:"POST",
           	data:$('#addtocartFrom').serialize(),
            dataType:"json",
            success:function(data){
            	self.removeAttr('disabled');
            	self.text('Add To Cart');
                if(typeof(data.error) == "undefined"){
                	$("#message").removeClass('alert-danger');
                	$("#message").addClass('alert-success');
                	$("#message").slideDown();
                    $("#message .messageclass").text(data.success);
                    $("#message").trigger('hide_message');
                }else{
                	$("#message").addClass('alert-danger');
                	$("#message").removeClass('alert-success');
                    $("#message").slideDown();
                    $("#message .messageclass").text(data.error);
                    $("#message").trigger('hide_message');
                }
            }

        });


});

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
<div class="row">
        <div class="col-md-4">

	<!-- start sidebar -->
<ul class="breadcrumb">
    <li>Categories</li>
</ul>
<div class="col-md-12 product_list">
	<ul class="nav">
		<li>
			<a class="active" href="category.html">Canon (12)</a>
			<ul>
				<li><a href="listings.html"> -abc(11)</a></li>
				<li><a class="active" href="listings.html"> - 123 (1)</a></li>
			</ul>
		  </li>
		<li>
			<a href="category.html">lenses (5)</a>
			<ul>
				<li><a href="listings.html"> - abcd (0)</a></li>
				<li><a href="listings.html"> - def (0)</a></li>
			  </ul>
		  </li>
		<li>
			<a href="category.html">Cameras (2)</a>
				<ul>
				<li><a href="listings.html"> - abcd (0)</a></li>
				<li><a href="listings.html"> - abcd(2)</a></li>
				<li><a href="listings.html"> - abcd (0)</a></li>
				<li><a href="listings.html"> - abcd (0)</a></li>
				<li><a href="listings.html"> - abcd (0)</a></li>
			  </ul>
		  </li>
		<li><a href="category.html">Flashes (1)</a></li>
		<li><a href="category.html">Stands (0)</a></li>
		<li><a href="category.html">Filters (3)</a></li>
		<li><a href="category.html">Cameras (2)</a></li>
	</ul>
</div><!-- end sidebar -->

		</div>

		 <div class="col-md-8">
		     <ul class="breadcrumb">
			    <li>
			    <a href="<?=base_url();?>">Home</a>
			    </li>
			    <li>
			    <a href="<?=base_url('index.php/category/'.$product_info['c_id']);?>"><?=$product_info['c_name']; ?></a>
			    </li>
			    <li class="active">
			    <a href="#"><?=$product_info['p_name'];?></a>
			    </li>
    </ul>


	 <div class="row">
		 <div class="col-md-8">
			<h1><?=$product_info['p_name']?></h1>
		 </div>
	</div>
	 <hr>

	 <div class="row">
		 <div class="col-md-4">

			<img alt="" style="width: 200px;" src="<?=base_url('public/images/products/'.$product_info['p_id'].DIRECTORY_SEPARATOR.$images[0])?>">

<?php
foreach ($images as $key => $image) {
	# code...

	?>
																	<div class="col-xs-5 thumbwrapper">
																	<a href="#" class="thumbnail">
																	   <img src="<?=base_url('public/images/products/'.$product_info['p_id'].DIRECTORY_SEPARATOR.$image)?>" alt="">
																			</a>
																	</div>

	<?php }?>
		</div>

	  <div class="col-md-8">

		<div class="col-md-6">
			<address>
				<strong>Brand:</strong> <span><?=$product_info['b_name']?></span><br>
				<strong>Product Model:</strong> <span><?=$product_info['model']?></span><br>

				<strong>Availability:</strong> <span><?=$product_info['p_quantity']?></span><br>
			</address>
		</div>

		<div class="col-md-6">
			<h2>
				<strong>Price: $<?=$product_info['p_price']?></strong> <br><br>
			</h2>
		</div>

<div class="col-md-12">
	<div class="row">
	<form id="addtocartFrom">
  <div class="col-xs-2">
    <input type="text" name="qty" class="form-control" placeholder="1">
    <input type="hidden" name="pid" value="<?=$product_info['p_id']?>" >
  </div>
  <div class="col-xs-3">
  <select name="color">
<?php

$colors = explode(",", $product_info['color']);
foreach ($colors as $key => $color) {
	# code...
	?>
		  	<option value="<?=$color?>"><?=$color?></option>
	<?php }?>
</select>



  </div>
  <div class="col-xs-3">
    <button class="btn btn-primary addtocart">Add to Cart</button>
  </div>
</form>
</div>
		</div>




	  </div>


  </div>
   <hr>
		<div class="row">
	  <div class="span9">
    <div class="tabbable">
    <ul class="nav nav-tabs">
    <li class="active"><a href="#1" data-toggle="tab">Description</a></li>
    <li><a href="#2" data-toggle="tab">Reviews</a></li>

    </ul>
    <div class="tab-content">
    <div class="tab-pane active" id="1">
<?=$product_info['p_description']?>
    </div>
    <div class="tab-pane" id="2">
		<p>There are no reviews for this product.</p>
    </div>

    </div>
    </div>

		</div>
		</div>



		</div>

      </div>

</div>

</div>



<?php $this->load->view('footer.php');?>


</body>
</html>