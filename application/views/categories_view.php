<html>
<head>
<title></title>
<meta name="" content="">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap-theme.min.css"') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/style.css') ?>">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="<?= base_url('public/js/casousel.js') ?>"></script>
<!-- Latest compiled and minified JavaScript -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/js/nivo_style.css" />
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>public/js/nivo_script.js"></script>
    
<script>
function UrlExists(url)
{
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}

</script>
</head>
<body>

<div id="message" style="display:none;margin:0;border-radius:0; position: fixed;
top: 51;
width: 100%;
z-index: 10000" class="alert alert-danger fade in" role="alert">

      <span class="messageclass"></span>
</div>



<?php $this->load->view('header.php'); ?>


<div class="container">
<div class="row">


<div class = "landscape_header"> categories Products</div>
    <div id="latest_products">
        <?php
        echo "<ul>";
        foreach($products as $product)
        {
            echo '<div class="col-md-3 product_container">
            <img src="'.base_url($product['image']).'" alt="canon"><div class="product-name"><a href="">'.$product['p_name'].'</a></div><div><a href="">'.$product['p_price'].'<span> EUR</span></a></div><div class="buttons_p"><a href=""><button class="addtocart btn btn-primary btn-xs">Add To Cart</button></a></div></div>';
        }
         echo "</ul>";
        
        
        ?>
    </div>
</div>







</body>
</html>