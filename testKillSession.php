<?php

spl_autoload_register();
session_start();

session_destroy();
unset($_POST['artId']);
unset($_POST['buy']);
// unset($_SESSION);
// unset($_SESSION['cart']);
// unset($_SESSION['userAccount']);
// unset($_SESSION["name"]);
// unset($_SESSION["familyname"]);
// unset($_SESSION["email"]);
// unset($_SESSION["street"]);
// unset($_SESSION["housenr"]);
// unset($_SESSION["placeid"]);
// unset($_SESSION["discount"]);
// unset($_SESSION["userid"]);

sleep(1);
// $link = './index.php';
// header("Location: $link");

?>