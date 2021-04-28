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
    </body>
</html>
