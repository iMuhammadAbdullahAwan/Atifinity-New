<?php get_template_part('template-parts/header'); ?>
<main id="main" class="pt-36 sm:pt-40 lg:pt-44 container-x pb-20">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header mb-8">
				<?php the_title( '<h1 class="entry-title text-4xl font-bold text-white">', '</h1>' ); ?>
			</header>

			<div class="entry-content prose prose-invert max-w-none text-neutral-300">
				<?php the_content(); ?>
			</div>
		</article>
		<?php
	endwhile;
	?>
</main>
<?php get_template_part('template-parts/footer'); ?>
