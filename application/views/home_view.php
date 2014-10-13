<html>
<head>
<title></title>
<meta name="" content="">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/bootstrap-theme.min.css"') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/style.css') ?>">
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
// trigger load event
$(window).load(function() {
	// load all categories
		$.ajax({
			 url :"<?php echo base_url('index.php/categories/all') ?>",
            type:"GET",
            dataType:"json",
            success:function(data){

            	if(typeof(data.error) == 'undefined') {

					var categoriesData = '<a class="btnprev"><span class="glyphicon glyphicon-chevron-left"></span></a><a class="btnnext"><span class="glyphicon glyphicon-chevron-right"></span></a><ul style="display:none">';
								$.each(data, function( index, value ) {
										var url;


									 if(UrlExists('<?= base_url() ?>public/images/categories/'+value.c_id+'/image.jpg') == false){
					            		 	url = '<?= base_url() ?>public/images/categories/defualt/image.png';
					            		 }else{
					            		 	url = '<?= base_url() ?>public/images/categories/'+value.c_id+'/image.jpg';
					            		 }

								  	categoriesData += '<li><div class="col-md-3 product_container"> <img src="'+url+'" alt="'+value.c_name+'"><div class="product-name">'+value.c_name+'</div><div class="buttons_p"><button class="btn btn-default"><a href="<?= base_url("index.php/categories/categ") ?>/'+value.c_id+'">See More </button></div></div></li>';
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
				 url :"<?php echo base_url('index.php/products/latest') ?>",
	            type:"GET",
	            dataType:"json",
	            success:function(data){

	            	if(typeof(data.error) == 'undefined') {

						var latestproductsData = '<a class="btnprev"><span class="glyphicon glyphicon-chevron-left"></span></a><a class="btnnext"><span class="glyphicon glyphicon-chevron-right"></span></a><ul style="display:none">';
									$.each(data, function( index, value ) {
											var url;

										 if(UrlExists('<?= base_url() ?>public/images/products/'+value.p_id+'/image.jpg') == false){
						            		 	url = '<?= base_url() ?>public/images/products/defualt/image.png';
						            		 }else{
						            		 	url = '<?= base_url() ?>public/images/products/'+value.p_id+'/image.jpg';
						            		 }

									  	latestproductsData += '<li data-pid= "'+value.p_id+'"><div class="col-md-3 product_container"> <img src="'+url+'" alt="'+value.p_name+'"><div class="product-name"><a href="<?= base_url("index.php/item") ?>/'+value.p_id+'">'+value.p_name+'</div><div> <span> Rs: '+value.p_price+'</span></div><div class="buttons_p"><button class="addtocart btn btn-primary btn-xs">Add To Cart</button></div></div></div></li>';
                                        console.log("<?= base_url("index.php/item") ?>/"+value.p_id);
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
            url :"<?php echo base_url('index.php/home/login_request') ?>",
            type:"POST",
            data:$("#login_form").serialize(),
            dataType:"json",
            success:function(data){
            	$("#login_btn").removeAttr('disabled');

                if(typeof(data.error) == "undefined"){
                    setTimeout(function(){
                        window.location = "<?php echo base_url('index.php/home') ?>"
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


//========================= add item to cart

$(document).on('click','.addtocart',function(){
	var self = $(this);
	var pid = self.parents('li').data('pid');
	self.attr('disabled','disabled');
	self.text('Processing...');


	$.ajax({
            url :"<?php echo base_url('index.php/cart/add') ?>",
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


$('#slider').nivoSlider();

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



<?php $this->load->view('header.php'); ?>

<?php $this->load->view('slider.php'); ?>






<div class="row">

	   <div class="landscape_header col-6" style="margin-top: 60px; font-weight: bold; font-size: 15px" > Categories </div>
			<div id="categories" >
            <img class="loader" src="<?= base_url('public/images/loader.gif') ?>">
            </div>
</div>
<div class="row">


		<div class = "landscape_header"> Latest Products </div>
		<div id="latest_products">

			<img class="loader" src="<?= base_url('public/images/loader.gif') ?>">

			</div>
</div>
<div class="row">


		<div class="landscape_header"> Most View Products </div>
		<div id="latest_products" style="width: 1000px; height: 250px; visibility: visible; overflow: hidden; position: relative;"><a class="btnprev" style="position: absolute; top: 50%; z-index: 23;"><span class="glyphicon glyphicon-chevron-left"></span></a><a class="btnnext" style="position: absolute; top: 50%; z-index: 23; left: 97%;"><span class="glyphicon glyphicon-chevron-right"></span></a><ul style="list-style: none; padding: 0px; width: 408px; left: 0px; position: absolute;"><li data-pid="5"><div class="col-md-3 product_container"> <img src="http://localhost:8080/onlinecamerashop/public/images/products/5/image.jpg" alt="Camera Lense for Canon"><div class="product-name"> <a href="http://localhost:8080/onlinecamerashop/index.php/item/5">Camera Lense for Canon</a></div><div><a href="http://localhost:8080/onlinecamerashop/index.php/item/5">30<span> EUR</span></a></div><div class="buttons_p"><a href="http://localhost:8080/onlinecamerashop/index.php/item/5"><button class="addtocart btn btn-primary btn-xs">Add To Cart</button></a></div></div></li><li data-pid="4"><div class="col-md-3 product_container"><a href="http://localhost:8080/onlinecamerashop/index.php/item/5"> <img src="http://localhost:8080/onlinecamerashop/public/images/products/4/image.jpg" alt="Camera"></a><div class="product-name"><a href="http://localhost:8080/onlinecamerashop/index.php/item/5"></a><a href="http://localhost:8080/onlinecamerashop/index.php/item/4">Camera</a></div><div><a href="http://localhost:8080/onlinecamerashop/index.php/item/4">100<span> EUR</span></a></div><div class="buttons_p"><a href="http://localhost:8080/onlinecamerashop/index.php/item/4"><button class="addtocart btn btn-primary btn-xs">Add To Cart</button></a></div></div></li></ul></div>
        </div>

</div>
</div>



<?php $this->load->view('footer.php'); ?>


</body>
</html>