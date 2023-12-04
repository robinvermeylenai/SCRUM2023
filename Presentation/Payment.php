<?php
// Presentation/Order.php

?>
<head>
<title>Betaling</title>
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
        <h3>Te betalen</h3>
        <form method="post" action="OrderController.php">
            <div class="totalPrice">
                <label for="total-price">Totale prijs (met BTW)</label>
                <input type="text" id="total-price" name="total-price" value="<?php echo number_format($cartServ->calculateTotalCartPrice($cartList, $cartArticleList),2,",","")?>" readonly>
            </div>
            <!--div class="actionCode">
                <label for="actionCode">Actiecode</label>
                <input type="text" id="actionCode" name="actionCode" value="<?php echo $postList["actionCode"] ?? ""?>">
                <span name="errorActionCode" class="error"></span>
            </div-->
            <h3>Betalingswijze</h3>
            <div class="paymentMethod">
                <label for="paymentMethod">Betalingswijze</label>
                <select name="paymentMethod">
                    <option value="1">Kredietkaart</option>
                    <option value="2">Overschrijving</option>
                </select>
            </div>
            <div class="submit">
                <button type="submit" name="payOrder">Bestelling afronden en betalen</button>
            </div>
        </form>
    </section>
    <footer>
    </footer>
</body>
</html>