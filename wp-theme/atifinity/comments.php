<?php
/**
 * The template for displaying comments
 *
 * @package Atifinity
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area mt-16 pt-12 border-t border-ink/10 data-reveal">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title text-h3 mb-8">
            <?php
            $atifinity_comment_count = get_comments_number();
            if ('1' === $atifinity_comment_count) {
                printf(
                    /* translators: 1: title. */
                    esc_html__('One thought on &ldquo;%1$s&rdquo;', 'atifinity'),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count number, 2: title. */
                    esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $atifinity_comment_count, 'comments title', 'atifinity')),
                    number_format_i18n($atifinity_comment_count),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list space-y-8">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 48,
                'class'       => 'text-small text-ink-muted',
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation(array(
            'prev_text' => __('&larr; Older Comments', 'atifinity'),
            'next_text' => __('Newer Comments &rarr;', 'atifinity'),
            'class' => 'mt-8 border-t border-ink/10 pt-8',
        ));
        ?>

    <?php endif; // Check for have_comments(). ?>

    <?php
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
        <p class="no-comments text-small text-ink-muted mt-8 italic"><?php esc_html_e('Comments are closed.', 'atifinity'); ?></p>
    <?php endif; ?>

    <div class="mt-12">
        <?php
        comment_form(array(
            'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title text-h3 mb-6">',
            'title_reply_after'  => '</h3>',
            'class_form'         => 'space-y-6',
            'class_submit'       => 'btn-primary mt-4 cursor-pointer',
            'comment_field'      => '<div class="comment-form-comment"><label for="comment" class="sr-only">' . _x('Comment', 'noun', 'atifinity') . '</label><textarea id="comment" name="comment" cols="45" rows="5" required class="w-full rounded-md border border-ink/10 bg-panel px-4 py-3 text-small text-ink placeholder:text-ink/30 focus:border-ink/20 focus:outline-none" placeholder="' . esc_attr__('Your comment *', 'atifinity') . '"></textarea></div>',
            'fields'             => array(
                'author' => '<div class="grid sm:grid-cols-2 gap-6"><div class="comment-form-author"><label for="author" class="sr-only">' . __('Name', 'atifinity') . '</label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" required class="w-full rounded-md border border-ink/10 bg-panel px-4 py-3 text-small text-ink placeholder:text-ink/30 focus:border-ink/20 focus:outline-none" placeholder="' . esc_attr__('Name *', 'atifinity') . '" /></div>',
                'email'  => '<div class="comment-form-email"><label for="email" class="sr-only">' . __('Email', 'atifinity') . '</label><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" required class="w-full rounded-md border border-ink/10 bg-panel px-4 py-3 text-small text-ink placeholder:text-ink/30 focus:border-ink/20 focus:outline-none" placeholder="' . esc_attr__('Email *', 'atifinity') . '" /></div></div>',
                'url'    => '<div class="comment-form-url mt-6"><label for="url" class="sr-only">' . __('Website', 'atifinity') . '</label><input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" class="w-full rounded-md border border-ink/10 bg-panel px-4 py-3 text-small text-ink placeholder:text-ink/30 focus:border-ink/20 focus:outline-none" placeholder="' . esc_attr__('Website', 'atifinity') . '" /></div>',
            ),
        ));
        ?>
    </div>

</div><!-- #comments -->
