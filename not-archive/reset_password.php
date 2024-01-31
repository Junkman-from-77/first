<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $reg_email = htmlspecialchars(trim($_POST['reg_email']));

    if(empty($reg_email)){  //если емейл не введён
        $error_reg_email = 'Введите емейл';
    }else{  //если адрес указан
        try{    //подключение к БД и делается выборка по указанному емейлу
            $host = 'localhost';
            $db_name = 'f0799572_metro';
            $login_db = 'f0799572_metro';
            $password = 'er2k1078tch26';

            $pdo = new PDO("mysql:host=$host;dbname=$db_name", $login_db, $password);

            $query = 'SELECT email FROM users WHERE email = ?';
            $result = $pdo->prepare($query);
            $result->execute(array($reg_email));
            $result = $result->rowCount();

            if($result){    //если указан мейл, котор есть в бд, сгенерить новый пароль
                //генерир. случайный пароль
                $chars = 'qazwsxedcrfvtgbyhnujmikolpQAZWSXEDCRFVTGBYHNUJMIKOLP';
                $array = str_split($chars);
                shuffle($array);
                $str = implode($array);
                $password = substr($str, 0, 15);
                //  отправка письма с паролем на указанный Ю мейл
                $mail = 'Вы запросили восстановление пароля. 
                Войти на сайт вы можете используя указанный пароль: ' . $password . '
                Для обеспечения безопасности рекомендуем после входа в личный кабнет изменить
                пароль';

                mail($reg_mail, 'Восстановление пароля', $mail);

                //хэширование пароля и запись его в бд
                $password = password_hash($password, PASSWORD_DEFAULT);
                $query = 'UPDATE users SET password = ? WHERE email = ?';
                $result = $pdo->prepare($query);
                $result->execute(array($password, $reg_email));

                if(!$result){
                    $error_reg_email = 'При восстановлении пароля произошла ошибка, попр. позже';
                }else{
                    $error_reg_email = 'На указанный адрес электронной почты был отправлен пароль 
                    для восстановления доступа.
                    <a href="enter.php">Перейти на страницу для входа</a>';
                }

            }else{
                $error_reg_email = 'Указанный адрес электронной почты не зарегистрирован';
            }
            
        }catch(PDOException $e){
            echo $e->getMessage();
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Восстановление пароля</title>
    <link rel="stylesheet" type="text/css" href="style-reg/style-reg.css">
</head>
<body>
    <div id="page">
        <form action="" method="POST">
            <label for="reg_email">Введите адрес электронной почты,
                указанный при регистрации</label><br>
            <input type="text" name="reg_email"><br>
            <input type="submit" id="send" value="Восстановить пароль">
            <p class="error"><?php echo $error_reg_email;?></p>
        </form>
    </div>
</body>
</html>