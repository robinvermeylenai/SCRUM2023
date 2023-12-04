<div class="listing-sorting dropdown">
    <!--Sortering: <?php //echo $sortOptions[$sortOption]; ?> | <a class="dropSortbtn2"> Select<i class="bi bi-caret-down"></i>
            <img src="./Design/Img/Icons/ic-chevron-down.svg" width="16px"></a>-->
    Sortering:
    <?php echo $sortOptions[$sortOption]; ?> <img src="./Design/Img/Icons/ic-chevron-down.svg" width="16px">

    <div class="dropdown-content bordered-box">
        <?php
        foreach ($sortOptions as $sortKey => $sortValue) {
            $connector = (strstr($currentUrl, '?')) ? '&' : '?';
            echo '<a href="' . $currentUrl . $connector . 'sort=' . $sortKey . '">' . $sortValue . '</a>';
        }
        ?>
    </div>
</div>

<!--<div class="listing-sorting">-->
<!--
            <form style="display: inline-block;" action="filterArticleList.php" method="post">
            <input class="listing-sorting" placeholder="Zoeken op..." type="text" name="searchKey" value="<?php echo $searchKey; ?>" />
            <input type="hidden" name="currentUrl" value="<?php echo $currentUrl; ?>" />
            <input type="submit" name="buttonFilterArticleList" value="Zoek" />
        </form>
            -->
<!--input[type=submit]-->
<!--</div>-->


<div class="productlisting flex wrap ">
    <?php foreach ($artList as $article) { ?>
        <div class="itemcard bordered-box flex flex-column" data-aos="fade-up">
            <!-- data-aos-anchor-placement="center-bottom" -->
            <a href="index.php?productId=<?php echo $article->getId(); ?>"><img src="./Design/Img/Icons/rectangle.svg"
                    class="article-listing-img">
                <div class="card-title">
                    <!-- PHP -->
                    <?php echo $article->getName() ?>
                </div>
                <div class="card-description">
                    <!-- PHP -->
                    <?php echo $article->getDescription() ?>
                </div>
            </a>
            <div class="card-buy-module flex flex-row space-between">
                <div class="card-price"><!-- PHP -->
                    <?php echo number_format($article->getPriceInclusive(), 2, ",", "") . ' €' ?>
                </div>
                <form method="GET" action="./index.php?">
                    <!--<input type="hidden" name="action" value="order" /> -->
                    <input type="hidden" name="productId" value="<?php echo $article->getId(); ?>" />
                    <button type="submit" value="submit">Meer</button>
                </form>

            </div>

        </div>
    <?php } ?>