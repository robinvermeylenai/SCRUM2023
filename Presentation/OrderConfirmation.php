<?php
// Presentation/Order.php

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Bestelling bevestigd</title>
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

    <section class="order-form bordered-box">
        <h3>Bedankt voor uw bestelling.</h3>
        <h3>Uw bestellingsnummer: <?php echo $orderId ?? 324 ?></h3>
        <?php foreach($cartList as $cart){ ?>
            <div>
                <label><?php echo $cartArticleList[$cart->getArticleId()]->getName() ?> X</label>
                <label><?php echo $cart->getQuantityOrdered() ?></label> :
                <label><?php echo number_format($cartArticleList[$cart->getArticleId()]->getPriceInclusive() * $cart->getQuantityOrdered(),2,",","") ?> €</label>
            </div>
        <?php }
        ?>
        <br>
        <div><label><h3>Totaal betaald: </h3></label>
        <label><h3><?php echo number_format($cartServ->calculateTotalCartPrice($cartList, $cartArticleList),2,",","") ?> €</h3></label>
    </section>
    <footer>
    </footer>

</html>