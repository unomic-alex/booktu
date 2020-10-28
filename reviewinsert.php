<?php
$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

if (!$android){
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
