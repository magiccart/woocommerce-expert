<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-03-13 23:21:41
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php
if ( post_password_required() ) {
    return;
}
?>
<section id="comments" class="comments-area" aria-label="<?php esc_html_e( 'Post Comments', 'aloexpert' ); ?>">
<?php
if ( have_comments() ) : ?>
    <div class="post-block post-comments clearfix">
        <h3><i class="fa fa-comments"></i><?php
                printf( _nx( 'Comment (1)', 'Comments (%1$s)', get_comments_number(), 'comments title', 'aloexpert' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h3>

        <ul class="comments">
            <?php
                // Comments list
                wp_list_comments( array(
                    'short_ping'  => true,
                    'avatar_size' => 80,
                    'callback' => 'magiccart_comment'
                ) );
            ?>
        </ul>

        <?php
        // Are there comments to navigate through?
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <div class="clearfix">
                <div class="pagination" role="navigation">
                    <?php paginate_comments_links() ?>
                </div>
            </div>
        <?php endif; // Check for comment navigation ?>

        <?php if ( ! comments_open() && get_comments_number() ) : ?>
            <p class="no-comments"><?php _e( 'Comments are closed.' , 'aloexpert' ); ?></p>
        <?php endif; ?>
    </div>
<?php endif; // have_comments() ?>
<?php comment_form(); ?>
</section>
<?php
function magiccart_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>

<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

    <div class="comment-body">
        <div class="img-thumbnail">
            <?php //echo get_avatar($comment, 80); ?>
			<?php echo get_avatar( get_the_author_meta('email'), 80 ); ?>
        </div>
        <div class="comment-block">
            <div class="comment-arrow"></div>
            <span class="comment-by">
                <strong><?php echo get_comment_author_link() ?></strong>
                <span class="pt-right">
                    <span> <?php edit_comment_link('<i class="fa fa-pencil"></i> ' . __('Edit', 'aloexpert'),'  ','') ?></span>
                    <span> <?php comment_reply_link(array_merge( $args, array('reply_text' => '<i class="fa fa-reply"></i> ' . __('Reply', 'aloexpert'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
                </span>
            </span>
            <div>
                <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php echo __('Your comment is awaiting moderation.', 'aloexpert') ?></em>
                    <br />
                <?php endif; ?>
                <?php comment_text() ?>
            </div>
            <span class="date pt-right"><?php printf(__('%1$s at %2$s', 'aloexpert'), get_comment_date(),  get_comment_time()) ?></span>
        </div>
    </div>

<?php }
?>
