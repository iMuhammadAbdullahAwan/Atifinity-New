<?php
/**
 * Template part for displaying a blog card
 *
 * @package Atifinity
 */
?>

<article id="post-<?php the_ID(); ?>" class="group relative flex flex-col items-start justify-between rounded-md border border-ink/10 bg-panel overflow-hidden transition-all duration-300 hover:border-ink/20 hover:-translate-y-1" data-reveal="lift">
    <a href="<?php the_permalink(); ?>" class="absolute inset-0 z-10"><span class="sr-only">View <?php the_title(); ?></span></a>

    <div class="w-full aspect-video overflow-hidden border-b border-ink/10">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('blog-card', ['class' => 'h-full w-full object-cover transition-transform duration-500 group-hover:scale-105']); ?>
        <?php else : ?>
            <div class="h-full w-full bg-ink/5 flex items-center justify-center">
                <svg class="h-12 w-12 text-ink/10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <circle cx="8.5" cy="8.5" r="1.5"/>
                    <polyline points="21 15 16 10 5 21"/>
                </svg>
            </div>
        <?php endif; ?>
    </div>

    <div class="flex flex-1 flex-col p-6 w-full">
        <div class="flex items-center gap-3 text-[11px] font-mono uppercase tracking-[0.16em] text-ink-muted">
            <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('M j, Y'); ?></time>
            <?php
            $categories = get_the_category();
            if (!empty($categories)) :
                echo '<span class="text-ink-muted/40">·</span>';
                echo '<span>' . esc_html($categories[0]->name) . '</span>';
            endif;
            ?>
        </div>

        <h3 class="text-h3 mt-3 text-ink group-hover:text-primary transition-colors line-clamp-2">
            <?php the_title(); ?>
        </h3>

        <p class="mt-3 text-small text-ink-muted line-clamp-3 flex-1">
            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
        </p>

        <span class="mt-4 inline-flex items-center gap-2 text-small font-medium text-primary opacity-0 translate-y-1 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
            Read more
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </span>
    </div>
</article>
