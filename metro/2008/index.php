<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Мосметро: составы, информаторы</title>
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
        
        body{
            margin: 0;
            background: url("../../images/paper-4-3.jpg") repeat;
        }
        
        .wrapper{
            width: 100%;
            min-height: 100%;
            font-family: 'Roboto', sans-serif;
            font-weight: 400;
        }
                
        header{
            padding-top: 15px;
            padding-bottom: 15px;
            padding-left: 30px;
            background: url("../../images/paper-4-4.jpg") repeat;
        }
                
        h1{
            text-align: center;
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
        }
                
        form{
            font-size: 18px;
            margin: 0 auto;
            width: 1240px;
        }
        
        .content{
            font-size: 19px;
            margin: 0 auto;
            width: 1240px;
            display: flex;
            flex-wrap: wrap;
        }
        
        .string1{
            width: 25%;
            border: 3px solid black;
            padding: 5px;
            text-align: center;
            margin-bottom: 1px;
        }
                
        .string2{
            width: 42%;
            border-top: 3px solid black;
            border-bottom: 3px solid black;
            padding: 5px;
            text-align: center;
            margin-bottom: 1px;
        }
                
        .string3{
            width: 29%;
            border: 3px solid black;
            padding-top: 11px;
            padding-right: 5px;
            padding-left: 5px;
            padding-bottom: 5px;
            text-align: center;
            margin-bottom: 1px;
        }
        
        footer{
            margin: 0;
            padding: 10px;
            background: url("../../images/paper-4-4.jpg") repeat;
        }
                
        footer p{
            text-align: center;
            font-size: 20px;
        }
                
        footer ol{
            text-align: center;
            line-height: 24px;
            list-style-type: none;
        }
        
        @media (max-width: 1100px) {
            body{
                margin: 0;
                width: 110%;
            }
            
            .wrapper{
                margin: 0;
                width: 110%;    
            }
            
            header{
                width: 106.45%;
                border-top: 6px solid black;
                border-right: 6px solid black;
                border-bottom: 3px solid black;
                border-left: 6px solid black;
            }
            
            header p{
                font-size: 36px;
            }
            
            h1{
                font-size: 56px;
            }
            
            h3{
                font-size: 44px;
            }
            
            h4{
                font-size: 44px;
            }
            
            form{
                font-size: 44px;
            }
            
            select{
                height: 60px;
                width: 146px;
                font-size: 40px;
            }
            
            .content{
                width: 110%;
            }
            
            .content p{
                font-size: 36px;
            }
            
            .string1{
                width: 110%;
                margin: 0;
                border-top: 3px solid black;
                border-right: 6px solid black;
                border-bottom: 3px solid black;
                border-left: 6px solid black;
            }
            
            .string2{
                width: 110%;
                margin: 0;
                border-top: 3px solid black;
                border-right: 6px solid black;
                border-bottom: 3px solid black;
                border-left: 6px solid black;
            }
            
            .string3{
                width: 110%;
                margin: 0;
                border-top: 3px solid black;
                border-right: 6px solid black;
                border-bottom: 3px solid black;
                border-left: 6px solid black;
            }
            
            audio{
                width: 500px;
                height: 60px;
                font-size: 36px;
            }
            
            footer{
                width: 107.25%;
                border-top: 3px solid black;
                border-right: 6px solid black;
                border-bottom: 6px solid black;
                border-left: 6px solid black;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
    <header>
        <p>Проект в процессе разработки, создаётся с использованием HTML, CSS, JS, PHP, MySQL.</p>
        <p>Исходный код: <a  href="https://github.com/Mad-KoT3/first/tree/main" target="_blank">https://github.com/Mad-KoT3/first/tree/main</a></p>
        <h1>Московский метрополитен: формрование составов и информаторы по состоянию на янв-2008.</h1>
        <form action="" method="GET">
            <label for="year">Выбрать год: </label>
            <select onchange="window.location.href=this.options[this.selectedIndex].value">
                <option VALUE="http://f0799572.xsph.ru/metro/2002/index.php">2002</option>
                <option VALUE="http://f0799572.xsph.ru/metro/2004/index.php">2004</option>
                <option VALUE="http://f0799572.xsph.ru/metro/2005/index.php">2005</option>
                <option VALUE="http://f0799572.xsph.ru/metro/2006/index.php">2006</option>
                <option selected VALUE="http://f0799572.xsph.ru/metro/2008/index.php">2008</option>
            </select>
        </form>
    </header>
    <section>
        <?php
            $host = 'localhost';
            $db_name = 'f0799572_metro';
            $login = 'f0799572_metro';
            $password = 'er2k1078tch26';
        
            $pdo = new PDO("mysql:host=$host;dbname=$db_name", $login, $password);
    
            $query = 'SELECT line_name, depo, informator FROM eigth'; 
            $result = $pdo->query($query);
    
            echo '<div class="content">';
            while($metro = $result->fetch()){
                echo '<div class="string1">';
                echo "<p>$metro[line_name]</p>";
                echo '</div>';
    
                echo '<div class="string2">';
                echo "<p>$metro[depo]</p>";
                echo '</div>';
    
                echo '<div class="string3">';
                echo "<p>$metro[informator]</p>";
                echo '</div>';
            }
            echo '</div>';
        ?>
    </section>
    <footer>
        <p>Информация взята из открытых источников:</p>
        <ol>
            <li><a  href="https://www.youtube.com/@alTerrAlexey" target="_blank">https://www.youtube.com/@alTerrAlexey</a></li>
            <li><a href="https://www.youtube.com/@mtransportx" target="_blank">https://www.youtube.com/@mtransportx</a></li>
            <li><a href="https://www.youtube.com/@wertyinfo" target="_blank">https://www.youtube.com/@wertyinfo</a></li>
            <li><a href="http://vagon.metro.ru/0.htm" target="_blank">http://vagon.metro.ru/0.htm</a></li>
            <li><a href="http://trehgranka.metro.ru/directory.htm" target="_blank">http://trehgranka.metro.ru/directory.htm</a></li>
            <li>И некоторый материал предоставил <a href="https://www.youtube.com/@retro7456" target="_blank">https://www.youtube.com/@retro7456</a></li>
        </ol>
        <p>К архивам, где хранятся (если сохранились, конечно) записи информаторов, начиная с 1972 года, надо ещё пробиться.</p>
    </footer>
    </div>
    <script>
        let audioNL = document.querySelectorAll('audio');
        let audio = Array.apply(null, audioNL);

        audio.forEach(t => {
            let index = audio.indexOf(t);

            t.addEventListener('play', ()=> {
                audio.forEach(subT => {
                    subT !== audio[index] ?
                    (subT.pause(), subT.currentTime = 0) :
                    subT.play()
                })
            })
        });
    </script>
</body>
</html>