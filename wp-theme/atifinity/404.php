<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Atifinity
 */

get_template_part('template-parts/header');
?>

<main class="pt-36 sm:pt-40 lg:pt-44 pb-24 sm:pb-32 flex items-center min-h-[70vh]">
    <section class="section relative z-10 w-full text-center">
        <div class="container-x max-w-2xl mx-auto">
            <div class="text-[120px] sm:text-[180px] font-bold leading-none text-ink/5 mb-6 data-reveal">
                404
            </div>
            
            <h1 class="section-title mb-6 data-reveal-text"><?php esc_html_e('Page Not Found', 'atifinity'); ?></h1>
            
            <p class="text-ink-muted text-small mb-12 data-reveal">
                <?php esc_html_e('It looks like nothing was found at this location. Maybe try a search or return to the homepage?', 'atifinity'); ?>
            </p>
            
            <div class="max-w-md mx-auto mb-12 data-reveal">
                <?php get_search_form(); ?>
            </div>
            
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary inline-flex data-reveal">
                <?php esc_html_e('Back to Homepage', 'atifinity'); ?>
            </a>
        </div>
    </section>
</main>

<?php get_template_part('template-parts/modals'); ?>
<?php get_template_part('template-parts/footer'); ?>
