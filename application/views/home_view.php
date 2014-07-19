<html>
<head>
<title></title>
<meta name="" content="">
<link rel="stylesheet" type="text/css" href="<?=base_url('public/style.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('public/css/bootstrap.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('public/css/bootstrap-theme.min.css"')?>">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    // login user
    $("#login_btn").click(function(e){
    	$("#login_btn").attr('disabled','disabled');
    	$("#login_btn").text('Processing');
        e.preventDefault();
        $.ajax({
            url :"<?=base_url('index.php/home/login_request')?>",
            type:"POST",
            data:$("#login_form").serialize(),
            dataType:"json",
            success:function(data){
            	$("#login_btn").removeAttr('disabled');
            	$("#login_btn").text('Submit');
                if(typeof(data.error) == "undefined"){
                    setTimeout(function(){
                        window.location = "<?=base_url('index.php/home')?>"
                    },500);
                }else{
                    $("#message").show();
                    $("#message .messageclass").text(data.error);
                }
            }

        });

    });// login function ends




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
<?php if (!$logged_in) {?>
	<form id="login_form" class="navbar-form navbar-right" role="login">
						<div class="form-group">
										<input type="text" name="useremail" class="form-control" placeholder="john@gmail.com">
														<input type="password" name="userpassword"  class="form-control" placeholder="password">
																													        </div>
									<button type="submit" id="login_btn" class="btn btn-default">Submit</button>
																													      </form>
	<?php } else {?>
																													<ul class="nav navbar-nav navbar-right">

																													        <li class="dropdown">
																													          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$user_name?><span class="caret"></span></a>
																													          <ul class="dropdown-menu" role="menu">
																													            <li><a href="#">Action</a></li>
																													            <li><a href="#">Another action</a></li>
																													            <li><a href="#">Something else here</a></li>
																													            <li class="divider"></li>
																													            <li><a href="<?=base_url('index.php/home/logout')?>">Logout</a></li>
																													          </ul>
																													        </li>
																													      </ul>
	<?php }?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">


<div class="black_box box_size">
	<div class = "landscape" style="background-color: #0b0000;"></div>
	<div class = "landscape_tiny_box" ></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div>
</div>
<div class="catagory_box box_size">
	<div  class = "landscape">

	   <div class = "landscape_header">Categories
	     <hr style="float: right; margin-top:15px;">  </div>
		<div class="pics_box">
			<div class="pic_box"> <img class="pic_img" src="<?=base_url('public/images/camera.jpg')?>" alt="" /></div><div class = "tiny_separator for_pic"></div>
			<div class="pic_box"> <img class="pic_img" src="<?=base_url('public/images/lenses.jpg')?>" alt="" /></div><div class = "tiny_separator for_pic"></div>
			<div class="pic_box"> <img class="pic_img" src="<?=base_url('public/images/stand.jpg')?>" alt="" /></div><div class = "tiny_separator for_pic"></div>
			<div class="pic_box"> <img class="pic_img" src="<?=base_url('public/images/cameras.jpg')?>" alt="" /></div>
		</div>
	</div>
	<div class = "landscape_tiny_box"></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div><div class = "tiny_separator"></div>
	<div class = "landscape_tiny_box"></div>
</div>
<div class="latest box_size">
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
<div class="blog box_size">
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