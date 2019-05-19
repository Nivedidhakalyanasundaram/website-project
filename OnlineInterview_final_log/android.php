<?php
include("session-info.php");
include("db.php");
if(empty($_SESSION['login_user']))
{
	header('location: index.php');	
}
if(!empty($_SESSION['test_id']))
{
	unset($_SESSION['test_id']);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Online Exam</title>
<meta http-equiv="Content-Type" content="text/html; "/>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link href="style/reset.css" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
  <link rel="stylesheet" type = "text/css" href ="css/index.css">
<link rel="stylesheet" href="css/style.css">
    <!-- JS FAQ plugin -->
    <script src="js/jquery.min.js"></script>
    <script src="js/script.js"></script>
<style type="text/css">
body{width:90%; margin:auto;min-width:600px; max-width:2000px; font-family:Tahoma, Geneva, sans-serif;}
a{  text-decoration:none; color:#F8F8FF;}
#main_box{
	position:absolute; width:400px;
	height:300px; left:50%; top:50%;
	margin-left:-200px; margin-top:-150px;
 	border:2px solid black;}
header{ 
	color:#fff; text-align:center; font-family:Tahoma, Geneva, sans-serif;
	background-color:rgba(0,51,102,1);
	width:100%;
	height:40px;
	position:absolute;
	top:0px;
	left:0px;
	padding-top:10px;
	border-bottom:1px solid #006;
	}
footer{
	color:#fff; text-align:center; font-family:Tahoma, Geneva, sans-serif;
	background-color:rgba(0,51,102,1);
	width:100%;
	height:30px;
	position:absolute;
	bottom:0px; border-top:1px solid #006;
	left:0px; padding-top:5px;}
.login_box{ 
	width:800px; height:500px; 
	position:absolute; top:50%; left:50%;
	margin-left:-400px; margin-top:-250px;
	text-align:center; border:1px dotted blue;
	}	
.login_box_sub{ 

	width:1150px; height:auto; 
 border:1px dotted blue;
	}
.log_container{ 
	position:absolute; top:10px; right:10px;
	width:300px; height:50px; 
	color:#fff; text-align:center;}
	
	p.serif {
    font-family: "Times New Roman", Times, serif; text-align: justify;  padding:9px;
	 font-size: 18px;
}

.xam_panel{ 
	width:600px; height:280px; padding-top:40px;
	border:1px solid rgba(153,153,153,0.7); background-color:rgba(153,153,153,0.4);
	box-shadow:0 0 10px rgba(153,153,153,0.3);
	margin:0 auto;}
.box_header{color:rgba(0,204,255,1); 
	margin-top:30px; font-size:18px;}

.test_paper{  
	border:1px solid #c4c4c4; text-align:center; margin-top:6px; margin-bottom:9px;
	width:320px; height:40px;
	font-size:15px; padding:4px 4px 4px 4px; border-radius:4px;
	-moz-border-radius:4px; -webkit-border-radius:4px; box-shadow:0px 0px 8px #d9d9d9;
	-moz-box-shadow:0px 0px 8px #d9d9d9; -webkit-box-shadow:0px 0px 8px #d9d9d9;}
.test_paper:focus{ 
	outline:none; border:1px solid #7bc1f7;box-shadow:0px 0px 8px #7bc1f7;
	-moz-box-shadow:0px 0px 8px #7bc1f7; -webkit-box-shadow:0px 0px 8px #7bc1f7;}
.button_start{
	outline:none; width:114px; cursor:pointer;
	font-family:Tahoma, Geneva, sans-serif;
	height:34px;
	font-size:16px; padding:4px 4px 4px 4px; border-radius:4px;
	background-color:#F60; color:#FFF; border:2px double #fff;}
	  #button {  /* Box in the button */
        display: block;
		float:right;		
        width: 190px;
      }

      #button a {
        text-decoration: none;
		color:#036;
		 
      }

      #button ul {
        list-style-type: none;  
      }

      #button .top {
        background-color: #ddd;  
      }

      #button ul li.item {
        display: none;  
      }  

      #button ul:hover .item {  
        display: block;
		margin:5px;
		height:25px;
		color:#036;
        border-top: 1px dashed #00F; border-bottom: 1px dashed #00F;
        background-color: rgba(204,204,204,0.5);;
      }
</style>

<script type="text/javascript" src="js/jquery.1.11.1.min.js"></script>
<script type="text/javascript">
var test_ID=0;
$(document).ready(function() {   

  $(document).on("change", "#test_paper", function() {
	  var selectedValue = $(this).val();
	  var m=$(this).find("option:selected").attr("value");
	  get_duration(m);
  });

var list;
function getQueryVariable(variable)
{
       var vars = list.split("&");
       for (var i=0;i<vars.length;i++) {
          var pair = vars[i].split("=");
          if(pair[0] == variable){return pair[1];}
       }
       return(false);
}


function get_duration(id)
	{ 
		var dataq="Test_Id_local="+id;
		test_ID=id;
		$.ajax({	
				   type: "POST",
				   url: "get_duration.php",
				   data: dataq,
				   success: function(result){
					   if(parseInt(result)!=0)
							{
						list=result;
						var p=getQueryVariable("tym");
						var q=getQueryVariable("qstn");
						$("#duration_o").val("Duration : "+p+" Minutes");
						$("#qstn_no").val("No of Questions : "+q+" ");}
						else{ alert('Please Try again');}
						    }
			   });   			   
	}
}); 


function start_xam()
{	
	if(test_ID==0)//nothing is selected
	{
		alert('Plase Select a Exam First');
	}
	else//all good
	{
		 window.location.assign("start_exam.php");
		 
	}	
}
</script>
</head>
<body>
	<header><txt style=" font-size:24px;">Online Tutorial</txt></header>
        <div style="position:absolute; top:3px; left:3px;">
    	<img src="" width="90" height="auto" />
    </div>
        <div  style="position:absolute; width:50px; height:50px; right:320px; top:4px; " >
    	   <a title="home" id="TakeAction" class="gohome" href="home.php" >
       <img src="image/home.png" width="43" height="auto"  />
    </a>
    </div>
    <div id="log_container" class="log_container">
    <img src="image/user.png" width="30px" height="auto" style="margin-right:10px; float:left;" />
	<mno style="float:left; margin-top:4px;"><?php echo $_SESSION['User_name'];?></mno>
   <!--drop down menu-->
   <div class="actions">
    <div id="button">
      <ul>
        <li class="top">
        	<a style="float:right;" id="TakeAction" class="logout" href="#" >
                <img src="image/gear.png" width="30px" height="auto"  />
            </a></li>
            <br>
            <br>
        <li class="item"><a href="chage_password.php">Change Password</a></li>
        <li class="item"><a href="stud_result.php">View Result</a></li>
        <li class="item"><a href="logout.php">Logout</a></li>
      </ul>
    </div>
    </div>
        
        
    </div>
    <div class="login_box_sub" id="login_box">
	<div id="container">
        <ul class="faq">
            <li class="q"><img src="img/arrow.png"> Android Introduction:</li>
            <li class="a">Android is a complete set of software for mobile devices such as tablet computers,
			notebooks, smartphones, electronic book readers, set-top boxes etc.
			It contains a linux-based Operating System, middleware and key mobile applications.</li>
            
			
			<li class="q"><img src="img/arrow.png">  What is Android?</li>
            <li class="a">Android is a software package and linux based operating system for mobile devices such as tablet computers and smartphones.
			It is developed by Google and later the OHA (Open Handset Alliance). Java language is mainly used to write the android code even though other languages can be used.</li>
            <li class="q"><img src="img/arrow.png"> Features of Android?</li>
            <li class="a">After learning what is android, let's see the features of android. The important features of android are given below:
It is open-source.Anyone can customize the Android Platform.There are a lot of mobile applications that can be chosen by the consumer.</li>
          

		  <li class="q"><img src="img/arrow.png"> Question1?</li>
            <li class="a">Answer</li>
            
		  <li class="q"><img src="img/arrow.png"> Question1?</li>
            <li class="a">Answer</li>
			
		  <li class="q"><img src="img/arrow.png"> Question1?</li>
            <li class="a">Answer</li>
			
		  <li class="q"><img src="img/arrow.png"> Question1?</li>
            <li class="a">Answer</li>
			
		  <li class="q"><img src="img/arrow.png"> Question1?</li>
            <li class="a">Answer</li>
			
		  <!--<li class="q"><img src="img/arrow.png"> Question1?</li>
            <li class="a">Answer</li>
			
		  <li class="q"><img src="img/arrow.png"> Question1?</li>
            <li class="a">Answer</li>
			
		  <li class="q"><img src="img/arrow.png"> Question1?</li>
            <li class="a">Answer</li>-->
			
			
        </ul>
    </div>
	
    </div>
    

</body>
<footer><h5>Online Tutorial 2018 | All Rights Reserved</h5></footer>
</html>