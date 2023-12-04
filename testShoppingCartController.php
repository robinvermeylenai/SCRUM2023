<?php
//include of all necessary controllers for index page

include_once('./SideMenuController.php');
include_once("./Presentation/CartController.php");
if (isset($_GET['productId']) and $_GET['productId'] > 0) {
    //include_once('./ArticleController.php');
} else {
    include_once('./ArticleListingController.php');
}

$currentUrl = 'index.php';
if (isset($_GET['catId'])) {
    $currentUrl .= '?catId=' . $_GET['catId'];
}

?>

<html>

<head>
    <title></title>
    <link rel="stylesheet" href="./Design/css/main.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

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
        include_once("./Presentation/Cart.php");
        ?>
    </section>

    <div class="footer">
        <h2>Footer</h2>
        <?php //include_once("./Presentation/Footer.php"); ?>
    </div>

</body>
<script>
    AOS.init();
</script>

</html>