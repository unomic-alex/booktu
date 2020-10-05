<?php 

    error_reporting(E_ALL); 
    ini_set('display_errors',1); 

    include('dbcon.php');


    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");


    if( (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) || $android )
    {

        // 안드로이드 코드의 postParameters 변수에 적어준 이름을 가지고 값을 전달 받습니다.

        $writer_id=$_POST['writer_id'];
        $isbn=$_POST['isbn'];
        $title=$_POST['title'];
        $content=$_POST['content'];

        if(!isset($errMSG)) 
        {
            try{
                $stmt = $con->prepare('INSERT INTO report(writer_id, isbn, title, content) VALUES(:writer_id, :isbn, :title, :content)');
                $stmt->bindParam(':writer_id', $writer_id);
                $stmt->bindParam(':isbn', $isbn);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':content', $content);

                if($stmt->execute())
                {
                    $successMSG = "새로운 독후감을 추가했습니다.";
                }
                else
                {
                    $errMSG = "독후감 추가 에러";
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
                Writer_id: <input type = "text" name = "writer_id" />
                Isbn: <input type = "text" name = "isbn" />
                Title: <input type = "text" name = "title" />
                Content: <input type = "text" name = "content" />
                <input type = "submit" name = "submit" />
            </form>
       
       </body>
    </html>
<?php 
    }
?>
