<?php
//Presentation/Article.php


// !ToDo -> ADD when header file exists
//  include_once("./Presentation/Header.php");


?>


<div class="bordered-box ">
    <div class="article-full flex wrap-mobile">
        <img src="./Design/Img/Icons/rectangle.svg" class="article-img ">
        <div class="article-description .flex-row">
            <h2>
                <?php echo $articleDetail['article']->getName(); ?>
            </h2>
            <div class="rating"><img src="./Design/Img/Icons/<?php echo round($articleDetail['avgScore']); ?>stars.svg">
            </div>
            <div class="description">
                <?php echo $articleDetail['article']->getDescription(); ?>
            </div>
            <div class="properties flex space-between wrap">
                <ul>
                    <li><span>EAN:</span>
                        <?php echo $articleDetail['article']->getEan(); ?>
                    </li>
                    <li><span>Gewicht:</span>
                        <?php echo $articleDetail['article']->getWeight(); ?> g
                    </li>
                </ul>
                <ul>
                    <li><span>In stock:</span>
                        <?php echo $articleDetail['article']->getStock(); ?>
                    </li>
                    <li><span>Levertermijn:</span>
                        <?php echo $articleDetail['article']->getDeliveryTime(); ?>
                    </li>
                </ul>
            </div>
            <div class="buy-module flex bordered-box-white wrap ">
                <div class="price flex flex-column">
                    <div class="main-price">
                        <?php echo number_format($articleDetail['article']->getPriceInclusive(), 2, ",", "") . ' €' ?>
                    </div>
                    <div class="old-price">
                        <?php echo number_format($articleDetail['article']->getPrice(), 2, ",", "") . ' € zonder BTW' ?>
                    </div>
                </div>
                <div class="quantity flex">
                    <form method="POST">
                        <!-- <input class="noarrows" min="1" value="1" type="number"
                            style="width: 3rem; margin-right: 1rem"></input> -->
                        <input hidden name="artId" value="<?php echo $articleDetail['article']->getId(); ?>"></input>


                        <button type="submit" name="buy" value="1" class="addcart">Add to cart</button>
                    </form>
                </div>
            </div>
            <div class="wishlist-module flex">
                <a href class="box-white"><img src="./Design/Img/Icons/wishlist-action-heart.svg">Add to
                    Wishlist</a>
            </div>
            <div class="reviews-module flex flex-column">
                <h3>Reviews</h3>
                <?php foreach ($articleDetail['review'] as $review) {
                    ?>
                    <div class="review">
                        <div class="review-author">
                            Author:
                            <?php echo $review->getNickname(); ?>
                        </div>
                        <p>
                            <?php echo $review->getComment(); ?>
                        </p>
                    </div>
                <?php } ?>


            </div>
        </div>