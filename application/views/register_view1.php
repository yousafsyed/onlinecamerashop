<html><head>
	<title>&lt;?php echo $page_title?&gt;</title>
</head>
 <body style="background-color: #000000; background-image: url('wp1.jpg'); color: white;background-size: cover;">
<h1 style="text-align: center;"> Registration Form </h1>

<form id="register_form" style="width: 350px;margin-left: auto;margin-right: auto;background-color: rgba(255,255,255,0.3);padding: 20px;border-radius: 15px;box-shadow: 0px 0px 22px white;">
  <div style="padding: 10px;width: 95%;"><label>Username:</label>
<input name="username" type="text" style="width: 100%; padding: 5px;border-radius: 7px;border: 1px solid white;color: black;">
  </div>
  
  <div style="padding: 10px;width: 95%;">
  <label>Password:</label><input name="password" type="password" style="width: 100%;"></div><div style="padding: 10px;width: 95%;
">
  <label>Password confirm</label><input name="password2" type="password" style="
    width: 100%;
"></div><div style="
    padding: 10px;
    width: 95%;
">
  <label>email:</label><input id="email" name="email" type="email" style="
    width: 100%;
"><span id="email_message"></span></div><div style="
    padding: 10px;
    width: 95%;
">
  <label>mobile No:</label><input id="mobile" name="mobile" type="number" style="
    width: 100%;
"><span id="mobile_message"></span></div><div style="
    padding: 10px;
    width: 95%;
">
  <label>address:</label><input name="address" type="text" style="
    width: 100%;
"></div>

	<div style="
    padding: 10px;
    width: 95%;
">
  <button id="register_btn" type="submit" style="
    width: 100%;
    padding: 8px;
    background-color: rgba(0,0,0,0.2);
    border: 1px solid white;
    color: white;
    border-radius: 10px;
">Register</button>
</div>
</form>
<div id="message"></div>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
$(document).ready(function(){
    // register user
    $("#register_btn").click(function(e){
        e.preventDefault();
        $.ajax({
            url :"<?=base_url('index.php/home/register_request')?>",
            type:"POST",
            data:$("#register_form").serialize(),
            dataType:"json",
            success:function(data){
                if(typeof(data.error) == "undefined"){
                  
                    $("#message").text(data.success);
                    $("#message").css("color","green");
                }else{
                    $("#message").text(data.error);
                      $("#message").css("color","red");
                }
            }
            
        });

    });// resgiter function ends
    // check if email exist
     $("#email").focusout(function(){
         $.ajax({
            url :"<?=base_url('index.php/home/checkemail')?>",
            type:"POST",
            data:{email:$("#email").val()},
            dataType:"json",
            success:function(data){
                if(typeof(data.error) == "undefined"){
                  
                    $("#email_message").text(data.success);
                    $("#email_message").css("color","green");
                }else{
                    $("#email_message").text(data.error);
                      $("#email_message").css("color","red");
                }
            }
            
        });

     });// check email exist ends
        // check if email exist
     $("#mobile").focusout(function(){
         $.ajax({
            url :"<?=base_url('index.php/home/checkmobile')?>",
            type:"POST",
            data:{mobile:$("#mobile").val()},
            dataType:"json",
            success:function(data){
                if(typeof(data.error) == "undefined"){
                  
                    $("#mobile_message").text(data.success);
                    $("#mobile_message").css("color","green");
                }else{
                    $("#mobile_message").text(data.error);
                      $("#mobile_message").css("color","red");
                }
            }
            
        });

     });// check email exist ends
    
});// document ready ends
</script>

</body></html><html><head>
	<title><?php echo $page_title?></title>
</head>
 <body style="background-color: #000000; background-image: url('wp1.jpg'); color: white;background-size: cover;">
<h1 style="text-align: center;"> Registration Form </h1>

<form id="register_form" style="width: 350px;margin-left: auto;margin-right: auto;background-color: rgba(255,255,255,0.3);padding: 20px;border-radius: 15px;box-shadow: 0px 0px 22px white;">
  <div style="padding: 10px;width: 95%;"><label>Username:</label>
<input name="username" type="text" style="width: 100%;">
  </div>
  
  <div style="padding: 10px;width: 95%;">
  <label>Password:</label><input name="password" type="password" style="width: 100%;"></div><div style="padding: 10px;width: 95%;
">
  <label>Password confirm</label><input name="password2" type="password" style="
    width: 100%;
"></div><div style="
    padding: 10px;
    width: 95%;
">
  <label>email:</label><input id="email" name="email" type="email" style="
    width: 100%;
"><span id="email_message"></span></div><div style="
    padding: 10px;
    width: 95%;
">
  <label>mobile No:</label><input id="mobile" name="mobile" type="number" style="
    width: 100%;
"><span id="mobile_message"></span></div><div style="
    padding: 10px;
    width: 95%;
">
  <label>address:</label><input name="address" type="text" style="
    width: 100%;
"></div>

	<div style="
    padding: 10px;
    width: 95%;
">
  <button id="register_btn" type="submit" style="
    width: 100%;
    padding: 8px;
    background-color: rgba(0,0,0,0.2);
    border: 1px solid white;
    color: white;
    border-radius: 10px;
">Register</button>
</div>
</form>
<div id="message"></div>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
$(document).ready(function(){
    // register user
    $("#register_btn").click(function(e){
        e.preventDefault();
        $.ajax({
            url :"<?=base_url('index.php/home/register_request')?>",
            type:"POST",
            data:$("#register_form").serialize(),
            dataType:"json",
            success:function(data){
                if(typeof(data.error) == "undefined"){
                  
                    $("#message").text(data.success);
                    $("#message").css("color","green");
                }else{
                    $("#message").text(data.error);
                      $("#message").css("color","red");
                }
            }
            
        });

    });// resgiter function ends
    // check if email exist
     $("#email").focusout(function(){
         $.ajax({
            url :"<?=base_url('index.php/home/checkemail')?>",
            type:"POST",
            data:{email:$("#email").val()},
            dataType:"json",
            success:function(data){
                if(typeof(data.error) == "undefined"){
                  
                    $("#email_message").text(data.success);
                    $("#email_message").css("color","green");
                }else{
                    $("#email_message").text(data.error);
                      $("#email_message").css("color","red");
                }
            }
            
        });

     });// check email exist ends
        // check if email exist
     $("#mobile").focusout(function(){
         $.ajax({
            url :"<?=base_url('index.php/home/checkmobile')?>",
            type:"POST",
            data:{mobile:$("#mobile").val()},
            dataType:"json",
            success:function(data){
                if(typeof(data.error) == "undefined"){
                  
                    $("#mobile_message").text(data.success);
                    $("#mobile_message").css("color","green");
                }else{
                    $("#mobile_message").text(data.error);
                      $("#mobile_message").css("color","red");
                }
            }
            
        });

     });// check email exist ends
    
});// document ready ends
</script>

</body></html>