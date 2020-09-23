<?php 

    error_reporting(E_ALL); 
    ini_set('display_errors',1); 

    include('dbcon.php');


    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");


    if( (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) || $android )
    {

        // 안드로이드 코드의 postParameters 변수에 적어준 이름을 가지고 값을 전달 받습니다.

        $id=$_POST['id'];

        if(!isset($errMSG)) // 모두 입력이 되었다면 
        {
            try{
                // id valid check
                $sql = "SELECT id from member Where id = (:id)";
                $result = mysqli_query($con, $sql);
                
                $stmt = $con->prepare('SELECT id from member Where id = (:id)');
                $stmt->bindParam(':id', $id);
                
                if(mysqli_num_rows($result)>0)
                {
                    print(int(1))
                }

            } catch(PDOException $e) {
                die("Database error: " . $e->getMessage()); 
            }
        }

    }

?>


<?php 
    if (isset($errMSG)) echo $errMSG;
    if (isset($successMSG)) echo $successMSG;

	$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
   
    if( !$android )
    {
?>
    <html>
       <body>

            <form action="<?php $_PHP_SELF ?>" method="POST">
                Id: <input type = "text" name = "id" />
                <input type = "submit" name = "submit" />
            </form>
       
       </body>
    </html>
<?php 
    }
?>
