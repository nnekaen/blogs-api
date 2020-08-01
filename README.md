
# blogs- WordPress api
Protonmail Blogs from WordPress API

This project requires replicated the <a href="https://protonmail.com/blog/">blog page </a> of Protonmail using the WordPress REST API. More on the API documentation can be found at <a href="https://developer.wordpress.org/rest-api/">here </a>. 

<H3>Stages</h3>
<ul>
  <h3>Setting up the WordPress server</h3>  
  <li>To set up the server, I used Pantheon.io platform for both files and database setup which allows us to create a development and test environment workflow for WordPress. </li>
  <li>The Wordpress site  files and folders were cloned from Pantheon using git. I worked from my local environment to make some few configuration to the files before commiting them (added plugin files, new file structure and activated WP_debug in wp-config.php</li>
  <li>Created a plugin folder called "blog-api" where some of the functions for implementing the Wordpress API will be executed : https://github.com/nnekaen/blogs-api/tree/master/wp-content/themes/blogapi</li>
 <li> For the project, I created a child theme from wp boostrap started template and copied all the important files. See: https://github.com/nnekaen/blogs-api/tree/master/wp-content/themes/blogapi</li>
      
   <h3>Retrieving the last five posts from ProtonMail API</h3>
   To retrieve the post. I created functions to call api endpoints withs posts and categegories.
   For the first 5 most recent posts, I used a function :
   
   function callWPOne(){
   return $response= wp_remote_get( 'https://protonmail.com/blog/wp-json/wp/v2/posts?per_page=1&_embed' );
   }
   _embed allows us to retrieve also the featured image.
   
   
   <h3>Displying blog contents in single post</h3>
   <h3>Other deliverables </h3>
   <b>SEO considerations</b> :
   <b> Page speed performance</b>:<br>
   <b> Isotope Layout </b><br>
   <b> Mobile responsiveness </b><br>
   <b> clean coding </b>
