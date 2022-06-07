<?php
require_once 'database/db-con.php';
require_once 'utility/convert-time-ago.php'
?>
<footer>
   <div class="footer-area pt-50 pl-50 bg-white">
      <div class="container">
         <div class="row pb-30">
            <div class="col-md-3 p-30">
               <h2 class="mb-40"> અમારા વિશે </h2>
               <p> રમેશ તન્ના જેને ગુજરાતના ‘ડિજિટલ ગિજુભાઈ’ ગણે છે તેવા ધનંજય રાવલ ગુજરાતના યુવાનો માટે એકવીસમી સદીને અનુરૂપ ટૅક્‌નૉલૉજીના વિનિયોગ માટે, પ્રસાર-પ્રચાર માટે અંકુર હૉબી સેન્ટરના માધ્યમથી પોતાની આગવી રીતે સમાજની સેવા કરી રહ્યા છે.</p>
               <ul class="float-left mr-30 font-medium">
                  <li class="mt-10">
                     <a href="#">
                        <p>
                           <i class="fas fa-map-marker-alt mr-10"></i><span class="">302, યશ એક્વા, મેકડોનાલ્ડ્સ ની ઉપર, વિજય ચાર રસ્તા,  નવરંગપુરા, અમદાવાદ 380009</span>
                        </p>
                     </a>
                  </li>
                  <li class="mt-10">
                     <a href="tel:+919824034475">
                        <p>
                           <i class="fas fa-phone-alt mr-10"></i><span class="">+91 9824034475</span>
                        </p>
                     </a>
                  </li>
                  <li class="mt-10">
                     <a href="mailto:info@navisavar.com">
                        <p>
                           <i class="fas fa-envelope mr-10"></i><span class="">info@navisavar.com</span>
                        </p>
                     </a>
                  </li>
               </ul>
            </div>
            <div class="col-md-3 p-30">
               <h2 class="mb-40"> શ્રેણીઓ </h2>
               <ul class="float-left mr-30 font-medium">
                  <?php
                  $query1 = "SELECT * FROM `category_list` LIMIT 5";
                  $run_query1 = mysqli_query($con, $query1);
                  if ($run_query1) {
                     while ($data1 = mysqli_fetch_assoc($run_query1)) {
                        $category_id = $data1['id'];
                        $unique_link = $data1['unique_link'];
                  ?>
                        <li class="mt-5">
                           
                              <a class="" href="<?php echo $very_global_absolute_url; ?>category/<?php echo $unique_link ?>" tabindex="0"><p><?php echo $data1['name']; ?></p></a>
                           
                        </li>
                  <?php
                     }
                  }
                  ?>
               </ul>
            </div>
            <div class="col-md-3 p-30">
               <h2 class="mb-40"> પૃષ્ઠો </h2>
               <ul class="float-left mr-30 font-medium">
                  <li class="mt-5">
                   
                        <a class="" href="<?php echo $very_global_absolute_url; ?>about" tabindex="0">  <p>વિશે</p></a>
                    
                  </li>
                  <li class="mt-5">
                    
                        <a class="" href="<?php echo $very_global_absolute_url; ?>contact" tabindex="0">  <p>સંપર્ક કરો</p></a>
                     
                  </li>
               </ul>
            </div>
            <div class="col-md-3 p-30">
               <h2 class="mb-40">તાજેતરનો બ્લોગ</h2>
               <div class="post-aside-style-2">
                  <ul class="list-post">
                     <?php
                     $sql = "SELECT * FROM blog WHERE `is_deleted` = 0 ORDER BY publish_date DESC LIMIT 3";
                     $result = mysqli_query($con, $sql);
                     if (mysqli_num_rows($result) > 0) {
                        while ($data3 = mysqli_fetch_assoc($result)) {
                           $category_id = $data3['category_id'];
                           $unique_link = $data3['unique_link'];
                           $author_id = $data3['added_by'];

                           $query4 = "SELECT * FROM `users` WHERE `id` = $author_id";
                           $run_query4 = mysqli_query($con, $query4);
                           if ($run_query4) {
                              $data4 = mysqli_fetch_assoc($run_query4);
                           }

                           $query2 = "SELECT * FROM `category_list` WHERE `id` = $category_id";
                           $run_query2 = mysqli_query($con, $query2);
                           if ($run_query2) {
                              $data2 = mysqli_fetch_assoc($run_query2);
                           }


                     ?>
                           <li class="mb-30 wow fadeIn  animated" style="visibility: visible; animation-name: fadeIn;">
                              <div class="d-flex">
                                 <div class="post-thumb d-flex mr-15 border-radius-5 img-hover-scale">
                                    <a class="color-white" href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $unique_link ?>">
                                       <div class="border-radius-10" style="background-image: url('<?php echo $very_global_absolute_url; ?>admin/uploads/thumbnail-img/<?php echo $data3['thumbnail_img']; ?>'); background-repeat: no-repeat;
                                                      background-size: cover; height:80px; width:80px;">
                                       </div>

                                    </a>
                                 </div>
                                 <div class="post-content media-body">
                                    <h6 class="post-title mb-10 text-limit-2-row"><a href="<?php echo $very_global_absolute_url; ?>blog/<?php echo $unique_link ?>"><?php echo $data3['blog_title']; ?></a></h6>
                                    <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase">
                                       <span class="post-by">By <?php echo $data4['name']; ?></span>
                                       <span class="post-on"><?php echo timeAgo($data3['publish_date']); ?></span>
                                    </div>
                                 </div>
                              </div>
                           </li>
                     <?php
                        }
                     }
                     ?>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- footer-bottom aera -->
   <div class="footer-bottom-area bg-white text-muted">
      <div class="container">
         <div class="footer-border pt-20 pb-20">
            <div class="row d-flex align-items-center justify-content-between">
               <div class="col-6">
                  <div class="footer-copy-right d-flex ">
                     <p class="font-small text-muted mb-5">© 2022 Handcrafted with <i class="fas fa-heart" style="color:red;"></i> by <a href="https://anzarkhan.com/">Anzarkhan.com.</a> All rights reserved.</p>
                  </div>
               </div>
               <di v class="col-6">
                  <div class="footer-copy-left" style="float:right;">
                     <p class="font-small text-muted">Terms & Conditions</p>
                  </div>
               </di>
            </div>
         </div>
      </div>
   </div>
   <!-- Footer End-->
</footer>