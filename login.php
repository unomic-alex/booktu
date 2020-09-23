<?php  
error_reporting(E_ALL); 
ini_set('display_errors',1); 

include('dbcon.php');



//POST 값을 읽어온다.
$id=isset($_POST['id']) ? $_POST['id'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

// 계정정보 검색
$sql="select id, password from member where id='$id' and password='$password'";
$stmt = $con->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() == 0) {
	
	echo "";
	echo "아이디나 비밀번호를 확인하세요.";

}
else {
	
	$data = array();
	
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
	extract($row);
	
	array_push($data,
		array('id'=>$row["id"],
		'password'=>$row["password"]	 
	));
	}
	
        if (!$android) {
            echo "<pre>"; 
            print_r($data); 
            echo '</pre>';
        }else
        {
            header('Content-Type: application/json; charset=utf8');
            $json = json_encode(array("webnautes"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
            echo $json;
        }
	
	
}
?>

<?php

$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

if (!$android){
?>
<html>
   <body>
   
      <form action="<?php $_PHP_SELF ?>" method="POST">
         id: <input type = "text" name = "id" />
         password: <input type = "text" name = "password" />
         <input type = "submit" />
      </form>
   
   </body>
</html>
<?php
}

   
?>
