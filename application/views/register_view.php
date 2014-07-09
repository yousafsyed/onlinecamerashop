<!DOCTYPE html>
<html>
<head>
	<title><?php echo $page_title?></title>
</head>
<body>
<form id="register_form">
	Username:<input name="username" type="text"><br>
	Password:<input name="password" type="password"><br>
    Password confirm<input name="password2" type="password"><br>
    email:<input id="email" name="email" type="email"><span id="email_message"></span><br>
    mobile No:<input id="mobile" name="mobile" type="number"><span id="mobile_message"></span><br>
    address:<input name="address" type="text"><br>

	<input id="register_btn" type="submit">
</form>
<div id="message"></div>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
$(document).ready(function(){
    // register user
    $("#register_btn").click(function(e){
        e.preventDefault();
        $.ajax({
            url :"http://localhost:8080/onlinecamerashop/index.php/home/register_request",
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
            url :"http://localhost:8080/onlinecamerashop/index.php/home/checkemail",
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
            url :"http://localhost:8080/onlinecamerashop/index.php/home/checkmobile",
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
</body>
</html>