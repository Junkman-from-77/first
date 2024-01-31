<?php
if(isset($_GET['get_rus_7'])){
        $query = 'SELECT author, title, instrument, file FROM notes WHERE author LIKE "Ж%"';
        $result = $pdo->query($query);

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
?>