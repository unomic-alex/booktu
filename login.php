<?php  
error_reporting(E_ALL); 
ini_set('display_errors',1); 

include('dbcon.php');

//POST 값을 읽어온다.
$id=isset($_POST['id']) ? $_POST['id'] : '';
$password=isset($_POST['password']) ? $_POST['password'] : '';
$android=strpos($_SERVER['HTTP_USER_AGENT'], "Android"); 

$sql="select * from member where id='$id' and password='$password'";

$stmt=$con->prepare($sql);
$stmt->execute();
 
if ($stmt->rowCount() == 0){
    echo "계정을 찾을 수 없습니다.";
	
} else{

   	$data=array(); 
	// extract($row);

	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        	array_push($data,array('id'=>$row["id"],
        			'nickname'=>$row["nickname"],
				'email'=>$row["email"]));
	}
	
	header('Content-Type: application/json; charset=utf8');
	echo json_encode(array("data"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
    } 

?>




