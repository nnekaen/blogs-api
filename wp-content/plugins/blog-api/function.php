<?php

// functions to call the api for posts, comments and categories
function callWP(){
		
	return $response = wp_remote_get( 'https://protonmail.com/blog/wp-json/wp/v2/posts?per_page=5&_embed' );
	
	}
function callWPOne(){
		
	return $response= wp_remote_get( 'https://protonmail.com/blog/wp-json/wp/v2/posts?per_page=1&_embed' );
	
	}
function callcategories(){
		
	return $response = wp_remote_get( 'https://protonmail.com/blog/wp-json/wp/v2/categories' );
	
	}

function callcomment(){
		
	return $response = wp_remote_get( 'https://protonmail.com/blog/wp-json/wp/v2/comments' );
	
	}
// Get category names if there is a matach with the id in posts.
function get_category_api($id) {	
$getcategories = [];	
 $responses = callcategories();	
//
	// Get the body.
	$terms = json_decode( wp_remote_retrieve_body( $responses ));
	// Exit if nothing is returned.
	if ( empty( $terms ) ) {
		return;
	}
	// If there are categories.
	if ( ! empty( $terms ) ) {   
		// For each category.
		foreach ( $terms as $term ) {
            $term_name    = $term->id; // retrieve term id 
			if ($term->id === $id){
			array_push($getcategories);			
			return $term->name;
            // Show a linked title.
             }
		}
	}	
}

function get_post_id($id) {	
$getcategories = [];	
$responses = callWP();	
//
	// Get the body.
	$postss = json_decode( wp_remote_retrieve_body( $responses ));
	// Exit if nothing is returned.
	if ( empty( $postss ) ) {
		return;
	}
	// If there are posts.
	if ( ! empty( $postss ) ) {   
		// For each post.
		foreach ( $postss as $post ) {
            $ids = $post->categories[0]; 
			// post title 
		   if ($ids === $id){
			array_push($getcategories);			
			return $post->name;
            // Show a linked title and post date.
             }
            // Show a linked title and post date.
             
	}
	
	}	
}

// Get category slug if there is a match with the id in posts.
function get_category_slug_api($id) {
	
$getcategories = [];	
$responses = callcategories();	
//
	// Get the body.
	$terms = json_decode( wp_remote_retrieve_body( $responses ));
	// Exit if nothing is returned.
	if ( empty( $terms ) ) {
		return;
	}
	// If there are posts.
	if ( ! empty( $terms ) ) {   
		// For each category.
		foreach ( $terms as $term ) {
            $term_name    = $term->id; // cat id
			if ($term->id === $id){  // get slug values if the cat id matches the one in post from the API
			array_push($getcategories);			
			return $term->slug;
            // Show a linked slug.
             }
	}
	
	}	
}

function get_categories_name() {
 $getcategories = '';	
 $responses = callcategories();	
//
  echo'<ul id="filters">';
  echo '<div class="bar all"> <li><a class= "btn btn-ghost alt" href="#" data-filter="*" class="selected">Everything</a></li></div>';
	// Get the body.
	$terms = json_decode( wp_remote_retrieve_body( $responses ));
	// Exit if nothing is returned.
	if ( empty( $terms ) ) {
		return;
	}

	// If there are categories.
	if ( ! empty( $terms ) ) {   
		// For each post.
		foreach ( $terms as $term ) {
            $term_name    = $term->name; 
			  echo "<div class='bar''><li><a class= 'btn btn-ghost alt' href='#' data-filter='.".$term->slug."'>" . $term->name . "</a></li></div>";

			//create categories in WP dashboard
			$wpdocs_cat = array('cat_id' =>  $term->id,'cat_name' =>  $term_name, 'category_nicename' => $term->slug, 'category_parent' => '','taxonomy' => 'category');
			$term_id = wp_insert_category( $wpdocs_cat );
			
		}
	}
}



/**
 * Get posts via REST API.
 */
function get_postsWP() {	
	// Initialize variable.
	get_categories_name();
  echo "</ul>";
	
	// call rest API for 5 posts and the first post for featured section
	$response = callWP();
	$get_firstpost= callWPOne();
	

	// Exit if error.
	if ( is_wp_error( $response ) || is_wp_error( $get_firstpost) ) {
		return;
	}

	// Get the body.
	$posts = json_decode( wp_remote_retrieve_body( $response ));
	$firstpost = json_decode( wp_remote_retrieve_body( $get_firstpost ));
     
	// Exit if nothing is returned.
	if ( empty( $posts )  ) {
		return;
	}
	// add isotope-list id for filtering
	echo '<div class= "" id="isotope-list"><div class="row row-eq-height">';
	foreach ( $firstpost as $postss ) {
		// Get and display the result of the most recent post (featured)
	   $post_title_first   = $postss->title->rendered;
	   $post_except   = $postss->excerpt->rendered;		
		$post_images = $postss->_embedded->{'wp:featuredmedia'}[0]->source_url;
	    echo   '<div class="col-lg-6"><div class="container-img img-box" style="backgground-image:url("'.$post_images.'")"><img class="image" src=' .$post_images.'><div class="overlayn">
    <div class="text"><span class="span">Featured</span><h1>'.$post_title_first.'</h1></div></div><div class="overlay">
    <div class="text"><h3>' . $post_except.'</h3><a class="align-text readmore" href="https://dev-blog-api.pantheonsite.io/blog/' .  $postss->slug . '" target=\"_blank\"> Read More</a>'.$post->_embedded->{'replies'}[0]->source_url.'</div></div></div></div>';	
	}

	// If there are posts.
	if ( ! empty( $posts ) || ! empty ($firstpost) ) {   
		// For each post.
		foreach ( $posts as $post ) {
			// Get and display the results of the 5 last post (featured)			
             $post_title    = $post->title->rendered; // post title
	         $cat =get_category_api($post->categories[0]); 
			 $cat_slug= get_category_slug_api($post->categories[0]);
			 $date= date(' F jS, Y', strtotime($post->date_gmt));
			echo '<div class="col-lg-3 '.$cat_slug.' item"><div class="box"><img src="'.$post->_embedded->{'wp:featuredmedia'}[0]->source_url.'"/><div class="overlayn">
    <div class="ribbon"><span class="span">'.$cat.'</span></div></div><h2 class="align-text">' .  $post_title  . '</h2><p class="align-text date">'.$date.'</p><p class="align-text"'.$post->excerpt->rendered.'</p><a class="align-text readmore" href="https://dev-blog-api.pantheonsite.io/blog/' .  $post->slug . '" target=\"_blank\"> Read More</a></div></div><br />';	
     	}	
	}
		
}
// Register as a shortcode to be used on the site.
add_shortcode( 'get_blog_via_rest', 'get_postsWP' );

function create_post_api(){
	$responses = callWP();	
//
	// Get the body.
	$postss = json_decode( wp_remote_retrieve_body( $responses ));
	// Exit if nothing is returned.
	if ( empty( $postss ) ) {
		return;
	}
	// If there are posts.
	if ( ! empty( $postss ) ) {   
		// For each post.
		foreach ( $postss as $post ) {
            
			$ids = $post->categories[0]; 
		    $foundpost = post_exists( $post_title);	
		
			if (! $foundpost ) {			
			$my_posts = array(
				'post_title'  => $post_title,
				'post_name'  => $post->slug,
				'post_date' => $post->date,
				'post_content'  => $post->content->rendered,
				'post_category' => $post->categories,
				'media_urls' =>  $post->_embedded->{'wp:featuredmedia'}[0]->source_url,		  
				'post_status' => 'publish',
				'post_type'   => 'post',
			);
				$post_id = wp_insert_post( $my_posts );

			
				$image_url =$post->_embedded->{'wp:featuredmedia'}[0]->source_url;
				$upload_dir = wp_upload_dir();
				$image_data = file_get_contents( $image_url );
				$filename = basename( $image_url );
				if ( wp_mkdir_p( $upload_dir['path'] ) ) {
					$file = $upload_dir['path'] . '/' . $filename;
				}
				else {
					$file = $upload_dir['basedir'] . '/' . $filename;
				}
				file_put_contents( $file, $image_data );
				$wp_filetype = wp_check_filetype( $filename, null );
				$attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title' => sanitize_file_name( $filename ),
					'post_content' => '',
					'post_status' => 'inherit'
				);
				$attach_id = wp_insert_attachment( $attachment, $file );
				require_once( ABSPATH . 'wp-admin/includes/image.php' );
				$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
				wp_update_attachment_metadata( $attach_id, $attach_data );
				set_post_thumbnail( $post_id, $attach_id);
			}	
		}
	}	
}

add_filter( 'the_api_insert_post', 'create_post_api' );
