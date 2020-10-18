<?php  
error_reporting(E_ALL); 
ini_set('display_errors',1); 

include('dbcon.php');

//POST 값을 읽어온다.
$title=isset($_POST['title']) ? $_POST['title'] : '';

$sql="delete from report where title='$title'";

$stmt=$con->prepare($sql);
$stmt->execute();
	
header('Content-Type: application/json; charset=utf8');
echo "string return";

?>
