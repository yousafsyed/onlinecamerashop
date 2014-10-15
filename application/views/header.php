<?php
error_reporting(0);

?>




<div style="height:120px;  background-color: rgb(116, 119, 129);">
    <div style="display: inline-block; width: 50%;">
        <img src="<?= base_url() ?>public/images/tiny/others.jpg" style="height:100px;padding: 10px;margin-left: 20px;"/>
    </div>
    <?php
    if (!$this->session->userdata("user_id")):?>
    <div style="display:inline-block;float: right; padding:20px">
        <form id="login_form" class="navbar-form navbar-right" role="login">
        		<div class="form-group">
        		<input type="text" name="useremail" class="form-control" placeholder="Majid@gmail.com">
        		<input type="password" name="userpassword" class="form-control" placeholder="type password">
        		<button type="submit" id="login_btn" class="btn btn-default">Submit</button>
                </div>
        	</form>
            
            <div ><div style="float:right;Width:85px">
                <a href="<?php echo base_url('')?>" style="padding:10px;color:White">Register</a>
            </div>
            </div>
    </div>
    
    <?php
        endif;
    ?>
</div>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="/* float: left; */ margin-bottom: 80px !important;position: initial;width: 100%;">

<!-- <div style="background-color: red; width: 100%; height: 40px; float: left;"> -->
	
</div>
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    


    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

          </ul>
        </li>
      </ul>

      	<form class="navbar-form navbar-left" style="width: 40%;" role="Search">
						<div class="form-group" style="width: 80%;">
						<input type="text" name="q" style="width:100%;" class="form-control" placeholder="Search">

						</div>
					<button type="submit"  class="btn btn-default">Submit</button>
	</form>
<?php
if ($this->session->userdata("user_id")):?>
<ul class="nav navbar-nav navbar-right">

	<li class="dropdown">
			<a href="#" class="dropdown-toggle navbar-default" style="color: white; font-weight:bold; background-color: #e7e7e7;" data-toggle="dropdown"><?php echo $this->session->userdata("user_name"); 
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