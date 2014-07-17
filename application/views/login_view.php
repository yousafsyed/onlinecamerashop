<!DOCTYPE html>
<html>
<head>
	<title><?php echo $page_title?></title>
</head>
<body>
<form id="login_form">
	Username:<input name="useremail" type="text"><br>
	Password:<input name="userpassword" type="password"><br>
	<input id="login_btn" type="submit">
</form>



<div id="message"></div>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
$(document).ready(function(){
    // login user
    $("#login_btn").click(function(e){
        e.preventDefault();
        $.ajax({
            url :"http://localhost:8080/onlinecamerashop/index.php/home/login_request",
            type:"POST",
            data:$("#login_form").serialize(),
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

    });// login function ends
    


    
});// document ready ends
</script>
</body>
</html>