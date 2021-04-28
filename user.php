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
        $min = $game->getMin();
        $max = $game->getMax();
    ?>
    <body>
        <div>
            <form method="post">
                <?php
                    echo "<h1>" . $game->getDifficulty() . " Mode </h1>";
                ?>
                <input class="input" type="number" min=<?= $min ?> max=<?= $max ?> name="guess" />
                <button class="btn" name="submit" type="submit"><i class="fas fa-check"></i></button>
            </form>
            <?php
                
                if(isset($_POST["submit"])) {
                    $guess = $_POST["guess"];
                    
                    if ($game->gameUser($guess)) {
                        $_SESSION["game"] = serialize($game);
                        header('Location: stats.php');
                    } else {
                        $_SESSION["game"] = serialize($game);
                    }
                    
                }
                
                ?>
        </div>
    </body>
</html>
