<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!empty($_POST['search'])){
            
            $search = htmlspecialchars(trim($_POST['search']));
            
            $host = 'localhost';
            $db_name = 'f0799572_metro';
            $login_db = 'f0799572_metro';
            $password = 'er2k1078tch26';
            $pdo = new PDO("mysql:host=$host;dbname=$db_name", $login_db, $password);
        
            $query = 'SELECT author, title, instrument, file FROM notes WHERE author =?';
            $result = $pdo->prepare($query);
            $result->execute(array($search));
    
            echo '<div class="content">';
            while($note = $result->fetch()){
                echo '<div class="column1">';
                echo "<p>$note[author]</p>";
                echo '</div>';
    
                echo '<div class="column2">';
                echo "<p>$note[title]</p>";
                echo '</div>';
    
                echo '<div class="column3">';
                echo "<p>$note[instrument]</p>";
                echo '</div>';
    
                echo '<div class="column4">';
                echo '<a href="' . $note['file'] . '" target="blank">Просмотр нот</a>';
                echo '<a href="' . $note['file'] . '" target="blank" download="">Скачать в PDF</a>';
                echo '</div>';
            }
            echo '</div>';
            }else{
    
            }
    }else{
    
    }
?>