<html>
<head>
<title></title>
<meta name="" content="">

<div id="message" style="display:none;margin:0;border-radius:0; position: fixed;
top: 51;
width: 100%;
z-index: 10000" class="alert alert-danger fade in" role="alert">

      <span class="messageclass"></span>
</div>

<script>
function UrlExists(url)
{
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}

$(window).load(function() {
	// load all categories
    console.log("asd "+ "<?php echo $id?>");
		$.ajax({
			 url :"<?php echo base_url('index.php/categories/loadCategories') ?>",
            type:"GET",
            data:{"id": "<?php echo $id?>"},
            dataType:"json",
            success:function(data){

            	if(typeof(data.error) == 'undefined') {

					var categoriesData = '<a class="btnprev"><span class="glyphicon glyphicon-chevron-left"></span></a><a class="btnnext"><span class="glyphicon glyphicon-chevron-right"></span></a><ul style="display:none">';
								$.each(data, function( index, value ) {
										var url;
console.log("test "+ value.p_name+"  "+index);
									 if(UrlExists('<?= base_url() ?>public/images/categories/'+value.c_id+'/image.jpg') == false){
					            		 	url = '<?= base_url() ?>public/images/categories/defualt/image.png';
					            		 }else{
					            		 	url = '<?= base_url() ?>public/images/categories/'+value.c_id+'/image.jpg';
					            		 }

								  	categoriesData += '<li><div class="col-md-3 product_container"> <img src="'+url+'" alt="'+value.p_name+'"><div class="product-name">'+value.p_name+'</div><div class="product-price">'+value.p_price+'</div><div class="product-model">'+value.model+'</div></div></li>';
								});
								categoriesData += '</ul>';

							$('#categories').html(categoriesData);
							$('#categories').trigger('categoriesloaded');

            	}
            }
		});
	// load all categories ends here


	
});


$(document).ready(function(){
    
    $('#categories').on('categoriesloaded',function(){

	$('#categories').casrousel();
	$('#categories ul').fadeIn(500);
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
<div>
<img src="<?= base_url() ?>public/images/categories/defualt/image.png" style="width: 200px; height: 200px;" />

</div>
<div id="categories">

				<img class="loader" src="<?= base_url('public/images/loader.gif') ?>">

			</div>
            
            
            





</body>
</html>