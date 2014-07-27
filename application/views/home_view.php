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
function UrlExists(url)
{
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}
// trigger load event
$(window).load(function() {
	// load all categories
		$.ajax({
			 url :"<?php echo base_url('index.php/categories/all')?>",
            type:"GET",
            dataType:"json",
            success:function(data){

            	if(typeof(data.error) == 'undefined') {

					var categoriesData = '<a class="btnprev"><span class="glyphicon glyphicon-chevron-left"></span></a><a class="btnnext"><span class="glyphicon glyphicon-chevron-right"></span></a><ul style="display:none">';
								$.each(data, function( index, value ) {
										var url;

									 if(UrlExists('<?=base_url()?>public/images/categories/'+value.c_id+'/image.jpg') == false){
					            		 	url = '<?=base_url()?>public/images/categories/defualt/image.png';
					            		 }else{
					            		 	url = '<?=base_url()?>public/images/categories/'+value.c_id+'/image.jpg';
					            		 }

								  	categoriesData += '<li><div class="col-md-3 product_container"> <img src="'+url+'" alt="'+value.c_name+'"><div class="product-name">'+value.c_name+'</div><div class="buttons_p"><button class="btn btn-default">See More</button></div></div></li>';
								});
								categoriesData += '</ul>';

							$('#categories').html(categoriesData);
							$('#categories').trigger('categoriesloaded');

            	}
            }
		});
	// load all categories ends here


	// load latest products
		$.ajax({
				 url :"<?php echo base_url('index.php/products/latest')?>",
	            type:"GET",
	            dataType:"json",
	            success:function(data){

	            	if(typeof(data.error) == 'undefined') {

						var latestproductsData = '<a class="btnprev"><span class="glyphicon glyphicon-chevron-left"></span></a><a class="btnnext"><span class="glyphicon glyphicon-chevron-right"></span></a><ul style="display:none">';
									$.each(data, function( index, value ) {
											var url;

										 if(UrlExists('<?=base_url()?>public/images/products/'+value.p_id+'/image.jpg') == false){
						            		 	url = '<?=base_url()?>public/images/products/defualt/image.png';
						            		 }else{
						            		 	url = '<?=base_url()?>public/images/products/'+value.p_id+'/image.jpg';
						            		 }

									  	latestproductsData += '<li data-pid= "'+value.p_id+'"><div class="col-md-3 product_container"> <img src="'+url+'" alt="'+value.p_name+'"><div class="product-name">'+value.p_name+'</div><div>'+value.p_price+'<span> EUR</span></div><div class="buttons_p"><button class="addtocart btn btn-primary btn-xs">Add To Cart</button></div></div></div></li>';
									});
									latestproductsData += '</ul>';

								$('#latest_products').html(latestproductsData);
								$('#latest_products').trigger('latestproductsLoaded');

	            	}
	            }
			});

	//load latest producst ends here
});

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

$('#categories').on('categoriesloaded',function(){

	$('#categories').casrousel();
	$('#categories ul').fadeIn(500);
});
$('#latest_products').on('latestproductsLoaded',function(){
	$('#latest_products').casrousel({
		 		step: 5,
	            visible:5,
	            speed:200,
	            liSize:184,
	            margin: 20,
	            carousel_height:250,
	            current:0
	});
	$('#latest_products ul').fadeIn(500);

});

$("#message").on('hide_message',function(){
	setTimeout(function(){
		$("#message").slideUp();
	},2000);
});
// add item to cart
$(document).on('click','.addtocart',function(){
	var self = $(this);
	var pid = self.parents('li').data('pid');
	self.attr('disabled','disabled');
	self.text('Processing...');


	$.ajax({
            url :"<?php echo base_url('index.php/cart/add')?>",
            type:"POST",
           	data:{"pid":pid},
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
	<div class = "landscape" style="background-color: #0b0000;"></div>
	<div class = "landscape_tiny_box" ></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div>
</div>
<div class="row">

	   <div class="landscape_header col-6">Categories</div>
			<div id="categories">

				<img class="loader" src="<?=base_url('public/images/loader.gif')?>">

			</div>
</div>
<div class="row">


		<div class = "landscape_header"> Latest Products</div>
		<div id="latest_products">

			<img class="loader" src="<?=base_url('public/images/loader.gif')?>">

			</div>
</div>


</div>
</body>
</html>