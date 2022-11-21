<?php
   $lang = "en";
   if (ISSET($_GET['lang'])) {
        $lang = $_GET['lang'];
   };
   $language = parse_ini_file("language/$lang.ini");
?>