<?php

    if (isset($_SESSION)) {
        // session_start();
    }

    $conn = mysqli_connect("localhost", "root", "", "wad_modul4");

    if(!$conn) {
        echo "<script>
                alert ('Failed Connect Into Database')
            </script>";
    }
    ?>