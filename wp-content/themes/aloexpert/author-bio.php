<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-03-10 18:40:30
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="entry-footer">
    <div class="author-box">
        <div class="author-avatar">
            <?php get_avatar(get_the_author_meta('ID')); ?>
        </div>
        <h3>
            <?php 
                printf('Written by <a href="%1$s">%2$s</a>',
                get_author_posts_url(get_the_author_meta('ID')),
                get_the_author());
            ?>
            <p><?php echo get_the_author_meta('description'); ?></p>
        </h3>
    </div>
</div>
