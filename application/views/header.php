<?php
error_reporting(0);

?>
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
      <a class="navbar-brand" href="<?=base_url()?>" style="font-weight: bold; color: blueviolet;">KaRACHI CAMERA CENTER</a>
    </div>
    


    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

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
		<li><a href="<?=base_url('index.php/home/orders');?>">My Orders</a></li>
			<li><a href="<?=base_url('index.php/cart')?>">My Cart</a></li>

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