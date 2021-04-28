<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script>
            function showEstadistiques(value) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("taula_estadistiques").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "getestadistiques.php?modalitat=" + value, true);
                xmlhttp.send();

            }
        </script>
    </head>
    <body onload="showEstadistiques(1)">
        <a href="index.php">Back</a>
        <h1>PHP MySQL</h1>
        <h2>Estadístiques</h2>
        <form>
            <select name="modalitats" onchange="showEstadistiques(this.value)">
                <option value="1">Tots</option>
                <option value="2">Humà</option>
                <option value="3">Màquina</option>
            </select>
        </form>
        <br>
        <div id="taula_estadistiques"></div>
        
        <form method="get">
            <h2>Delete</h2>
            <input type="number" name="deleteId" placeholder="id">
            <input type="submit" name="delete">
        </form>
        
        <form method="get">
            <h2>Update</h2>
            <input type="number" name="updateId" placeholder="id">
            <select name="updateMode">
                <option value="huma">Huma</option>
                <option value="maquina">Maquina</option>
            </select>
            <select name="updateDiff">
                <option value="1">Easy</option>
                <option value="2">Medium</option>
                <option value="3">Hard</option>
            </select>
            <input name="updateTry" type="number" name="">
            <input type="submit" name="update">
        </form>
        
        <form method="get">
            <h2>Insert</h2>
            <select name="insertMode">
                <option value="huma">Huma</option>
                <option value="maquina">Maquina</option>
            </select>
            <select name="insertDiff">
                <option value="1">Easy</option>
                <option value="2">Medium</option>
                <option value="3">Hard</option>
            </select>
            <input name="insertTry" type="number" name="">
            <input type="submit" name="insert">
        </form>

        
        <?php
            include "DatabasePDO.php";
            $db = new DatabasePDO ("127.0.0.1", "root", "", "M07UF3");
            $db->connect();
            
            if(isset($_GET["update"])) {
                $db->updateById($_GET["updateId"], $_GET["updateMode"], $_GET["updateDiff"], $_GET["updateTry"]);
            }
            else if(isset ($_GET["delete"])){
                $db->deleteById($_GET["deleteId"]);
            }
            else if(isset ($_GET["insert"])) {
                $db->insertById($_GET["insertMode"], $_GET["insertDiff"], $_GET["insertTry"]);
            }
            
        ?>
        
    </body>
</html>
