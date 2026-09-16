<?php
/**
 * The template for displaying all single posts
 *
 * @package Atifinity
 */

get_template_part('template-parts/header');
?>

<main id="main" class="pt-36 sm:pt-40 lg:pt-44 pb-24 sm:pb-32">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" class="container-x max-w-3xl mx-auto">

            <!-- Post Header -->
            <header class="mb-14" data-reveal="lift">
                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-[11px] font-mono uppercase tracking-[0.16em] text-ink-muted mb-6">
                    <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('F j, Y'); ?></time>
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) :
                        echo '<span class="text-ink-muted/40">·</span>';
                        echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="hover:text-ink transition-colors">' . esc_html($categories[0]->name) . '</a>';
                    endif;
                    ?>
                    <span class="text-ink-muted/40">·</span>
                    <span><?php echo ceil(str_word_count(wp_strip_all_tags(get_the_content())) / 250); ?> min read</span>
                </div>

                <h1 class="text-hero"><?php the_title(); ?></h1>
            </header>

            <!-- Featured Image -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="mb-16 aspect-video w-full overflow-hidden rounded-md border border-ink/10" data-reveal="lift">
                    <?php the_post_thumbnail('blog-hero', ['class' => 'h-full w-full object-cover']); ?>
                </div>
            <?php endif; ?>

            <!-- Post Content -->
            <div class="
                prose prose-lg max-w-none
                prose-headings:font-heading prose-headings:text-ink prose-headings:tracking-tight
                prose-h2:text-2xl prose-h2:mt-12 prose-h2:mb-4 prose-h2:border-b prose-h2:border-ink/10 prose-h2:pb-3
                prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3
                prose-p:text-ink-muted prose-p:leading-relaxed prose-p:mb-6
                prose-a:text-primary prose-a:no-underline hover:prose-a:underline prose-a:font-medium
                prose-strong:text-ink prose-strong:font-semibold
                prose-blockquote:border-l-primary prose-blockquote:text-ink-muted prose-blockquote:font-normal
                prose-ul:text-ink-muted prose-ol:text-ink-muted
                prose-li:text-ink-muted prose-li:leading-relaxed
                prose-img:rounded-md prose-img:border prose-img:border-ink/10
                prose-code:text-primary prose-code:bg-ink/5 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded prose-code:text-sm prose-code:font-mono
                prose-pre:bg-panel prose-pre:border prose-pre:border-ink/10 prose-pre:rounded-md
                prose-hr:border-ink/10
            " data-reveal="lift">
                <?php the_content(); ?>

                <?php
                wp_link_pages(array(
                    'before' => '<div class="page-links text-small text-ink-muted mt-8 pt-4 border-t border-ink/10">' . esc_html__('Pages:', 'atifinity'),
                    'after'  => '</div>',
                ));
                ?>
            </div>

            <!-- Tags -->
            <?php
            $tags = get_the_tags();
            if ($tags) : ?>
                <div class="mt-12 pt-8 border-t border-ink/10 flex flex-wrap gap-2" data-reveal="lift">
                    <?php foreach ($tags as $tag) : ?>
                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="inline-block rounded-full border border-ink/10 px-3.5 py-1.5 text-[11px] font-mono uppercase tracking-[0.16em] text-ink-muted hover:border-primary/30 hover:text-primary hover:bg-primary/5 transition-all duration-200">
                            <?php echo esc_html($tag->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Post Navigation -->
            <nav class="mt-16 pt-8 border-t border-ink/10 grid sm:grid-cols-2 gap-8" data-reveal="lift">
                <?php
                $prev = get_previous_post();
                $next = get_next_post();
                ?>
                <div>
                    <?php if ($prev) : ?>
                        <a href="<?php echo get_permalink($prev); ?>" class="group block">
                            <span class="text-[11px] font-mono uppercase tracking-[0.16em] text-ink-muted flex items-center gap-2">
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                                Previous
                            </span>
                            <span class="mt-2 block text-h3 text-ink group-hover:text-primary transition-colors line-clamp-2">
                                <?php echo esc_html($prev->post_title); ?>
                            </span>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="text-right">
                    <?php if ($next) : ?>
                        <a href="<?php echo get_permalink($next); ?>" class="group block">
                            <span class="text-[11px] font-mono uppercase tracking-[0.16em] text-ink-muted flex items-center justify-end gap-2">
                                Next
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </span>
                            <span class="mt-2 block text-h3 text-ink group-hover:text-primary transition-colors line-clamp-2">
                                <?php echo esc_html($next->post_title); ?>
                            </span>
                        </a>
                    <?php endif; ?>
                </div>
            </nav>

            <!-- Comments -->
            <?php
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>

        </article>
    <?php endwhile; ?>
</main>

<?php get_template_part('template-parts/modals'); ?>
<?php get_template_part('template-parts/footer'); ?>
