<?php
include 'model/m_events.php';


function display_blog_post()
{
    $title = str_replace("_", " ", $_GET['title']);
    $Posts = new Posts();
    $post = $Posts->get_blog_posts($title,''); 

    echo ' <!-- Single Post
            ============================================= -->
            <div class="entry clearfix">

              <!-- Entry Title
              ============================================= -->
              <div class="entry-title">
                <h2>'.$post[0]['title'].'</h2>
              </div><!-- .entry-title end -->

              <!-- Entry Meta
              ============================================= -->
              <ul class="entry-meta clearfix">
                <li><i class="icon-calendar3"></i> '.$post[0]['timestamp'].'</li>
                <li><a href="#"><i class="icon-user"></i> '.$post[0]['author'].'</a></li>
                <li><i class="icon-folder-open"></i> <a href="#">'.$post[0]['topic'].'</a></li>
              </ul><!-- .entry-meta end -->

              <!-- Entry Image
              ============================================= -->
              <div class="entry-image bottommargin">
                <a href="#"><img src="admin/images/blog_images/'.$post[0]['image_name'].'" alt="'.$post[0]['title'].'"></a>
              </div><!-- .entry-image end -->

              <!-- Entry Content
              ============================================= -->
              <div class="entry-content notopmargin" style="text-align: justify;">

                <p>'.html_entity_decode($post[0]['content']).'</p>
                <!-- Post Single - Content End -->


                <div class="clear"></div>

                <!-- Post Single - Share
                ============================================= -->
                <div class="si-share clearfix">
                  <span>Share this Post:</span>
                  <div>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=www.banhass.com/blog-post.php?title='.$_GET['title'].'" class="social-icon si-borderless si-facebook">
                      <i class="icon-facebook"></i>
                      <i class="icon-facebook"></i>
                    </a>
                    <a href="https://twitter.com/share" class="social-icon si-borderless si-twitter">
                      <i class="icon-twitter"></i>
                      <i class="icon-twitter"></i>
                    </a>
                    <a href="#" class="social-icon si-borderless si-pinterest">
                      <i class="icon-pinterest"></i>
                      <i class="icon-pinterest"></i>
                    </a>
                    <a href="#" class="social-icon si-borderless si-gplus">
                      <i class="icon-gplus"></i>
                      <i class="icon-gplus"></i>
                    </a>
                    <a href="#" class="social-icon si-borderless si-rss">
                      <i class="icon-rss"></i>
                      <i class="icon-rss"></i>
                    </a>
                    <a href="#" class="social-icon si-borderless si-email3">
                      <i class="icon-email3"></i>
                      <i class="icon-email3"></i>
                    </a>
                  </div>
                </div><!-- Post Single - Share End -->

              </div>
            </div><!-- .entry end -->';
      } 

function display_blog_picture()
{
    $title = str_replace("_", " ", $_GET['title']);
    $Posts = new Posts();
    $post = $Posts->get_blog_posts($title,''); 

    echo '
            <img data-fixed class="home-2-slide-bg" src="../grand/admin/Template/images/blog_images/'.$post[0]['image_name'].'" alt="'.$title.'">';
      } 

      ?>
