<html>
    <head>
        <title>Kitap Panel | Bağlan</title>
        <link rel="shortcut icon" href="https://www.pngmart.com/files/22/Green-Arrow-PNG-Free-Download.png" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <style>
    </style>
    <body>
        <?php

            try {
                $baglan = new PDO("mysql:host=localhost;dbname=kutuphane;", "root","");

                $baglan -> query("SET CHARACTER SET utf8");

                //echo "<p class='m-3' style='color:seagreen; font-size: 26px; text-decoration: none;'> Veritabanı bağlantısı kuruldu! </p>";
            } catch (PDOexception $e) {
                echo "<p class='m-3' style='color:darkred; font-size: 26px; text-decoration: none;'>" . $e -> getMessage(). "</p>";
            }



            

        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>