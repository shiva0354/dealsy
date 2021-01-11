<footer class="footer section section-sm">
    <!-- Container Start -->
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-7 offset-md-1 offset-lg-0">
          <!-- About -->
          <div class="block about">
            <!-- footer logo -->
            <img src="{{ asset('theme/images/classimax_logo.jpg') }}" alt="">
            <!-- description -->
            <p class="alt-color">Join the millions who buy and sell from each other
              everyday in local communities around the world</p>
          </div>
        </div>
        <!-- Link list -->
        <div class="col-lg-2 offset-lg-1 col-md-3">
          <div class="block">
            <h4>Site Pages</h4>
            <ul>
              <li><a href="{{route('home')}}">Home</a></li>
              <li><a href="{{route('about-us')}}">About</a></li>
              <li><a href="#">Articls & Tips</a></li>
            </ul>
          </div>
        </div>
        <!-- Link list -->
        <div class="col-lg-2 col-md-3 offset-md-1 offset-lg-0">
          <div class="block">
            <h4>Important Links</h4>
            <ul>
              <li><a href="{{route('contact-us')}}">Contact Us</a></li>
              <li><a href="{{route('privacy')}}">Privacy Policy</a></li>
              <li><a href="{{route('terms')}}">Terms & Conditions</a></li>
            </ul>
          </div>
          <div class="block">
            <h4 class="mb-0">Email Us</h4>
              <li type="none">support@mydealsy.com</li>
          </div>
        </div>
        <!-- Promotion -->
        <div class="col-lg-4 col-md-7">
          <!-- App promotion -->
          <div class="block-2 app-promotion">
            <div class="mobile d-flex">
              <a href="">
                <!-- Icon -->
                <img src="{{ asset('theme/images/footer/phone-icon.png')}}" alt="mobile-icon">
              </a>
              <p>Get the Dealsy Mobile App and Save more</p>
            </div>
            <div class="download-btn d-flex my-3">
              <a href="#"><img src="{{ asset('theme/images/apps/google-play-store.png')}}" class="img-fluid" alt=""></a>
              <a href="#" class=" ml-3"><img src="{!! asset('theme/images/apps/apple-app-store.png')!!}" class="img-fluid" alt=""></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Container End -->
