<?php
/**
 * The template for displaying search results pages
 *
 * @package Atifinity
 */

get_template_part('template-parts/header');
?>

<main class="pt-36 sm:pt-40 lg:pt-44 pb-24 sm:pb-32">
    <section class="section relative z-10">
        <div class="container-x">
            <header class="mb-12">
                <h1 class="section-title data-reveal-text">
                    <?php
                    /* translators: %s: search query. */
                    printf(esc_html__('Search Results for: %s', 'atifinity'), '<span>' . get_search_query() . '</span>');
                    ?>
                </h1>
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
                <div class="max-w-xl">
                    <p class="text-ink-muted text-small mb-8"><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'atifinity'); ?></p>
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_template_part('template-parts/modals'); ?>
<?php get_template_part('template-parts/footer'); ?>
