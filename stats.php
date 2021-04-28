<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css?version=51" type="text/css">
        <title>Guess my Number</title>
    </head>
    <body>
        <div>
            <h1>Congratulations</h1>
            <?php
            include "game.php";
            include_once 'DatabasePDO.php';
            $db = new DatabasePDO ("127.0.0.1", "root", "", "M07UF3");
            
            $game = unserialize($_SESSION["game"]);
            
            switch($game->getMode()){
                case ("huma") : 
                    echo "<p> Your number is <b>" . $game->getAnswer() . "</b></p>";
                    break;
                case ("maquina") : 
                    echo "<p> Your number is <b>" . $game->getRandom() . "</b></p>";
                    break;
            }
            
            echo "<p> I guessed it in <b>" . $game->getTries() . "</b> tries</p>";
//            echo "mode: " . $game->getMode() ;
//            echo "difficulty: " . $game->getDifficulty() ;
            
            $difficulty = 0;
            switch ($game->getDifficulty()) {
                case ("Easy"): $difficulty = 1;
                    break;
                case ("Medium"): $difficulty = 2;
                    break;
                case ("Hard"): $difficulty = 3;
                    break;
            }
            try {
                $db->connect();
                $db->insert($game->getMode() , $difficulty , $game->getTries()); //modalitat intent nivell
            
            } catch (PDOException $ex) {
                echo "Connection failed: " . $ex->getMessage();
            } 
            ?>
            
            <h2>Would you like to play again?</h2>
            <form action="index.php">
                <button class="btn" type="submit">Play</button>
            </form>
    </body>
</html>
