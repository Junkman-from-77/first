<?php
session_start();
$login = $_SESSION['valid_user'];

try{
    $host = 'localhost';
    $db_name = 'ilyawbyand';
    $login_db = 'ilyawbyand';
    $password = 'Tr1248OllTr!';
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $login_db, $password);
}catch(PDOException $e){
    echo $e->getMessage();
    exit();
}

try{    //выборка данных по логину

    $query = 'SELECT login, email FROM users WHERE login = ?';


    $result = $pdo->prepare($query);
    $result->execute(array($login));
    $user = $result->fetch();

}catch(PDOException $e){
    echo $e->getMessage();
    exit();
}

if(isset($_POST['edit_password'])){ //изменение пароля

    $edit_password = htmlspecialchars(trim($_POST['edit_password']));

    if(!preg_match('/^.{6,}$/ui', $edit_password)){
        header('Location: cabinet.php?error_edit_password=Пароль должен быть не короче шести символов');
    }else{
        $edit_password = password_hash($edit_password, PASSWORD_DEFAULT);

        $query = "UPDATE users SET password = ? WHERE login = ?";
        $result = $pdo->prepare($query);
        $result->execute(array($edit_password, $user['login']));
        header('Location: cabinet.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Личный кабинет</title>
    <link rel="stylesheet" type="text/css" href="style-reg/style-reg.css">
</head>
<body>

    <div id="main">
        <h3>Здравствуйте, <?php echo $user['login'];?></h3>
        
        <div class="field">
            <p>Ваш логин: <?php echo $user['login'];?></p>
        </div>
        <div class="field">
            <p>Ваша почта: <?php echo $user['email'];?></p>
        </div>

    <!--    <div class="field">
            <a href="?edit_password">Изменить пароль</a>
            <p class="error"><?php echo $_GET['error_edit_password'];?></p>

            <?php   //отображ. формы для изменения пароля
                if(isset($_GET['edit_password'])){
                    echo <<<_HTML_
                    <form action="?" method="post">
                        <div>
                            <label for="edit_password">Введите новый пароль:</label>
                            <input type="password" name="edit_password">
                        </div>
                        <div>
                            <input type="submit" value="Изменить">
                        </div>
                    </form>
                    _HTML_;
                }
            ?>
        </div>-->

        <a href="index.php">На главную</a>
        <a href="exit.php">Выйти</a>
    </div>
</body>
</html>