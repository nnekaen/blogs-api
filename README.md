
# blogs- WordPress api
Protonmail Blogs from WordPress API

This project requires replicated the <a href="https://protonmail.com/blog/">blog page </a> of Protonmail using the WordPress REST API. More on the API documentation can be found at <a href="https://developer.wordpress.org/rest-api/">here </a>. 

<H3>Stages</h3>
<ul>
  <h4>Setting up the WordPress server</h2>  
  <li>To set up the server, I used Pantheon.io platform for both files and database setup which allows us to create a development and test environment workflow for WordPress. </li>
  <li>The Wordpresssite  files were cloned from Pantheon using git. I worked from the local environment to make some few configuration to the files before commiting them (added plugin files, new file structure and activated WP_debug in wp-config.php</li>
  <li>Created a plugin folder called "blog-api" where some of the functions for implementing the Wordpress API will be executed : https://github.com/nnekaen/blogs-api/tree/master/wp-content/themes/blogapi</li>
 <li> For the project, I created a child theme from wp boostrap started template and copied all the important files. See: https://github.com/nnekaen/blogs-api/tree/master/wp-content/themes/blogapi
      
