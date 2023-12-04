<?php
session_start();
//unset($_SESSION);
spl_autoload_register();

$activePage = 'index.php';
$currentUrl = 'index.php';
if (isset($_GET['catId'])) {
    $currentUrl .= '?catId=' . $_GET['catId'];
}

//include of all necessary controllers for index page

include_once('./SideMenuController.php');

if (isset($_GET['productId']) and $_GET['productId'] > 0) {
    include_once('./ArticleDetailController.php');
    include_once("./CartController.php");
} else {
    include_once('./ArticleListingController.php');
}

?>

<!DOCTYPE html>

    <head>
        <title>Prularia - Catalogus</title>
        <link rel="stylesheet" href="./Design/css/main.css">
        <link rel="stylesheet" href="./Design/css/popup.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:wght@300;500;700&display=swap"
            rel="stylesheet">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="./Design/js/main.js"></script>
    </head>

    <body>
        <header>
            <?php include_once("./Presentation/MainMenuHeader.php"); ?>
        </header>

        <aside>
            <?php include_once("./Presentation/SideMenu.php"); ?>
        </aside>

        <section class="product-grid">
            <?php
            if (isset($_GET['productId']) and $_GET['productId'] > 0) {
                include_once("./Presentation/Article.php");
            } else {
                include_once("./Presentation/ArticleListing.php");
            }
            ?>
        </section>

        <div class="footer">
            <?php include_once("./Presentation/Footer.php"); ?>
        </div>

    </body>
    <script>
        AOS.init();
    </script>

</html>