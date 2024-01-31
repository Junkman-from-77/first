<?php
try{
    $host = 'localhost';
    $db_name = 'f0799572_metro';
    $login_db = 'f0799572_metro';
    $password = 'er2k1078tch26';

    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $login_db, $password);

}catch(PDOException $e){
    echo $e->getMessage();
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){ // если данные отправлены методом POST

    list($errors, $input) = validate_form();// забор данных и ошибок

    if($errors){// если есть ошибки
        show_form($errors, $input);// показ форм и вывод ошибок
    }else{
        process_form($input);// отправка формы с заполненными данными
    }

}else{// если форма загружена впервые, вывести пустую форму для заполнения
    show_form();
}

function validate_form(){       //проверка формы

    $errors = [];
    $input = [];

    $input['login'] = htmlspecialchars(trim($_POST['login']));
    $input['password'] = htmlspecialchars(trim($_POST['password']));


    // проверка логина
    function validate_login($login){
        $regexp = "/^[a-z][0-9a-z]*$/i";    //только лат. буквы, цифры. Начинаться с буквы.

        if(strlen($login) == 0){    // если отправлено пустое поле
            return "Введите имя пользователя";
        }elseif(strlen($login) < 3){    // если длина меньше 3 байт
            return "Имя пользователя должно быть не менее 3 символов";
        }elseif(!preg_match($regexp, $login)){  // проверка на соответствие рег. выраж-ю
            return "Имя пользователя должно содержать только латинские буквы или цифры
            и должно начинаться с буквы";
        }
        try{    //проверка логина по БД
            $query = "SELECT login FROM users WHERE login = :login";
            $result = $GLOBALS['pdo']->prepare($query);
            $result->bindParam(':login', $login);
            $result->execute();
            $result = $result->rowCount();
        }catch(PDOException $e){
            print $e->getMessage();
            exit();
        }

        if($result == false){   //проверка на уникальность
            return "Такой логин не зарегистрирован";
        }else{
            
        }
    }
    if(validate_login($input['login'])){    //запуск проверки
        $errors['login'] = validate_login($input['login']);// если есть ошибки, занести в массив
    }

    // проверка пароля
    function validate_password($password, $login){
        $regexp = "/^.{6,}$/ui";

        if (strlen($password) == 0){
            return "Введите пароль";
        }elseif(!preg_match($regexp, $password)){
            return "Пароль должен состоять минимум из 6 произвольных символов";
        }

        try{
            $query = "SELECT password FROM users WHERE login = :login";
            $result = $GLOBALS['pdo']->prepare($query);
            $result->bindParam(':login', $login);
            $result->execute();
            $result = $result->fetch();
        }catch(PDOException $e){
            print $e->getMessage();
            exit();
        }

        $hash = password_verify($password, $result['password']);
        if($hash == false){
            return "Пароль неверен";
        }else{
            
        }
    }

    if (validate_password($input['password'], $input['login'])){
        $errors['password'] = validate_password($input['password'], $input['login']);
    }

    return array($errors, $input);

}

// функция отправки данных
function process_form($input){

    session_start();
    $_SESSION['valid_user'] = $input['login'];
    header('Location: index.php');
}

function show_form($errors = ['login' => NULL, 'password' => NULL], $input = ['login' => NULL, 'password' => NULL]){
    echo <<<_HTML_
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Вход</title>
            <link rel="stylesheet" type="text/css" href="style-reg/style-reg.css">        
        </head>
        <body>
            <div id="page">
            <form method="POST" action="$_SERVER[PHP_SELF]">
                <p>Вход:</p>
                <div class="flex">
                    <label for="login">Логин:</label>
                    <input type="text" name="login" class="short" value="$input[login]">
                    <span class="error">$errors[login]</span>
                </div>
                <div class="flex">
                    <label for="password">Пароль:</label>
                    <input type="password" name="password" class="short">
                    <span class="error">$errors[password]</span>
                </div>
                <input type="submit" id="send" value="Отправить">
         <!--       <a href="reset_password.php">Забыли пароль?</a>-->
            </form>
        </body>
    </html>
    _HTML_;
}
?>