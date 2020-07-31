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
             ?> <div class="csbtns">Share This!
			<a class="csbtns_reddit_share" href="http://reddit.com/submit?url=https://protonmail.com/blog/privacy-contact-tracing-apps/&amp;title=What you need to know about contact tracing apps and privacy" target="_blank" aria-label=" (opens in a new tab)"><i class="csbtns fa fa-reddit" ></i></a>
		  <a class="csbtns_facebook_share" href="http://www.facebook.com/sharer.php?u=https://protonmail.com/blog/privacy-contact-tracing-apps/" target="_blank" aria-label=" (opens in a new tab)"><i class="csbtns fa fa-facebook" ></i></a>
		  <a class="csbtns_email_share" href="mailto:?Subject=What you need to know about contact tracing apps and privacy&amp;Body=%20https://protonmail.com/blog/privacy-contact-tracing-apps/" aria-label=""><i class="csbtns fa fa-envelope" ></i></a>
		  <a class="csbtns_twitter_share" href="http://twitter.com/share?url=https://protonmail.com/blog/privacy-contact-tracing-apps/&amp;text=What+you+need+to+know+about+contact+tracing+apps+and+privacy+" target="_blank" aria-label=" (opens in a new tab)"><i class="csbtns fa fa-twitter" ></i></a>
			</div>
			    <?php
			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		<h4>
			Share
			</h4>
      
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
