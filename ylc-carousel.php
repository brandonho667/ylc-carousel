<?php
/**
 * Plugin Name: YLC Carousel
 * Description: Carousel for the website YLC
 * Author: Brandon Ho
 * Version: 1.0.0
 */

defined( 'ABSPATH' ) or die(':)');

 // temp php logger for debugging
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

function display_carousel() {
    $args = array(
        'category_name' => 'carousel',
        'orderby' => 'link_id',
        'order' => 'DESC',
        'limit' => 5
    );
    
    $links = get_bookmarks($args);
    $n = count($links);

    if (!empty($links)) {
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
                    <a class="vp-a" href="<?php echo $link->link_url; ?>" title="<?php echo $link->link_name; ?>">
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

add_shortcode('ylc-carousel', 'display_carousel');

add_filter( 'pre_option_link_manager_enabled', '__return_true' );

require_once dirname( __FILE__ ). '/enqueue-scripts.php';