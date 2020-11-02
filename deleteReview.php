<?php  
error_reporting(E_ALL); 
ini_set('display_errors',1); 

include('dbcon.php');

//POST 값을 읽어온다.
$article_num=isset($_POST['article_num']) ? $_POST['article_num'] : '';

$sql="DELETE FROM booktu.report WHERE article_num='$article_num";

$stmt=$con->prepare($sql);
$stmt->execute();
	
header('Content-Type: application/json; charset=utf8');
echo "deleted";

?>
