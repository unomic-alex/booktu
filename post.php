<?php

$con=mysqli_connect("booktu-db.mariadb.database.azure.com","oneso@booktu-db","1little_0714","booktu");
mysqli_set_charset($con,"utf8");

if (mysqli_connect_errno($con))
{

   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$id = $_POST['Id'];
$password = $_POST['Pw'];
$nickname = $_POST['Nickname'];
$email = $_POST['Email'];

$result = mysqli_query($con,"insert into member (id,password,nickname,email) values ('$id','$password','$nickname','$email')");

  if($result){
    echo 'success';
  }

  else{
    echo 'failure';
  }

mysqli_close($con);
?>

