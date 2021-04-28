<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css?version=51" type="text/css">
        <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
        <title>Guess my Number</title>
    </head>
    <?php
        include "game.php";
        $game = unserialize($_SESSION["game"]);
    ?>
    <body>
        <div>
            <h1>Guess my Number</h1>
            <form method="post">
                <button type="submit" class="btn" name="smaller"><i class="fas fa-minus"></i></button>
                <button type="submit" class="btn" name="correct"><i class="fas fa-check"></i></button>
                <button type="submit" class="btn" name="bigger"><i class="fas fa-plus"></i></button>
            </form>
            <?php
                
                if(isset($_POST["smaller"])) {
                    $game->incrementTries();
                    $game->setMax($game->getRandom() - 1);
                    $game->randomizer();
                    $_SESSION["game"] = serialize($game);
                    if($game->checkValues()) {
                        header("Location: stats.php");
                    }
                    
                }
                if(isset($_POST["bigger"])) {
                    $game->incrementTries();
                    $game->setMin($game->getRandom() + 1);
                    $game->randomizer();
                    $_SESSION["game"] = serialize($game);
                    if($game->checkValues()) {
                        header("Location: stats.php");
                    }
                }
                if(isset($_POST["correct"])) {
                    $_SESSION["game"] = serialize($game);
                    
                        header("Location: stats.php");
                    
                }
                
                echo "<p>Is your number: <b>" . $game->getRandom() . "</b></p>";
                echo "<p>Tries: " . $game->getTries() . "</p>";
                echo "<p>Min: " . $game->getMin() . "</p>";
                echo "<p>Max: " . $game->getMax() ." </p>";
                

                
                ?>
        </div>
    </body>
</html>
