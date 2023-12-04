<?php
// $totalcost = 0;

?>

<head>
    <title></title>
    <link rel="stylesheet" href="./Design/css/main.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>

<div class="shoping-cart flex flex-column">
    <div class="flex flex-row">
        <div style="margin-left:30 px;">
            <h2>Winkelmand</h2>
        </div>
        <div style="margin-left:auto;">
            <form method="POST">
                <button name="emptyCart" class="cart-icon-button-delete">Winkelmand leegmaken</button>
            </form>
        </div>
    </div>
    <?php
    foreach ($cartList as $cartitem) { ?>
        <div class="card-item flex flex-row wrap ">
            <div class="carditem-row-1 flex flex-column">
                <img src="./Design/Img/Icons/rectangle.svg" class="cart-img">
            </div>
            <div class="carditem-row-2 flex flex-column">
                <h3>
                    <?php echo $cartArticleList[$cartitem->getArticleId()]->getName(); ?>
                </h3>
                <div class="price-quantity-module flex flex-column">

                    <div class="quantity flex">
                        <form class="noarrows" method="POST">
                            <input type="number" placeholder=" <?php echo $cartitem->getQuantityOrdered(); ?>"
                                readonly></input>
                            <div>
                                <input hidden name="artId" value="<?php echo $cartitem->getArticleId() ?>"></input>
                                <button type="submit" name="minus" class="button-plus">-</button>
                                <button type="submit" name="plus" class="button-plus">+</button>
                            </div>
                    </div>
                    <div class="cart-action">
                        <button type="submit" name="deleteFromCart" class="cart-icon-button-delete">Verwijder</button>
                        <button type="submit" name="addToWishlist" class="cart-icon-button-wishlist">Wishlist</button>
                        </form>


                        <!-- <img class="cart-icon" src="./Design/Img/Icons/cart-wishlist.svg"> <img class="cart-icon"
                            src="./Design/Img/Icons/cart-delete.svg">Wishlist -->
                    </div>
                    <div class="price flex flex-column">
                        <div class="cart-main-price">
                            <?php echo
                                number_format(
                                    $cartitem->getQuantityOrdered() * $cartArticleList[$cartitem->getArticleId()]->getPriceInclusive(),
                                    2,
                                    ",",
                                    ""
                                ) . ' €'; ?>
                        </div>
                        <div class="cart-old-price">
                            <?php echo number_format(
                                $cartitem->getQuantityOrdered() * $cartArticleList[$cartitem->getArticleId()]->getPrice(),
                                2,
                                ",",
                                ""
                            ) . ' € zonder BTW'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<div class="cart-total">
    <h4>Subtotal</h4>
    <h2>
        <?php

        if (isset($cartArticleList)) {
            echo number_format(
                $cartServ->calculateTotalCartPrice($cartList, $cartArticleList),
                2,
                ",",
                ""
            ) . ' €';
        } ?>
    </h2>
    <p>Ordertotalen zijn inclusief BTW.</p>
</div>
<div class="cart-footer flex flex-row">
    <h3><a href="./index.php">Doorgaan met winkelen</a></h3>
    <a href="OrderController.php" class="button-green">Doorgaan naar bestellen</a>
</div>

</div>