<?php
spl_autoload_register();
$displayStyle = 'none';
if (isset($_GET['showLogin'])) {
    $displayStyle = 'block';
}
?>
<div id="darkOverlay" style="display:<?php echo $displayStyle; ?>"></div>
<div id="loginPopupContainer" style="display:<?php echo $displayStyle; ?>">
    <?php if (isset($_SESSION['user'])) {
        include_once("ProfileController.php");
    } else {
        include_once("loginController.php");
    } ?>
</div>
<div class="container">
    <div class="header-top flex wrap">
        <a href="tel:+320123456789">+32 0123 456 789</a>
        <a href="mailto:info@prularia.be">info@prularia.be</a>
        <a href="#">Over Ons</a>
        <span>
            <?php
            if (isset($_SESSION['user'])) {
                echo '<span class="greeting">Welkom ' . unserialize($_SESSION['user'])->getFirstName() . '</span>';
                echo '<a href="logout.php">Afmelden</a>';
            } else {
                echo '<a href="#" onClick="showLoginPopup();return false;">Aanmelden</a>';
            } ?>

        </span>
    </div>
    <div class="header-main flex wrap">
        <img class="logo" src="./Design/Img/logo_prularia_zwart.png">
        <div class="topsearch flex">
            <form class="header-search ">
                <input type="text" placeholder="Zoek"></input>
                <button class="searchbutton"><img class="search-icon"
                        src="./Design/Img/Icons/ic-actions-search.svg "></button>
            </form>
        </div>
        <div class="header-icons-container flex">
            <div class="header-user">
                <?php if (isset($_SESSION['user'])) { ?>

                    <a href="ProfileController.php"> <img class="header-icon" src="./Design/Img/Icons/user.svg"> </a>
                
                <?php } else { ?>

                    <a href="#" onClick="showLoginPopup();return false;"> <img class="header-icon"
                            src="./Design/Img/Icons/user.svg"> </a>

                <?php } ?>
            </div>
            <div class="header-wishlist">
                <img class="header-icon" src="./Design/Img/Icons/header-wishlist.svg">
                <span class='badge badge-warning' id='lblCartCount'>1</span>
            </div>
            <div class="header-cart">
                <?php if (!isset($_SESSION['cart'])) { ?>

                    <img class="header-icon" src="./Design/Img/Icons/basket.svg">

                <?php } else { ?>

                    <a href="./Cart.php"><img class="header-icon" src="./Design/Img/Icons/basket.svg">
                        <span class='badge badge-warning' id='lblCartCount'>
                            <?php echo (count(unserialize($_SESSION['cart']))) ?>
                        </span></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script>
    function openForm() {
        document.getElementById("loginpopup").style.display = "block";
    }
</script>