<?php
/**
 * Template part for displaying breadcrumbs
 */
?>
<div class="container-x">
    <nav aria-label="Breadcrumbs">
        <ol class="flex items-center gap-2 font-mono text-[11px] uppercase tracking-[0.16em] text-ink-muted flex-wrap">
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-ink transition-colors">Home</a>
            </li>
            <li class="text-ink-muted/40">›</li>
            <?php
            $blog_page_id = get_option('page_for_posts');
            if ($blog_page_id) :
            ?>
            <li>
                <a href="<?php echo esc_url(get_permalink($blog_page_id)); ?>" class="hover:text-ink transition-colors">Blog</a>
            </li>
            <li class="text-ink-muted/40">›</li>
            <?php endif; ?>
            
            <?php
            $categories = get_the_category();
            if (!empty($categories) && $categories[0]->slug !== 'uncategorized') :
            ?>
            <li>
                <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="hover:text-ink transition-colors"><?php echo esc_html($categories[0]->name); ?></a>
            </li>
            <li class="text-ink-muted/40">›</li>
            <?php endif; ?>
            
            <li>
                <span class="text-ink max-w-[200px] truncate sm:max-w-none block" aria-current="page"><?php echo get_the_title(); ?></span>
            </li>
        </ol>
    </nav>
</div>
