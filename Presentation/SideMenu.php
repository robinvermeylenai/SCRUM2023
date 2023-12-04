<div class="side-menu">

    <?php
    $activeCategory = ($selectedCategoryId === 0) ? 'class="active"' : '';

    echo '<ul class="showAll"><li ' . $activeCategory . '><a href="index.php">Toon alles</a></li></ul>';
    echo '<ul>';
    foreach ($structuredCategories as $key => $category) {
        
        $activeCategory = ($selectedCategoryId === $category['categorieId']) ? 'class="active"' : '';

        echo '<li ' . $activeCategory . '><a href="index.php?catId=' . $category['categorieId'] . '">' . $category['naam'] . '<img src="./Design/Img/Icons/ic-chevron-down.svg"></a>';
        if (array_key_exists('children', $category)) {

            echo '<ul class="sub-menu">';
            foreach ($category['children'] as $key => $category) {

                $activeCategory = ($selectedCategoryId === $category['categorieId']) ? 'class="active"' : '';

                echo '<li ' . $activeCategory . '><a href="index.php?catId=' . $category['categorieId'] . '">' . $category['naam'] . '</a>';
                if (array_key_exists('children', $category)) {

                    echo '<ul>';
                    foreach ($category['children'] as $key => $category) {
                        
                        $activeCategory = ($selectedCategoryId === $category['categorieId']) ? 'class="active"' : '';
                        
                        echo '<li ' . $activeCategory . '><a href="index.php?catId=' . $category['categorieId'] . '">' . $category['naam'] . '</li></a>';
                    }
                    echo '</ul>';

                }
                echo '</li>';

            }
            echo '</ul>';
        }
        echo '</li>';

    }
    echo '</ul>';

    ?>
</div>