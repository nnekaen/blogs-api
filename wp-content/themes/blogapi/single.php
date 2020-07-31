<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

	<section id="primary" class="content-area col-sm-12 col-lg-12">
		<main id="main" class="site-main single-blog" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			    the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</section><!-- #primary -->
  
<div class="container-fluid">

     <section id="emails" class="free-email-section col-sm-12 col-lg-12"> 
    <div class="container-fluid text-center">
		<h5 class="text-center">Get your secure email account</h5>
		<a href="/signup" class="btn btn-primary btn-lg">Create Account</a>
	</div>
</section>
		
</div> 

<?php

get_footer();
