<?php  
error_reporting(E_ALL); 
ini_set('display_errors',1); 

include('dbcon.php');

//POST 값을 읽어온다.
$book_image=isset($_POST['book_image']) ? $_POST['book_image'] : '';

$sql="select book_title, book_author, book_publisher from report where book_image='$book_image'";

$stmt=$con->prepare($sql);
$stmt->execute();
 
if ($stmt->rowCount() == 0){
    echo "책 정보를 찾을 수 없습니다.";
	
} else{

   	$data=array(); 
	// extract($row);

	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        	array_push($data,array('book_title'=>$row["book_title"],
        			'book_author'=>$row["book_author"],
				'book_publisher'=>$row["book_publisher"]));
	}
	
	header('Content-Type: application/json; charset=utf8');
	echo json_encode(array("data"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
    } 

?>
