<?php  
error_reporting(E_ALL); 
ini_set('display_errors',1); 

include('dbcon.php');

//POST 값을 읽어온다.
$id =isset($_POST['id']) ? $_POST['id'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android"); 

$sql="select * from member where id='$id' and password='$password'";

// 변경 코드
$response = array();
$posts = array();
$result=mysql_query($sql);

while($row=mysql_fetch_array($result)) {
	$id=$row['id'];
	$password=$row['password'];
	$nickname=$row['nickname'];
	$email=$email['email'];
	
	$posts[] = array('id'=>$id,
			 'password'=>$password,
			 'nickname'=>$nickname,
			 'email'=>$email);
}

$response['posts'] = $posts;
echo json_encode($response);

// 변경 코드 끝

/*
$stmt = $con->prepare($sql);
$stmt->execute();
 
if ($stmt->rowCount() == 0){
    echo "계정을 찾을 수 없습니다.";
} else{

   	$data = array(); 
	extract($row);

	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($data, 
        	array('id'=>$row["id"],
        		'password'=>$row["password"],
        		'nickname'=>$row["nickname"],
			'email'=>$row["email"]
	            ));
	}

        if (!$android) {
            echo "<pre>"; 
            print_r($data); 
            echo '</pre>';
        }else
        {
        	header('Content-Type: application/json; charset=utf8');
        	echo json_encode(array("data"=>$data), JSON_UNESCAPED, UNICODE);
		mysqli_close($con);
        }
    }
*/
?>



<?php

$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

if (!$android){
?>

<html>
   <body>
   
      <form action="<?php $_PHP_SELF ?>" method="POST">
         아이디: <input type = "text" name = "id" />
         패스워드: <input type = "text" name = "password" />
         <input type = "submit" />
      </form>
   
   </body>
</html>
<?php
}

   
?>
