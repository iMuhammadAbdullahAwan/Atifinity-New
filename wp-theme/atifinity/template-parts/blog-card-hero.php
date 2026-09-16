<?php
/**
 * Template part for displaying large featured/hero card for the first post on blog archive
 */
?>
<article class="group rounded-md overflow-hidden border border-ink/10 bg-panel hover:border-ink/20 transition-all duration-300 relative sm:grid sm:grid-cols-2 sm:gap-0">
    <a href="<?php the_permalink(); ?>" class="absolute inset-0 z-10"><span class="sr-only">Read <?php the_title(); ?></span></a>
    
    <div class="aspect-video sm:aspect-auto sm:h-full bg-ink/5 relative overflow-hidden">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500']); ?>
        <?php else : ?>
            <div class="w-full h-full flex items-center justify-center text-ink-muted/30">
                <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="p-8 sm:p-10 flex flex-col justify-center">
        <?php
        $categories = get_the_category();
        if (!empty($categories)) :
        ?>
            <div>
                <span class="inline-block rounded-full border border-primary/20 bg-primary/5 px-3 py-1 text-[11px] font-mono uppercase tracking-[0.16em] text-primary">
                    <?php echo esc_html($categories[0]->name); ?>
                </span>
            </div>
        <?php endif; ?>
        
        <h2 class="text-2xl sm:text-3xl font-heading font-bold text-ink mt-4 group-hover:text-primary transition-colors line-clamp-3">
            <?php the_title(); ?>
        </h2>
        
        <div class="text-body text-ink-muted mt-4 line-clamp-3">
            <?php the_excerpt(); ?>
        </div>
        
        <div class="mt-6 flex items-center gap-3 text-[11px] font-mono uppercase tracking-[0.16em] text-ink-muted">
            <span><?php echo get_the_date('M j, Y'); ?></span>
            <span class="w-1 h-1 rounded-full bg-ink-muted/40"></span>
            <span><?php echo function_exists('atifinity_reading_time') ? atifinity_reading_time() : '5 min read'; ?></span>
        </div>
        
        <div class="mt-4 text-small font-medium text-primary">
            Read article →
        </div>
    </div>
</article>
