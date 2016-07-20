<?php
include 'model/m_events.php';
include 'model/pagination_class.php';


 function display_posts($title = '', $status = '', $keywords = '')
{


    $Posts = new Posts();
    $posts = $Posts->get_blog_posts('', 'publish', $keywords);

        if (empty($posts)) 
        {
            echo '<p>There are currently no events!</p>';
        } 
        else
        {
        // If we have an array with items
        if (count($posts)) {
          // Create the pagination object
          $pagination = new pagination($posts, (isset($_GET['page']) ? $_GET['page'] : 1), 5);
          // Decide if the first and last links should show
          $pagination->setShowFirstAndLast(false);
          // Parse through the pagination class
          $blogPages = $pagination->getResults();
          // If we have items 
          if (count($blogPages) != 0) {
            // Create the page numbers
             $pageNumbers = $pagination->getLinks($_GET);
            // Loop through all the items in the array
            foreach ($blogPages as $blogArray) {
              // Show the information about the item
            {
                echo

                '<div class="entry clearfix">
                  <div class="entry-title">
                  <h2><a href="blog-single.php?title='.str_replace(" ", "_", $blogArray['title']).'">'.$blogArray['title'].'</a></h2>
                </div>
                <ul class="entry-meta clearfix">
                  <li><i class="icon-calendar3"></i>'.$blogArray["timestamp"].'</li>
                  <li><a href="#"><i class="icon-user"></i>'.$blogArray["author"].'</a></li>
                  <li><i class="icon-folder-open"></i> <a href="#">'.$blogArray["topic"].'</a></li>
                </ul>

                <div class="entry-image">
                  <a href="blog-single.php?title='.str_replace(" ", "_", $blogArray['title']).'"><img class="image_fade" src="admin/images/blog_images/'.$blogArray['image_name'].'" alt="'.$blogArray['title'].'"></a>
                </div>
    
                <div class="entry-content">
                  <p>'.$blogArray["short_content"].'</p>
                  <a href="blog-single.php?title='.str_replace(" ", "_", $blogArray['title']).'" class="more-link">Read More</a>
                </div>
                </div>';
              }          
            }
          }
        }
      }           
// print out the page numbers beneath the results
            echo '</div>';
            echo'<div class="center">';
            echo '<ul class="pagination">'; 
            echo $pageNumbers;
            echo '</ul>';
            echo '</div>';

}

 function get_blog_tags()
{
  $Tags = new Posts();
  $tags = $Tags->get_blog_tags();

  foreach ($tags as $tag) {
  echo '<a href="blog.php?tag='.$tag["keyword"].'">'.$tag["keyword"].'</a>';
  
  }
}   


?>