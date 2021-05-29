<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light navigation">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{!! asset('theme/images/classimax_logo.jpg') !!}" width="140px" height="40px" alt="">
                    </a>
                    <?php
                    $lang = '';
                    if (isset($_COOKIE['lang'])) {
                    $lang = $_COOKIE['lang'];
                    }
                    ?>
                    <form action="" method="post">
                        <select class="" style="border: 2px solid #dedede !important;" id="language-switcher">
                            <option value="en" @if ($lang == 'en') selected @endif>English</option>
                            <option value="hi" @if ($lang == 'hi') selected @endif>हिंदी</option>
                        </select>
                    </form>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        @if (Auth::check())
                            <ul class="navbar-nav ml-auto main-nav ">
                                <li class="nav-item dropdown dropdown-slide">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"
                                        href="/dashboard">Dashboard<span><i class="fa fa-angle-down"></i></span>
                                    </a>
                                    <!-- Dropdown list -->
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a>
                                        <a class="dropdown-item" href="{{ route('user.saved.ads') }}">Dashboard
                                            Favourite Ads</a>
                                        <a class="dropdown-item" href="{{ route('user.archive.ads') }}">Dashboard
                                            Archived Ads</a>
                                        <a class="dropdown-item" href="{{ route('user.pending.ads') }}">Dashboard
                                            Pending Ads</a>
                                        <a class="dropdown-item" href="{{ route('user.messages') }}">Message
                                            Requets</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"><i
                                                class="fa fa-power"></i>Logout</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white btn btn-primary"
                                        href="{{ route('add.listing') }}"><i class="fa fa-plus-circle"></i> Add
                                        Listing</a>
                                </li>
                            </ul>
                        @else
                            <ul class="navbar-nav ml-auto mt-10">
                                <li class="nav-item">
                                    <a class="nav-link login-button" href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white add-button" href="{{ route('add.listing') }}"><i
                                            class="fa fa-camera"></i> Add Listing</a>
                                </li>
                            </ul>
                        @endif
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>
