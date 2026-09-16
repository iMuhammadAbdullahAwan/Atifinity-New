<?php
/**
 * Template part for displaying related posts
 */

$related_posts = function_exists('atifinity_get_related_posts') ? atifinity_get_related_posts(3) : null;

if ($related_posts && $related_posts->have_posts()) :
?>
<section class="border-t border-ink/10 mt-16 pt-12">
    <h2 class="text-h3">Related Articles</h2>
    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
            <article class="rounded-md border border-ink/10 bg-panel overflow-hidden group hover:border-ink/20 hover:-translate-y-1 transition-all duration-300 relative">
                <a href="<?php the_permalink(); ?>" class="absolute inset-0 z-10"><span class="sr-only">Read <?php the_title(); ?></span></a>
                <div class="aspect-video bg-ink/5 relative overflow-hidden">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover']); ?>
                    <?php else : ?>
                        <div class="w-full h-full flex items-center justify-center text-ink-muted/30">
                            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="p-5 flex flex-col">
                    <div class="font-mono text-[11px] text-ink-muted uppercase tracking-[0.16em] mb-2 flex items-center gap-2">
                        <span><?php echo get_the_date('M j, Y'); ?></span>
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) :
                        ?>
                            <span class="w-1 h-1 rounded-full bg-ink-muted/40"></span>
                            <span><?php echo esc_html($categories[0]->name); ?></span>
                        <?php endif; ?>
                    </div>
                    <h3 class="text-h3 line-clamp-2 group-hover:text-primary transition-colors"><?php the_title(); ?></h3>
                    <p class="text-small text-ink-muted line-clamp-2 mt-2"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                </div>
            </article>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>
<?php endif; ?>
