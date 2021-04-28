<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css?version=51" type="text/css">
        <title>Guess my Number</title>
    </head>
    <body>
        <a href="estadistiques.php">Stats</a>
        <form method="POST">
            <h1>Guess my Number</h1>
            <h2>Mode</h2>
            <label class="container">Bot
                <input type="radio" value="maquina" checked="checked" name="mode">
                <span class="checkmark"></span>
            </label>
            <label class="container">User
                <input type="radio" value="huma" name="mode">
                <span class="checkmark"></span>
            </label>
            
            <br>
            
            <h2>Difficulty</h2>
            <label class="container">Easy
                <input type="radio" value="Easy" checked="checked" name="difficulty">
                <span class="checkmark"></span>
            </label>
            <label class="container">Medium
                <input type="radio" value="Medium" name="difficulty">
                <span class="checkmark"></span>
            </label>
            <label class="container">Hard
                <input type="radio" value="Hard" name="difficulty">
                <span class="checkmark"></span>
            </label>
            
            <button class="btn" name="submit" type="submit">Play</button>
        </form>
        <?php
            include "game.php";
            
            if(isset($_POST["submit"])){
                $mode = $_POST["mode"];
                $difficulty = $_POST["difficulty"];
                echo $difficulty;
                if($_POST["mode"] == "huma"){
                    $game = new User($mode, $difficulty);
                    $_SESSION["game"] = serialize($game);
                    header('Location: user.php');
                }else if($_POST["mode"] == "maquina"){
                    $game = new Bot($mode, $difficulty);
                    $_SESSION["game"] = serialize($game);
                    header('Location: bot.php');
                }
            }
        ?>
        <button id="credits">Credits</button>
    </body>
    
    <script>
        var input = document.getElementById("credits");
        input.addEventListener("click", popUp);
        function popUp(){
            floatingWindow = window.open("./credits.txt", "", "height=100,width=500;scrollbas=no");
            
        }
    </script>
</html>
