<?php
// Presentation/Order.php

?>

<head>
<title></title>
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
            <div class="price">
                <label for="product-price">Prijs (zonder BTW)</label>
                <input type="text" id="product-price" name="product-price" value="<?php echo number_format($cartServ->calculateTotalCartPriceNoBtw($cartList, $cartArticleList),2,",","")?>" readonly>
            </div>
            <div class="btwInEu">
                <label for="btw-amount">BTW</label>
                <input type="text" id="btw-amount" name="btw-amount" value="<?php echo number_format(($cartServ->calculateTotalCartPrice($cartList, $cartArticleList)-$cartServ->calculateTotalCartPriceNoBtw($cartList, $cartArticleList)),2,",","")?>" readonly>
            </div>

            <h3>Leveringsadres</h3>
            <div class="orderLastName">
                <label for="orderLastName">Naam</label>
                <input type="text" id="orderLastName" name="orderLastName" value="<?php echo $postList["orderLastName"] ?? ""?>" required> *
                <span name="errorLastName" class="error"><?php echo $errorList["orderLastName"] ?? ""?></span>
            </div>
            <div class="orderFirstName">
                <label for="orderFirstName">Voornaam</label>
                <input type="text" id="orderFirstName" name="orderFirstName" value="<?php echo $postList["orderFirstName"] ?? ""?>" required> *
                <span name="errorFirstName" class="error"><?php echo $errorList["orderFirstName"] ?? ""?></span>
            </div>
            <div class="deliveryStreet">
                <label for="deliveryStreet">Straat</label>
                <input type="text" id="deliveryStreet" name="deliveryStreet" value="<?php echo $postList["deliveryStreet"] ?? ""?>"required> *
                <span name="errorDeliveryStreet" class="error"><?php echo $errorList["deliveryStreet"] ?? ""?></span>
            </div>
            <div class="deliveryNumber">
                <label for="deliveryNumber">Huisnummer</label>
                <input type="text" id="deliveryNumber" name="deliveryNumber" value="<?php echo $postList["deliveryNumber"] ?? ""?>"required> *
                <span name="errorDeliveryNumber" class="error"><?php echo $errorList["deliveryNumber"] ?? ""?></span>
            </div>
            <div class="deliveryBox">
                <label for="deliveryBox">Bus</label>
                <input type="text" id="deliveryBox" name="deliveryBox" value="<?php echo $postList["deliveryBox"] ?? ""?>">
            </div>
            <div class="deliveryZip">
                <label for="deliveryZip">Postcode</label>
                <input type="number" min="1000" max="9999" id="deliveryZip" name="deliveryZip" value="<?php echo $postList["deliveryZip"] ?? ""?>" required> *
                <span name="errorDeliveryZip" class="error"><?php echo $errorList["deliveryZip"] ?? ""?></span>
            </div>
            <div class="deliveryCity">
                <label for="deliveryCity">Stad</label>
                <input type="text" id="deliveryCity" name="deliveryCity" value="<?php echo $postList["deliveryCity"] ?? ""?>" required> *
                <span name="errorDeliveryCity" class="error"><?php echo $errorList["deliveryCity"] ?? ""?></span>
            </div>
            <div><span name="errorDeliveryZipCityCombo" class="error"><?php echo $errorList["deliveryZipCityCombo"] ?? ""?></span></div>
            <!--div>
                    <label for="selectDeliveryPlace">Selecteer</label>
                    <select name="selectDeliveryPlace">
                    <input list="places" name="place" id="place">
                    <datalist id="places">
                    <?php
                        foreach($placeList as $place) {
                            ?>
                            <option value="<?php echo $place->getPlaceId() ?>"><?php echo $place->getZip()." ".$place->getName() ?></option>
                        <?php
                        }
                        ?>
                    </datalist>
                    </select>
                </div-->
            <!--div class="">
                    <label for="searchDeliveryZipCity">Postcode OF Stad</label>
                    <input type="text" id="searchDeliveryZipCity" name="searchDeliveryZipCity">
                    <input type="submit" name="searchDeliveryZipCityBtn" value="Zoeken">
                </div>
                <div>
                    <label for="selectDeliveryPlace">Selecteer</label>
                    <select name="selectDeliveryPlace">
                        <?php
                        foreach($deliveryPlaceList as $place) {
                            ?>
                            <option value="<?php echo $place->getPlaceId() ?>"><?php echo $place->getZip()." ".$place->getName() ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div-->
            <div><input type="checkbox" id="noInvoiceAddress" name="noInvoiceAddress" <?php echo $checked?> onclick="document.getElementById('noInvoiceAddress').checked == true ? document.getElementById('invoiceDiv').hidden = true : document.getElementById('invoiceDiv').hidden = false">
            <label for="noInvoiceAddress">Facturatieadres is hetzelfde als leveringsadres.</label></div>
            <div id="invoiceDiv" <?php echo $hidden?>>
                <h3>Facturatieadres</h3>
                <div class="invoiceStreet">
                    <label for="invoiceStreet">Straat</label>
                    <input type="text" id="invoiceStreet" name="invoiceStreet" value="<?php echo $postList["invoiceStreet"] ?? ""?>">*
                    <span name="errorInvoiceStreet" class="error"><?php echo $errorList["invoiceStreet"] ?? ""?></span>
                </div>
                <div class="invoiceNumber">
                    <label for="invoiceNumber">Huisnummer</label>
                    <input type="text" id="invoiceNumber" name="invoiceNumber" value="<?php echo $postList["invoiceNumber"] ?? ""?>">*
                    <span name="errorInvoiceNumber" class="error"><?php echo $errorList["invoiceNumber"] ?? ""?></span>
                </div>
                <div class="invoiceBox">
                    <label for="invoiceBox">Bus</label>
                    <input type="text" id="invoiceBox" name="invoiceBox" value="<?php echo $postList["invoiceBox"] ?? ""?>">*
                    <span name="errorInvoiceBox" class="error"><?php echo $errorList["invoiceBox"] ?? ""?></span>
                </div>
                <div class="invoiceZip">
                    <label for="invoiceZip">Postcode</label>
                    <input type="number" min="1000" max="9999" id="invoiceZip" name="invoiceZip" value="<?php echo $postList["invoiceZip"] ?? ""?>">*
                    <span name="errorInvoiceZip" class="error"><?php echo $errorList["invoiceZip"] ?? ""?></span>
                </div>
                <div class="invoiceCity">
                    <label for="invoiceCity">Stad</label>
                    <input type="text" id="invoiceCity" name="invoiceCity" value="<?php echo $postList["invoiceCity"] ?? ""?>">*
                    <span name="errorInvoiceCity" class="error"><?php echo $errorList["invoiceCity"] ?? ""?></span>
                </div>
                <div><span name="errorInvoiceZipCityCombo" class="error"><?php echo $errorList["invoiceZipCityCombo"] ?? ""?></span></div>
                <!--div>
                    <label for="selectInvoicePlace">Selecteer</label>
                    <select name="selectInvoicePlace">
                    <input list="places" name="place" id="place">
                    <datalist id="places">
                    <?php
                        foreach($placeList as $place) {
                            ?>
                            <option value="<?php echo $place->getPlaceId() ?>"><?php echo $place->getZip()." ".$place->getName() ?></option>
                        <?php
                        }
                        ?>
                    </datalist>
                    </select>
                </div-->
                    <!--div class="">
                        <label for="searchInvoiceZipCity">Postcode OF Stad</label>
                        <input type="text" id="searchInvoiceZipCity" name="searchInvoiceZipCity">
                        <input type="submit" name="searchInvoiceZipCityBtn" value="Zoeken">
                    </div>
                    <div>
                        <label for="selectInvoicePlace">Selecteer</label>
                        <select name="selectInvoicePlace">
                            <?php
                            foreach($invoicePlaceList as $place) {
                                ?>
                                <option value="<?php echo $place->getPlaceId() ?>"><?php echo $place->getZip()." ".$place->getName() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="invoiceCity">
                        <label for="invoiceCity">Stad</label>
                        <input type="text" id="invoiceCity" name="invoiceCity" required>
                    </div>
                    <div class="invoiceZip">
                        <label for="invoiceZip">Postcode</label>
                        <input type="text" id="invoiceZip" name="invoiceZip" required>
                    </div-->
                        </div>
            <div class="submit">
                <button type="submit" name="placeOrder">Doorgaan naar betalen</button>
            </div>
        </form>
    </section>
    <footer>
    </footer>

</body>
</html>