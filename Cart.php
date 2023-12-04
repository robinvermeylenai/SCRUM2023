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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:wght@300;500;700&display=swap"
        rel="stylesheet">

</head>

<body>
    <header>

        <?php include_once("./Presentation/MainMenuHeader.php"); ?>
    </header>

    <aside>
        <?php include_once("./Presentation/SideMenu.php"); ?>
    </aside>

    <section class="product-grid">
        <?php include_once("./Presentation/Cart.php"); ?>
    </section>

    <div class="footer">
        <h2>Footer</h2>
        <?php //include_once("./Presentation/Footer.php"); ?>
    </div>

</body>


</html>