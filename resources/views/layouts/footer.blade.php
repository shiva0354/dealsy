 <?php $date = now()->format('Y'); ?>
 </footer>
 <!-- Footer Bottom -->
 <footer class="footer-bottom">
     <!-- Container Start -->
     <div class="container">
         <div class="row">
             <div class="col-sm-6 col-12">
                 <!-- Copyright -->
                 <div class="copyright">
                     <p>Copyright © {{ $date }}. All Rights Reserved <a class="text-primary"
                             href="{{ route('home') }}" target="_blank"> Dealsy</a></p>
                 </div>
             </div>
             <div class="col-sm-6 col-12">
                 <!-- Social Icons -->
                 <ul class="social-media-icons text-right">
                     <li><a class="fab fa-facebook" href="#" target="_blank"></a></li>
                     <li><a class="fab fa-twitter" href="#" target="_blank"></a></li>
                     <li><a class="fab fa-pinterest-p" href="#" target="_blank"></a></li>
                     <li><a class="fab fa-youtube" href="#"></a></li>
                 </ul>
             </div>
         </div>
     </div>
     <!-- Container End -->
     <!-- To Top -->
     <div class="top-to">
         <a id="top" class="" href="#"><i class="fa fa-angle-up"></i></a>
     </div>
 </footer>
