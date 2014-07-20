<html>
<head>
<title></title>
<meta name="" content="">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap-theme.min.css"')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/style.css')?>">
<script src="http://code.jquery.com/jquery-latest.js"></script>
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
                    $("#message").show();
                    $("#message .messageclass").text(data.error);
                }
            }

        });

    });// login function ends



$(function() {
		var step = 4;
		var current = 0;
		var maximum = $('#my_carousel ul li').size();
		var visible = 4;
		var speed = 200;
		var liSize = 250;
		var carousel_height = 300;


		var ulSize = (liSize)*maximum;
		var divSize = (liSize) * visible;

		$('#my_carousel ul').css("width", ulSize+"px").css("left", -(current * liSize)).css("position", "absolute");

		$('#my_carousel').css("width", divSize+"px").css("height", carousel_height+"px").css("visibility", "visible").css("overflow", "hidden").css("position", "relative");

		$('.btnnext').click(function() {
			if(current + step < 0 || current + step > maximum - visible) {return; }
			else {
				current = current + step;
				$('#my_carousel ul').animate({left: -(liSize * current)}, speed, null);
			}
			return false;
		});

		$('.btnprev').click(function() {
			if(current - step < 0 || current - step > maximum - visible) {return; }
			else {
				current = current - step;
				$('#my_carousel ul').animate({left: -(liSize * current)}, speed, null);
			}
			return false;
		});
	});


});// document ready ends
</script>
</head>
<body>

<div id="message" style="display:none;margin:0;border-radius:0;" class="alert alert-danger fade in" role="alert">

      <span class="messageclass"></span>
</div>
<nav class="navbar navbar-default" role="navigation">
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


<!-- <div class="row">
	<div class = "landscape" style="background-color: #0b0000;"></div>
	<div class = "landscape_tiny_box" ></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div>
</div> -->
<div class="row">
<button class="btnprev">Previous
  </button>
<button class="btnnext">Next
  </button>
	   <div class="landscape_header col-6">Categories</div>
			<div id="my_carousel">
						<ul>
								<li><div class="col-md-3 product_container"> <img src="http://localhost:8080/onlinecamerashop/public/images/camera.jpg" alt="">
										<div class="product-name">Cameras</div>
										  <div class="buttons_p">
										    <button class="btn btn-default">See More</button></div>
										</div>
								</li>
								<li>	<div class="col-md-3 product_container"> <img src="http://localhost:8080/onlinecamerashop/public/images/lenses.jpg" alt="">
									<div class="product-name">Lenses</div>
									  <div class="buttons_p">
									    <button class="btn btn-default">See More</button></div>


									</div>
									</li>
									<li><div class="col-md-3 product_container"> <img  src="http://localhost:8080/onlinecamerashop/public/images/stand.jpg" alt="">
										<div class="product-name">Tripods</div>
										  <div class="buttons_p">
										    <button class="btn btn-default">See More</button></div>
									</div>
									</li>
									<li><div class="col-md-3 product_container"> <img  src="http://localhost:8080/onlinecamerashop/public/images/cameras.jpg" alt="">
										<div class="product-name">Cheap Cameras</div>
										  <div class="buttons_p">
										    <button class="btn btn-default">See More</button></div>
									</div>
									</li>

<!--NExt four-->
<li><div class="col-md-3 product_container"> <img src="http://localhost:8080/onlinecamerashop/public/images/camera.jpg" alt="">
										<div class="product-name">Cameras</div>
										  <div class="buttons_p">
										    <button class="btn btn-default">See More</button></div>
										</div>
								</li>
								<li>	<div class="col-md-3 product_container"> <img src="http://localhost:8080/onlinecamerashop/public/images/lenses.jpg" alt="">
									<div class="product-name">Lenses</div>
									  <div class="buttons_p">
									    <button class="btn btn-default">See More</button></div>


									</div>
									</li>
									<li><div class="col-md-3 product_container"> <img  src="http://localhost:8080/onlinecamerashop/public/images/stand.jpg" alt="">
										<div class="product-name">Tripods</div>
										  <div class="buttons_p">
										    <button class="btn btn-default">See More</button></div>
									</div>
									</li>
									<li><div class="col-md-3 product_container"> <img  src="http://localhost:8080/onlinecamerashop/public/images/cameras.jpg" alt="">
										<div class="product-name">Cheap Cameras</div>
										  <div class="buttons_p">
										    <button class="btn btn-default">See More</button></div>
									</div>
									</li>



							</ul>
			</div>
</div>
<div class="row">
	<div  class = "landscape">

		<div class = "landscape_header"> Latest Products
		  <hr style="float: right; margin-top:15px;">  </div>
		<div class="pics_box">
			<div class="pic_box"> <img class="pic_img" src="../../images/lenses.jpg" alt="" /></div><div class = "tiny_separator for_pic"></div>
			<div class="pic_box"> <img class="pic_img" src="../../images/others.jpg" alt="" /></div><div class = "tiny_separator for_pic"></div>
			<div class="pic_box"> <img class="pic_img" src="../../images/stand.jpg" alt="" /></div><div class = "tiny_separator for_pic"></div>
			<div class="pic_box"> <img class="pic_img" src="../../images/cameras.jpg" alt="" /></div>
		</div>
		</div>
	<div class = "landscape_tiny_box"></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div>
</div>
<div class="row">
	<div class = "landscape">

		<div class = "landscape_header"> Latest Blog
		  <hr style="float: right; margin-top:15px;">  </div>

		<div class="pics_box">
			<div class="pic_box"> <img class="pic_img" src="" alt="" /> </div><div class = "tiny_separator for_pic"></div>
			<div class="pic_box"> <img class="pic_img" src="" alt="" /></div><div class = "tiny_separator for_pic"></div>
			<div class="pic_box"> <img class="pic_img" src="" alt="" /></div><div class = "tiny_separator for_pic"></div>
			<div class="pic_box"> <img class="pic_img" src="" alt="" /></div>
		</div>
		</div>


	<div class = "landscape_tiny_box"></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div>

	</div>

</div>
</body>
</html>