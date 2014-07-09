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
    email:<input name="email" type="email"><br>
    mobile No:<input name="mobile" type="number"><br>
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
            url :"",
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
    
});// document ready ends
</script>
</body>
</html>