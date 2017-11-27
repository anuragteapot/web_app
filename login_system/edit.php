<?php
session_start();

// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 3600);
// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(3600);
include_once 'includes/dbh.inc.php';

$user_c=mysqli_real_escape_string($conn ,$_GET['username']);
$post=mysqli_real_escape_string($conn ,$_GET['post']);

if(!isset($_SESSION['u_username']))
{
header("Location: includes/error.inc.php?error user ");
}

$username=$_SESSION['u_username']; 

$sql="SELECT * FROM uploaded_image WHERE username='$username' AND id='$post'";
$result=mysqli_query($conn,$sql);
$row = @mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  
  <meta charset="UTF-8">
  <title>Edit Post</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/sign_style.css">

<style >

body
  {background-image: url("images/header.jpg");}

#a{
    color: #EF3B3A;
    text-decoration: none;
    font-size: 15px;
  }

 </style>

</head>

<body>

<div class="inner">

<?php
include 'includes/alert.inc.php';
?>

<div class="container">

<div class="info">
    <h1 style="color: white;">Edit Your Post</h1><span>
  </div>

</div>

<div class="form" style="max-width: 800px!important">

  <div class="thumbnail">
  
    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg"/>

  </div>
 
 <?php 

 echo' <form class="forgot-form" action="includes/edit.inc.php?post='.$post.'&username='.$user_c.'" method="POST" enctype="multipart/form-data">
   
    <p class="message"></p>';

 
 
 echo'<input type="file" name="image" multiple /><br><br>
    
    <input type="text" name="title" placeholder="Title" value='.$row['title'].'><br>
    
    <textarea type="message" cols="100" rows="20" placeholder="Message.." name="message" required="" >'.$row['texts'].'</textarea><br><br>

    <input style="background-color:#EF3B3A;color: white" type="submit" name="submit" value="Update Post"> ';
?>



 <br> 
 <br>
 <p class="message"><a id="a" href="index.php">Cancel</a></p>
 
  </form>

</div>

</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="js/index.js"></script>

</body>


</html>