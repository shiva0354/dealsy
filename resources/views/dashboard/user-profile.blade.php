@extends('layouts.layout')
@section('title',$user->name)
@section('content')
    <!--==================================
=            User Profile            =
===================================-->
<section class="user-profile section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-3 offset-lg-0">
				<div class="sidebar">
					<!-- User Widget -->
					<div class="widget user">
						<!-- User Image -->
						<div class="image d-flex justify-content-center">
							<img src="{!! asset($user->avatar) !!}" alt="{{$user->name}}" class="">
						</div>
						<!-- User Name -->
						<h5 class="text-center">{{$user->name}}</h5>
					</div>
					<!-- Dashboard Links -->
					<div class="widget dashboard-links">
						<ul>
							<li><a class="my-1 d-inline-block" href="">Savings Dashboard</a></li>
							<li><a class="my-1 d-inline-block" href="">Saved Offer <span>(5)</span></a></li>
							<li><a class="my-1 d-inline-block" href="">Favourite Stores <span>(3)</span></a></li>
							<li><a class="my-1 d-inline-block" href="">Recommended</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-10 offset-md-1 col-lg-9 offset-lg-0">
				<!-- Edit Profile Welcome Text -->
				{{-- <div class="widget welcome-message">
					<h2>Edit profile</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
				</div> --}}
				<!-- Edit Personal Info -->
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="widget personal-info">
							<h3 class="widget-header user">Change Profile Picture</h3>
							<form method="POST" action="{{route('user.change.picture')}}" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<!-- File chooser -->
								<div class="form-group choose-file d-inline-flex">
									<i class="fa fa-user text-center px-3"></i>
									<input type="file" class="form-control-file mt-2 pt-1" name="avatar" accept=".jpeg,.jpg,.png">
								 </div>
								<!-- Submit button -->
								<button class="btn btn-transparent">Save My Changes</button>
							</form>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="widget personal-info">
							<h3 class="widget-header user">Edit Name</h3>
							<form method="POST" action="{{route('user.change.name')}}">
								@csrf
								@method('PUT')
								<!-- First Name -->
								<div class="form-group">
									<label for="first-name"></label>
									<input type="text" class="form-control" name="name" id="first-name">
								</div>
								<!-- Submit button -->
								<button class="btn btn-transparent">Change Name</button>
							</form>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<!-- Change Password -->
					<div class="widget change-password">
						<h3 class="widget-header user">Edit Password</h3>
						<form method="POST" action="{{route('user.change.password')}}" enctype="application/x-www-form-urlencoded">
							@csrf
							@method('PUT')
							<!-- Current Password -->
							<div class="form-group">
								<label for="current-password">Current Password</label>
								<input type="password" class="form-control" id="current-password" name="old_password">
							</div>
							<!-- New Password -->
							<div class="form-group">
								<label for="new-password">New Password</label>
								<input type="password" class="form-control" id="new-password" name="password">
							</div>
							<!-- Confirm New Password -->
							<div class="form-group">
								<label for="confirm-password">Confirm New Password</label>
								<input type="password" class="form-control" id="confirm-password" name="password_confirmation">
							</div>
							<!-- Submit Button -->
							<button class="btn btn-transparent">Change Password</button>
						</form>
					</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<!-- Change Email Address -->
					<div class="widget change-email mb-0">
						<h3 class="widget-header user">Edit Email Address</h3>
						<form method="POST" action="{{route('user.change.email')}}" enctype="application/x-www-form-urlencoded">
							@csrf
							@method('PUT')
							<!-- Current Password -->
							<div class="form-group">
								<label for="current-email">Current Email</label>
								<input type="email" class="form-control" name="email" id="current-email">
							</div>
							<!-- New email -->
							<div class="form-group">
								<label for="new-email">New email</label>
								<input type="email" class="form-control" name="new_email" id="new-email">
							</div>
							<!-- Submit Button -->
							<button type="submit" class="btn btn-transparent">Change email</button>
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@include('layouts.footer-main')
@endsection
