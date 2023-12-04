<?php
// CART PAGE
session_start();
spl_autoload_register();
include_once('./SideMenuController.php');
include_once("./CartController.php");


?>

<html>

<head>
    <title></title>
    <link rel="stylesheet" href="./Design/css/main.css">


</head>

<body>
    <header>

        <?php include_once("./Presentation/MainMenuHeader.php"); ?>
    </header>

    <aside>
        <?php include_once("./Presentation/SideMenu.php"); ?>
    </aside>

    <section class="product-grid">
        <?php include_once("./Presentation/Order.php"); ?>
    </section>

    <div class="footer">
        <h2>Footer</h2>
        <?php //include_once("./Presentation/Footer.php"); ?>
    </div>

</body>


</html>