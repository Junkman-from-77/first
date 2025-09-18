<?php
    session_start();

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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Нотный архив</title>
        <meta charset="utf-8">
        <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
        <meta type="description" content="">
        <meta type="keywords" content="">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div id="wrapper">
            <header>
                <div class="logo">
                    <a href="http://ilyawbyand.temp.swtest.ru/">ВЕРНУТЬСЯ НА ГЛАВНУЮ</a>
                </div>
                <div class="enter">
                    <!--<form name="search" action="" method="POST">
                        <div>
                            <label for="search">Поиск по нотам&nbsp;</label>
                            <input type="text" name="search">
                        </div>
                        <div>
                            <input type="submit" name="submit" value="&#128270;">
                        </div>
                    </form>-->
                    <?php
                        if(isset($_SESSION['valid_user'])){
                            if($_SESSION['valid_user'] == 'madcat'){
                                echo '<a href="admin.php">Панель администратора</a>';
                                echo '<a href="exit.php">Выход</a>';
                            }else{
                                echo '<a href="cabinet.php">Личный кабинет</a>';
                                echo '<a href="exit.php">Выход</a>';
                            }
                        }else{
                            echo '<a href="enter.php">Вход</a>';
                            echo '<a href="register.php">Регистрация</a>';
                        }
                    ?>
                </div>
            </header>
            <section>
                <div class="composers">
                    <h3>КАТАЛОГ <br>
                        ПО КОМПОЗИТОРАМ</h3>
                    <div class="alphabet">
                        <a href="?get_rus_1">А</a>
                        <a href="?get_rus_2">Б</a>
                        <a href="?get_rus_3">В</a>
                        <a href="?get_rus_4">Г</a>
                        <a href="?get_rus_5">Д</a>
                        <a href="?get_rus_6">Е</a>
                        <a href="?get_rus_7">Ж</a>
                        <a href="?get_rus_8">З</a>
                        <a href="?get_rus_9">И</a>
                        <a href="?get_rus_10">К</a>
                        <a href="?get_rus_11">Л</a>
                        <a href="?get_rus_12">М</a>
                        <a href="?get_rus_13">Н</a>
                        <a href="?get_rus_14">О</a>
                        <a href="?get_rus_15">П</a>
                        <a href="?get_rus_16">Р</a>
                        <a href="?get_rus_17">С</a>
                        <a href="?get_rus_18">Т</a>
                        <a href="?get_rus_19">У</a>
                        <a href="?get_rus_20">Ф</a>
                        <a href="?get_rus_21">Х</a>
                        <a href="?get_rus_22">Ц</a>
                        <a href="?get_rus_23">Ч</a>
                        <a href="?get_rus_24">Ш</a>
                        <a href="?get_rus_25">Щ</a>
                        <a href="?get_rus_26">Э</a>
                        <a href="?get_rus_27">Ю</a>
                        <a href="?get_rus_28">Я</a>
                    </div>
                </div>
                <div class="main">
                    <div class="content">
                        <div class="column1">
                            <p><span>Композитор</span></p>
                        </div>
                        <div class="column2">
                            <p><span>Произведение</span></p>
                        </div>
                        <div class="column3">
                            <p><span>Инструмент</span></p>
                        </div>
                        <div class="column4">
                            <p><span>Ссылки</span></p>
                        </div>
                    </div>
                    <?php
                        require 'search.php';
                        require 'download/download_1.php';
                        require 'download/download_2.php';
                        require 'download/download_3.php';
                        require 'download/download_4.php';
                        require 'download/download_5.php';
                        require 'download/download_6.php';
                        require 'download/download_7.php';
                        require 'download/download_8.php';
                        require 'download/download_9.php';
                        require 'download/download_10.php';
                        require 'download/download_11.php';
                        require 'download/download_12.php';
                        require 'download/download_13.php';
                        require 'download/download_14.php';
                        require 'download/download_15.php';
                        require 'download/download_16.php';
                        require 'download/download_17.php';
                        require 'download/download_18.php';
                        require 'download/download_19.php';
                        require 'download/download_20.php';
                        require 'download/download_21.php';
                        require 'download/download_22.php';
                        require 'download/download_23.php';
                        require 'download/download_24.php';
                        require 'download/download_25.php';
                        require 'download/download_26.php';
                        require 'download/download_27.php';
                        require 'download/download_28.php';
                    ?>
                </div>
            </section>
        <footer>
            <p>Designed by "Dva pritopa - tri prikhlopa prod".</p>
            <p>Copyright © Junkman</p>
        </footer>
    </div>
    </body>
</html>