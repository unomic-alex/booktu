<?php

    error_reporting(E_ALL);
    ini_set('display_errors',1);

    include('dbcon.php');


    if( ($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit']))
    {

        $id=$_POST['id'];
        $password=$_POST['password'];
        $nickname=$_POST['nickname'];
        $email=$_POST['email'];

        if(empty($id)){
            $errMSG = "id 입력하세요.";
        }
        else if(empty($password)){
            $errMSG = "password 입력하세요.";
        }
       else if(empty($nickname)){
            $errMSG = "nickname 입력하세요.";
        }
       else if(empty($email)){
            $errMSG = "email 입력하세요.";
        }


        if(!isset($errMSG))
        {
            try{
                $stmt = $con->prepare('INSERT INTO member(id, password, nickname, email) VALUES(:id, :password, :nickname, :email)');
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':nickname', $nickname);
                $stmt->bindParam(':email', $email);


                if($stmt->execute())
                {
                    $successMSG = "새로운 사용자를 추가했습니다.";
                }
                else
                {
                    $errMSG = "사용자 추가 에러";
                }

            } catch(PDOException $e) {
                die("Database error: " . $e->getMessage());
            }
        }

    }
?>

<html>
   <body>
        <?php
        if (isset($errMSG)) echo $errMSG;
        if (isset($successMSG)) echo $successMSG;
        ?>

        <form action="<?php $_PHP_SELF ?>" method="POST">
            Id: <input type = "text" name = "id" />
            Password: <input type = "text" name = "password" />
            Nickname: <input type = "text" name = "nickname" />
            Email: <input type = "text" name = "email" />

            <input type = "submit" name = "submit" />
        </form>

   </body>
</html>