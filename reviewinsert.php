<?php 

    error_reporting(E_ALL); 
    ini_set('display_errors',1); 

    include('dbcon.php');


    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");


    if( (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) || $android )
    {

        // 안드로이드 코드의 postParameters 변수에 적어준 이름을 가지고 값을 전달 받습니다.

        $writer_id=$_POST['writer_id'];
        $title=$_POST['title'];
        $content=$_POST['content'];
	$book_title=$_POST['book_title'];
	$book_image=$_POST['book_image'];
	$book_publisher=$_POST['book_publisher'];
	$book_author=$_POST['book_author'];

        if(!isset($errMSG)) 
        {
            try{
                $stmt = $con->prepare('INSERT INTO report(writer_id, title, content, book_title, book_image, book_publisher, book_author) VALUES(:writer_id, :title, :content, :book_title, :book_image, :book_publisher, :book_author)');
                $stmt->bindParam(':writer_id', $writer_id);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':content', $content);
                $stmt->bindParam(':book_title', $book_title);
                $stmt->bindParam(':book_image', $book_image);
		$stmt->bindParam(':book_publisher', $book_publisher);
		$stmt->bindParam(':book_author', $book_author);

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
                Title: <input type = "text" name = "title" />
                Content: <input type = "text" name = "content" />
		Book_title: <input type = "text" name = "book_title" />
                Book_image: <input type = "text" name = "book_image" />
		Book_publisher: <input type = "text" name = "book_publisher" />
		Book_author: <input type = "text" name = "book_author" />

                <input type = "submit" name = "submit" />
            </form>
       
       </body>
    </html>
<?php 
    }
?>
