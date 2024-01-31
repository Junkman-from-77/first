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

    if($_SERVER['REQUEST_METHOD'] == 'POST'){   // если данные отправлены методом POST

        list($errors, $input) = validate_form();    // забираем данные и ошибки из функции проверки

        if($errors){    //если есть ошибки
            show_form($errors, $input); //показ формы и вывод ошибок
        }else{
            process_form($input);   //отправление формы с заполненными данными
        }

    }else{  //если форма загружена впервые, вывести пустую форму для заполнения
        show_form();
    }

//Функция проверки полей формы
function validate_form(){

    //массивы для данных и ошибок
    $errors = [];
    $input = [];

    //забор и чистка данных Ю из глобального массива
    $input['login'] = htmlspecialchars(trim($_POST['login']));
    $input['email'] = htmlspecialchars(trim($_POST['email']));
    $input['password'] = htmlspecialchars(trim($_POST['password']));

    // проверка логина
    function validate_login($login){

        $regexp = "/^[a-z][0-9a-z]*$/i";    //только латинские буквы и цифры
                                            //и должно начинаться с буквы
        if(empty($login)){
            return "Введите имя пользователя";
        }elseif(strlen($login) < 3){
            return "Имя пользователя должно быть не менее трёх символов";
        }elseif(!preg_match($regexp, $login)){
            return "Имя пользователя должно содержать только латинские буквы
                    или цифры и должно начинаться с буквы";
        }

        try{
            $query = "SELECT login FROM users WHERE login = :login";
            $result = $GLOBALS['pdo']->prepare($query);
            $result->bindParam(':login', $login);
            $result->execute();
            $result = $result->rowCount();
        }catch(PDOException $e){
            print $e->getMessage();
            exit();
        }

        if($result){
            return "Этот логин уже занят";
        }
    }

    if(validate_login($input['login'])){
        $errors['login'] = validate_login($input['login']);
    }

    //проверка почты
    function validate_email($email){
        $regexp = "/^.+@.+$/i" ;

        if(empty($email)){
            return "Введите адрес электронной почты";
        }elseif(!preg_match($regexp, $email)){
            return "Адрес электронной почты указан в неверном формате";
        }

        try{
            $query = "SELECT email FROM users WHERE email = :email";
            $result = $GLOBALS['pdo']->prepare($query);
            $result->bindParam(':email', $email);
            $result->execute();
            $result = $result->rowCount();
        }catch(PDOException $e){
            print $e->getMessage();
            exit();
        }

        if($result){
            return "Этот адрес электронной почты уже зарегистрирован";
        }
    }
    if(validate_email($input['email'])){
        $errors['email'] = validate_email($input['email']);
    }

    //проверка пароля
    function validate_password($password){
        $regexp = "/^.{6,}$/ui";

        if(empty($password)){
            return "Введите пароль";
        }elseif(!preg_match($regexp, $password)){
            return "Пароль должен состоять минимум из шести произвольных символов";
        }
    }
    if(validate_password($input['password'])){
        $errors['password'] = validate_password($input['password']);
    }

    /*возврат из функции validate_form() двухмерного массива с ошибками (если есть) и
    данными */
    return array($errors, $input);
}

//функция отправки данных
function process_form($input){
    $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);//хешир. пароля

    try{    //добавление Ю в БД
        $query = 'INSERT INTO users VALUES(NULL, ?, ?, ?)';
        $result = $GLOBALS['pdo']->prepare($query);
        $result->execute(array($input['login'], $input['email'], $input['password']));
    }catch(PDOException $e){
        print $e->getMessage();
        exit();
    }

    session_start();
    $_SESSION['valid_user'] = $input['login'];
    header('Location: index.php');
}   //конец функции проверки формы

//функция отображения формы
function show_form($errors = ['login' => NULL, 'email' => NULL, 'password' => NULL], $input = ['login' => NULL, 'email' => NULL, 'password' => NULL]){

echo <<<_HTML_
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Регистрация</title>
        <link rel="stylesheet" type="text/css" href="style-reg/style-reg.css">
    </head>
    <body>
    <div id="page">
    <form method="POST" action="$_SERVER[PHP_SELF]" enctype="multipart/form-data">
        <p>Регистрация</p>
        <div class="flex">
            <label for="login">Логин:</label>
            <input type="text" name="login" class="long" value="$input[login]" 
            placeholder="Латинские буквы и цифры">
            <span class="error">$errors[login]</span>
        </div>
        <div class="flex">
            <label for="email">Электронная почта:</label>
            <input type="text" name="email" class="short" value="$input[email]">
            <span class="error">$errors[email]</span>
        </div>
        <div class="flex">
            <label for="password">Пароль:</label>
            <input type="password" name="password" class="short" 
            placeholder="Не менее 6 любых символов">
            <span class="error">$errors[password]</span>
        </div>
        <input type="submit" id="send" value="Отправить">
    </form>
    </div>
    </body>
</html>

_HTML_;
} //конец функции отображения формы
?>