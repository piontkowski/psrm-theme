<?php
/**
 * The front page template file.
 *
 * @package psrm
 */

get_header(); ?>

<?php if ( is_active_sidebar( 'home-museum-info' ) ): ?>

	<div class="row">
		<div id="above-content" class="museum-info content-area">
			<main id="above-main" class="above-site-main row">
				<?php dynamic_sidebar( 'home-welcome' ); ?>
			</main>
		</div>
	</div>

<?php endif; ?>

<div class="row">

	<div id="primary" class="content-area">
		<main id="main" class="site-main row" role="main">

			<div id="home-welcome" class="col-xs-12">
				<?php dynamic_sidebar( 'home-museum-info' ); ?>
			</div>
			<!-- #welcome -->

		</main>
		<!-- #main -->
	</div>
	<!-- #primary -->

</div>

<div class="row">

	<div id="secondary" class="content-area">
		<main id="main" class="site-main row" role="main">

			<div id="home-cta" class="home-widget-cta">
				<?php dynamic_sidebar( 'home-cta' ); ?>
			</div>

		</main>
		<!-- #main -->
	</div>
	<!-- #secondary -->

</div>
<div class="row">

	<div id="latest-news" class="content-area col-sm-8">
		<h1>From the Museum Mailbag</h1>
		<hr/>

		<?php
		while ( have_posts() ) : the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

					<div class="entry-meta">
						<?php psrm_posted_on(); ?> by <?php the_author(); ?>
					</div>
					<!-- .entry-meta -->
				</header>
				<!-- .entry-header -->

				<div class="entry-content">
					<?php
					the_excerpt();
					?>

				</div>
				<!-- .entry-content -->

				<footer class="entry-footer">
					<?php psrm_entry_footer(); ?>
				</footer>
				<!-- .entry-footer -->
			</article><!-- #post-## -->

		<?php endwhile; ?>

	</div>
	<div id="latest-news-sidebar" class="content-area col-sm-4">
		<h2>More News</h2>
		<hr/>
		<?php
		$more_news = new WP_Query( array( 'offset' => get_option('posts_per_page'), 'showposts' => 3 ) );

		while ( $more_news->have_posts() ): $more_news->the_post();
			?>

			<?php the_title( sprintf( '<h4><a href="%s" rel=bookmark>', esc_url( get_permalink() ) ), '</a></h4>' );
			psrm_posted_on(); ?>

		<?php
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</div>
<?php get_footer(); ?>
