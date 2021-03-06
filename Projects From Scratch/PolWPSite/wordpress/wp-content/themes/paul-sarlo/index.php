<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Paul_Sarlo
 */
 if ( is_home() ) { 
	$currentpageID = get_option('page_for_posts', true);
  } else { $currentpageID = $post-> ID; } 

$header_image = get_post_field('header_image', $currentpageID , 'display');
get_header();
?>
<main id="primary" class="site-main">
<div class="row headerImage align-items-center" style="background-image: linear-gradient(to top, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.4) 15%, rgba(0, 0, 0, 0.8) 100%), url('<?php echo wp_get_attachment_url( $header_image); ?>');">

    <div class="col-12 headerImageText">
	<h1 class="text-center">
		<?php  if ( is_home() ) { 
			echo get_the_title( get_option('page_for_posts', true) );?>
			<?php  } else { the_title(); } ?>
				</h1>
            </div>
    </div>
<div class="container-fluid posts">
    <div class="row">
        <div class="col-md-2"></div>
        <div id="postscontainer" class="col-md-8 col-sm-12 col-12 ">
	

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );



			endwhile;



		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		<div class="row">
			<div class="col-3 rollPagination"><?php previous_posts_link();   ?></div>
			<div class="col-7"></div>
			<div class="col-2 rollPagination"><?php next_posts_link(); ?></div>
		</div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

</div>
	</main><!-- #main -->

<?php get_footer(); ?>