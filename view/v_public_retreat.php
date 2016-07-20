<?php
include 'model/m_events.php';


function display_retreats()
{
    $Retreats = new Posts();
    $retreats = $Retreats->get_retreats(); 
    $i = 0;

if (empty($retreats)) 
  {
      echo '<div class="col-md-10 col-md-offset-1 row common-height clearfix"> <p>There are currently no retreats!</p>';
      echo '<p>Why not check out the latest post on the <a href="blog.php">blog</a></p></div>';
            
  } 

    foreach($retreats as $retreat)
    {
      if ($i % 2 === 0)
      {
        echo '<div class="col-md-10 col-md-offset-1 row common-height clearfix">

          <div class="col-sm-6 col-padding" style="background: url(\'admin/images/retreat_images/'.$retreat['image_1'].'\') center center no-repeat; background-size: cover; "></div>

          <div class="col-sm-6 col-padding" style=" background-color: #f9f9f9;">
            <div>
              <div class="heading-block" style="margin-top: -40px;">
                <span class="before-heading">'.$retreat['hotel'].'</span>
                <h3>'.$retreat['location'].'</h3>
              </div>

              <div class="row clearfix">

                <div class="col-md-12" style="text-align: justify;">
                  <p>'.$retreat['short_text'].'</p>
                  <a href="retreat.php?location='.$retreat['location'].'" class="more-link">Learn More</a>
                </div>

              </div>

            </div>
          </div>

        </div>';
        $i++;
      }
      else
      {
        echo'
        <div class="col-md-10 col-md-offset-1 row common-height clearfix" style="margin-bottom: 50px;">

          <div class="col-sm-6 col-padding" style=" background-color: #f9f9f9; height: 100%;">
            <div>
              <div class="heading-block" style="margin-top: -45px;">
                <span class="before-heading">'.$retreat['hotel'].'</span>
                <h3>'.$retreat['location'].'</h3>
              </div>

              <div class="row clearfix">

                <div class="col-md-12" style="text-align: justify;">
                  <p>'.$retreat['short_text'].'</p>
                  <a href="retreat.php?location='.$retreat['location'].'" class="more-link">Learn More</a>
                </div>

              </div>

            </div>
          </div>

          <div class="col-sm-6 col-padding" style="background: url(\'images/team/'.$retreat['image_2'].'\') center center no-repeat; background-size: cover;"></div>

        </div>';
                $i++;
      }
    }
} 

function display_retreat()
{

    $location = $_GET['location'];
    $Retreats = new Posts();
    $retreats = $Retreats->get_retreats($location);

    echo '

            <!-- Portfolio Single Image
        ============================================= -->
        <div class="portfolio-single-image portfolio-single-image-full" style="background-image: url(\'images/portfolio/full/'.$retreats[0]['image_1'].'\');" data-stellar-background-ratio="0.5"></div><!-- .portfolio-single-image end -->

        <div class="container clearfix">

          <div class="col_one_third nobottommargin">

    <!-- Portfolio Single - Meta
            ============================================= -->
            <div class="panel panel-default events-meta">
              <div class="panel-body">
                <ul class="portfolio-meta nobottommargin">
                  <li><span><i class="icon-map-marker"></i>Location:</span> '.$retreats[0]['location'].'</li>
                  <li><span><i class="icon-map-marker2"></i>Hotel:</span> '.$retreats[0]['hotel'].'</li>
                  <li><span><i class="icon-calendar3"></i>Starting on:</span> '.$retreats[0]['date'].'</li>
                  <li><span><i class="icon-info"></i>Type:</span> '.$retreats[0]['type'].'</li>
                  <li><span><i class="icon-plane"></i>Remaining Spaces:</span> '.$retreats[0]['open'].'</li>
                  <li><br /></li>
                  <li class="center"><a href="retreat-book.php?location='.$retreats[0]['location'].'" class="button">Reserve Your Place</a></li>
                </ul>
              </div>
            </div>
            <!-- Portfolio Single - Meta End -->

            <!-- Portfolio Single - Share
            ============================================= -->
            <div class="si-share noborder clearfix">
              <span>Share:</span>
              <div>
                <a href="#" class="social-icon si-borderless si-facebook">
                  <i class="icon-facebook"></i>
                  <i class="icon-facebook"></i>
                </a>
                <a href="#" class="social-icon si-borderless si-twitter">
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
            </div>
            <!-- Portfolio Single - Share End -->

          </div>

          <!-- Portfolio Single Content
          ============================================= -->
          <div class="col_two_third portfolio-single-content col_last nobottommargin">

            <!-- Portfolio Single - Description
            ============================================= -->
            <div class="fancy-title title-bottom-border" style="margin-top: 0px;">
              <h2>'.$retreats[0]['location'].' - '.$retreats[0]['hotel'].'</h2>
            </div>

            <div class="nobottommargin" style="text-align: justify;">
              <p>'.$retreats[0]['short_text'].'</p>
            </div>
            <!-- Portfolio Single - Description End -->

          </div><!-- .portfolio-single-content end -->

        </div>

          <div class="container clearfix product" style="padding-top: 50px;">         
            <div class="product-image">
              <div class="fslider divcenter" data-pagi="false" data-arrows="true" data-thumbs="false">
                <div class="flexslider">
                  <div class="slider-wrap" data-lightbox="gallery" >';

                  if (!empty($retreats[0]['image_2']))
                  {
                    echo '<div class="slide" data-thumb="admin/images/retreat_images/'.$retreats[0]['image_2'].'"><a href="admin/images/retreat_images/'.$retreats[0]['image_2'].'" data-lightbox="gallery-item"><img src="admin/images/retreat_images/'.$retreats[0]['image_2'].'" alt="Pink Printed Dress" draggable="false"></a></div>';
                  }
                  if (!empty($retreats[0]['image_3']))
                  {
                    echo '<div class="slide" data-thumb="admin/images/retreat_images/'.$retreats[0]['image_3'].'"><a href="admin/images/retreat_images/'.$retreats[0]['image_3'].'" data-lightbox="gallery-item"><img src="admin/images/retreat_images/'.$retreats[0]['image_3'].'" alt="Pink Printed Dress" draggable="false"></a></div>';
                  }
                  if (!empty($retreats[0]['image_4']))
                  {
                    echo '<div class="slide" data-thumb="admin/images/retreat_images/'.$retreats[0]['image_4'].'"><a href="admin/images/retreat_images/'.$retreats[0]['image_4'].'" data-lightbox="gallery-item"><img src="admin/images/retreat_images/'.$retreats[0]['image_4'].'" alt="Pink Printed Dress" draggable="false"></a></div>';
                  }
                  if (!empty($retreats[0]['image_5']))
                  {
                    echo '<div class="slide" data-thumb="admin/images/retreat_images/'.$retreats[0]['image_5'].'"><a href="admin/images/retreat_images/'.$retreats[0]['image_5'].'" data-lightbox="gallery-item"><img src="admin/images/retreat_images/'.$retreats[0]['image_5'].'" alt="Pink Printed Dress" draggable="false"></a></div>';
                  }
                  if (!empty($retreats[0]['image_6']))
                  {
                    echo '<div class="slide" data-thumb="admin/images/retreat_images/'.$retreats[0]['image_6'].'"><a href="admin/images/retreat_images/'.$retreats[0]['image_6'].'" data-lightbox="gallery-item"><img src="admin/images/retreat_images/'.$retreats[0]['image_6'].'" alt="Pink Printed Dress" draggable="false"></a></div>';
                  }
                    echo '
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="container clearfix" style="padding-top: 50px;">

          

            <!-- Portfolio Single - Description
            ============================================= -->
            <div class="fancy-title title-bottom-border" style="margin-top: 0px;">
              <h2></h2>
            </div>

            <div class="portfolio-single-content col_last nobottommargin">
              
              <div class="nobottommargin" style="text-align: justify;">
                <p>'.$retreats[0]['long_text'].'</p>
              </div>
              <div class="center" style="margin-bottom: 50px;">
                <a href="retreat-book.php?location='.$retreats[0]['location'].'" class="button button-desc" style="text-align: center;"><div>Reserve Now<span> You deserve it </span></div></a>
              </div>
            <!-- Portfolio Single - Description End -->

          </div><!-- .portfolio-single-content end -->
          </div>';
      } 

      function display_retreat_reserve()
      {

          $location = $_GET['location'];
          $Retreats = new Posts();
          $retreats = $Retreats->get_retreats($location);

          echo '

                  <!-- Portfolio Single Image
              ============================================= -->
              <div class="portfolio-single-image portfolio-single-image-full" style="background-image: url(\'images/portfolio/full/'.$retreats[0]['hero'].'\');" data-stellar-background-ratio="0.5"></div><!-- .portfolio-single-image end -->

              <div class="container clearfix">

                <div class="col_one_third nobottommargin">

          <!-- Portfolio Single - Meta
                  ============================================= -->
                  <div class="panel panel-default events-meta">
                    <div class="panel-body">
                      <ul class="portfolio-meta nobottommargin">
                        <li><span><i class="icon-map-marker"></i>Location:</span> '.$retreats[0]['location'].'</li>
                        <li><span><i class="icon-map-marker2"></i>Hotel:</span> '.$retreats[0]['hotel'].'</li>
                        <li><span><i class="icon-calendar3"></i>Starting on:</span> '.$retreats[0]['date'].'</li>
                        <li><span><i class="icon-lightbulb"></i>Type:</span> '.$retreats[0]['type'].'</li>
                        <li><br /></li>
                        <li class="center"><a href="#" class="button">Reserve Your Place</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- Portfolio Single - Meta End -->

                  <!-- Portfolio Single - Share
                  ============================================= -->
                  <div class="si-share noborder clearfix">
                    <span>Share:</span>
                    <div>
                      <a href="#" class="social-icon si-borderless si-facebook">
                        <i class="icon-facebook"></i>
                        <i class="icon-facebook"></i>
                      </a>
                      <a href="#" class="social-icon si-borderless si-twitter">
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
                  </div>
                  <!-- Portfolio Single - Share End -->

                </div>

                <!-- Portfolio Single Content
                ============================================= -->
                <div class="col_two_third portfolio-single-content col_last nobottommargin">

                  <!-- Portfolio Single - Description
                  ============================================= -->
                  <div class="fancy-title title-bottom-border" style="margin-top: 0px;">
                    <h2>'.$retreats[0]['location'].' - '.$retreats[0]['hotel'].'</h2>
                  </div>

                  <div class="nobottommargin" style="text-align: justify;">
                    <p>'.$retreats[0]['short_text'].'</p>
                  </div>
                  <!-- Portfolio Single - Description End -->

                </div><!-- .portfolio-single-content end -->

          </div>

        <div class="container clearfix">

          <div id="processTabs">
            <ul class="process-steps bottommargin clearfix">
              <li>
                <a href="#ptab1" class="i-circled i-bordered i-alt divcenter">1</a>
                <h5>Review Cart</h5>
              </li>
              <li>
                <a href="#ptab2" class="i-circled i-bordered i-alt divcenter">2</a>
                <h5>Enter Shipping Info</h5>
              </li>
              <li>
                <a href="#ptab3" class="i-circled i-bordered i-alt divcenter">3</a>
                <h5>Complete Payment</h5>
              </li>
              <li>
                <a href="#ptab4" class="i-circled i-bordered i-alt divcenter">4</a>
                <h5>Order Complete</h5>
              </li>
            </ul>
            <div>
              <div id="ptab1">

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, ipsa, fuga, modi, corporis maiores illum fugit ratione cumque dolores sint obcaecati quod temporibus. Expedita, sapiente, veritatis, impedit iusto labore sed itaque sunt fugiat non quis nihil hic quos necessitatibus officiis mollitia nesciunt neque! Minus, mollitia at iusto unde voluptate repudiandae.</p>

                <div class="table-responsive">

                  <table class="table cart">
                    <thead>
                      <tr>
                        <th class="cart-product-remove">&nbsp;</th>
                        <th class="cart-product-thumbnail">&nbsp;</th>
                        <th class="cart-product-name">Product</th>
                        <th class="cart-product-price">Unit Price</th>
                        <th class="cart-product-quantity">Quantity</th>
                        <th class="cart-product-subtotal">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="cart_item">
                        <td class="cart-product-remove">
                          <a href="#" class="remove" title="Remove this item"><i class="icon-trash2"></i></a>
                        </td>

                        <td class="cart-product-thumbnail">
                          <a href="#"><img width="64" height="64" src="images/shop/thumbs/small/dress-3.jpg" alt="Pink Printed Dress"></a>
                        </td>

                        <td class="cart-product-name">
                          <a href="#">Pink Printed Dress</a>
                        </td>

                        <td class="cart-product-price">
                          <span class="amount">$19.99</span>
                        </td>

                        <td class="cart-product-quantity">
                          <div class="quantity clearfix">
                            <input type="button" value="-" class="minus">
                            <input type="text" step="1" min="1"  name="quantity" value="1" title="Qty" class="qty" size="4" />
                            <input type="button" value="+" class="plus">
                          </div>
                        </td>

                        <td class="cart-product-subtotal">
                          <span class="amount">$19.99</span>
                        </td>
                      </tr>
                      <tr class="cart_item">
                        <td class="cart-product-remove">
                          <a href="#" class="remove" title="Remove this item"><i class="icon-trash2"></i></a>
                        </td>

                        <td class="cart-product-thumbnail">
                          <a href="#"><img width="64" height="64" src="images/shop/thumbs/small/shoes-2.jpg" alt="Checked Canvas Shoes"></a>
                        </td>

                        <td class="cart-product-name">
                          <a href="#">Checked Canvas Shoes</a>
                        </td>

                        <td class="cart-product-price">
                          <span class="amount">$24.99</span>
                        </td>

                        <td class="cart-product-quantity">
                          <div class="quantity clearfix">
                            <input type="button" value="-" class="minus">
                            <input type="text" step="1" min="1"  name="quantity" value="1" title="Qty" class="qty" size="4" />
                            <input type="button" value="+" class="plus">
                          </div>
                        </td>

                        <td class="cart-product-subtotal">
                          <span class="amount">$24.99</span>
                        </td>
                      </tr>
                    </tbody>

                  </table>

                </div>

                <a href="#" class="button button-3d nomargin fright tab-linker" rel="2">Checkout &rArr;</a>

              </div>
              <div id="ptab2">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, deleniti, atque soluta ratione blanditiis maxime at architecto laudantium eius eaque distinctio dolorem voluptatem nam ab molestias velit nemo. Illo, hic.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, modi, odit, aspernatur veritatis ipsum molestiae impedit iusto blanditiis voluptatem ab voluptas ullam expedita repellendus porro assumenda non deserunt repellat eius rem dolorem corporis temporibus voluptatibus ut! Quod, corporis, tempora, dolore, sint earum minus deserunt eveniet natus error magnam aliquam nemo.</p>
                <div class="line"></div>
                <a href="#" class="button button-3d nomargin tab-linker" rel="1">Previous</a>
                <a href="#" class="button button-3d nomargin fright tab-linker" rel="3">Pay Now</a>
              </div>
              <div id="ptab3">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis, sit, culpa, placeat, tempora quibusdam molestiae cupiditate atque tempore nemo tenetur facere voluptates autem aliquid provident distinctio beatae odio maxime pariatur eos ratione quae itaque quod. Distinctio, temporibus, cupiditate, eaque vero illo molestiae vel doloremque dolorum repellat ullam possimus modi dicta eum debitis ratione est in sunt et corrupti adipisci quibusdam praesentium optio laborum tempora ipsam aut cum consectetur veritatis dolorem.</p>
                <div class="line"></div>
                <a href="#" class="button button-3d nomargin tab-linker" rel="2">Previous</a>
                <a href="#" class="button button-3d nomargin fright tab-linker" rel="4">Complete Order</a>
              </div>
              <div id="ptab4">
                <div class="alert alert-success">
                  <strong>Thank You.</strong> Your order will be processed once we verify the Payment.
                </div>
              </div>
            </div>
          </div>

          <div class="clear"></div>

          
        </div>';
            }

      ?>
