<?php
/**
 * The template for displaying archive pages
 *
 * @package Atifinity
 */

get_template_part('template-parts/header');
?>

<main class="pt-36 sm:pt-40 lg:pt-44 pb-24 sm:pb-32">
    <section class="section relative z-10">
        <div class="container-x">
            <header class="mb-12">
                <h1 class="section-title data-reveal-text"><?php the_archive_title(); ?></h1>
                <?php if (get_the_archive_description()) : ?>
                    <div class="section-lede mt-6 max-w-2xl text-ink-muted data-reveal">
                        <?php echo wp_kses_post(wpautop(get_the_archive_description())); ?>
                    </div>
                <?php endif; ?>
            </header>

            <?php if (have_posts()) : ?>
                <div class="mt-14 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <?php
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/blog-card');
                    endwhile;
                    ?>
                </div>

                <div class="mt-16">
                    <?php
                    the_posts_pagination(array(
                        'prev_text' => __('&larr; Previous', 'atifinity'),
                        'next_text' => __('Next &rarr;', 'atifinity'),
                        'class' => 'pagination text-small',
                    ));
                    ?>
                </div>
            <?php else : ?>
                <p class="text-ink-muted text-small"><?php esc_html_e('No posts found in this archive.', 'atifinity'); ?></p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_template_part('template-parts/modals'); ?>
<?php get_template_part('template-parts/footer'); ?>
