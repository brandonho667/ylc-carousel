<?php
/**
 * Plugin Name: YLC Carousel
 * Description: Carousel for the website YLC
 * Author: Brandon Ho
 * Version: 1.0.0
 */

function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

function display_carousel() {
    console_log("cock and balls");
    $args = array(
        'category_name' => 'carousel',
        'orderby' => 'link_id',
        'order' => 'DESC',
        'limit' => 5
    );
    
    $links = get_bookmarks($args);
    $n = count($links);

    if (!empty($links)) {
        wp_register_script('carousel-js', plugin_dir_url(__FILE__) . 'carousel.js', array('jquery'), '1.0', true);
        wp_enqueue_script('carousel-js');
        ?>
        <div id="carousel">
            <ul style="width: <?php echo $n * 100; ?>%;">
            <?php
            foreach ($links as $i => $link) {
                // Background image
                if (!empty($link->link_image))
                    $background = 'url(' . $link->link_image . ')';
                else
                    $background = 'rgb(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ')';
                // Target attribute
                if (!empty($link->link_target))
                    $target = ' target="' . $link->link_target . '"';
                else
                    $target = '';
                // Rel attribute
                if (!empty($link->link_rel))
                    $rel = ' rel="' . $link->link_rel . '"';
                else
                    $rel = '';
                ?>
                <li style="background-image: <?php echo $background; ?>">
                    <a href="<?php echo $link->link_url; ?>" class="carousel-link">
                        <strong><?php echo $link->link_name; ?></strong>
                        <?php
                        if (!empty($link->link_description)) {
                            ?>
                            <em><?php echo $link->link_description; ?></em>
                            <?php
                        }
                        ?>
                    </a>
                    <?php
                    // Previous link
                    if ($i > 0) {
                        ?>
                        <a href="#prev" class="carousel-prev">&lt;</a>
                        <?php
                    }
                    ?>
                    <?php
                    // Next link
                    if ($i < $n - 1) {
                        ?>
                        <a href="#next" class="carousel-next">&gt;</a>
                        <?php
                    }
                    ?>
                </li>
                <?php
            }
            ?>
            </ul>
        </div>
        <?php
    }
}

function enqueue_carousel_style() {
    wp_register_style('carousel-css', plugin_dir_url(__FILE__) . 'carousel.css');
    wp_enqueue_style('carousel-css', plugin_dir_url(__FILE__) . 'carousel.css');
}
add_action('wp_enqueue_scripts', 'enqueue_carousel_style');
add_shortcode('ylc-carousel', 'display_carousel');

add_filter( 'pre_option_link_manager_enabled', '__return_true' );