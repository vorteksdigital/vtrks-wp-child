<?php
/**
 * Custom tracking codes for insertion into the <head>.
 */

function vrtks_tracking_codes() {
    ?>
    <!-- Google Analytics -->

    <!-- Meta Pixel -->
    
    <?php
}

add_action('wp_head', 'vrtks_tracking_codes');