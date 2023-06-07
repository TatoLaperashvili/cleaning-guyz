<!DOCTYPE html>
<html lang="{{ app()->getlocale() }}">


<head>
	@include('website.components.head')
</head>

<body>
	<div class="contact-container">

		<div class="bookaservise-form contact-content">
			<form method="POST" action="/{{app()->getLocale()}}/servicesubmission" id="my_captcha_form">
				@csrf
				<img class="contact-form-img" src="/website/assets/images/img/close.png" alt="">
				<input type="hidden" name="section_type_id" id="" value="{{ $service->type_id }}">
				<div class="validation__input-box">
					@if($errors->has('name'))
					<small style="color: red">{{ trans('admin.name') }} {{ trans('admin.is_required') }}</small>
					@endif
					<input type="text" value="{{ old('name') }}" name="name" placeholder="{{trans('admin.name')}}" required>
					
					<label for="service-name">{{trans('admin.name')}}</label>
				</div>

				<div class="validation__input-box">
					@if($errors->has('phone'))
					<small style="color: red">{{ trans('admin.phone') }} {{ trans('admin.is_required') }}</small>
					@endif
					<input type="phone" name="phone" placeholder="{{trans('admin.phone')}}" required>
					
					<label for="service-name">{{trans('admin.phone')}}</label>
				</div>
			 
			   
				<div class="validation__input-box">
					@if($errors->has('email'))
					<small style="color: red">{{ trans('admin.email') }} {{ trans('admin.is_required') }}</small>
					@endif
					<input type="email" name="email" placeholder="{{trans('admin.email')}}" required>
					<label for="service-email">{{trans('admin.email')}} </label>
				</div>
				<div class="validation__input-box">
					@if($errors->has('post_id'))
					<small style="color: red">{{ trans('admin.is_required_select') }}</small>
					@endif
				<select name="post_id" id="footer-select" required>
				  
					<option value="">Select Service</option>
					
					@foreach($service_posts as $key => $selectPosts)
		
					<option value="{{ $selectPosts->id }}">{{ $selectPosts->translate()->title }}
					</option>
					@endforeach
					
				</select>
				</div>

			<div class="g-recaptcha" data-size="invisible" data-callback="onSubmit" data-sitekey="6Lc1p0UjAAAAAEurBKZdmqaJVmj-KF1urJnIFEI2"></div>
			<button id="submit" onclick="onClick()"> {{trans('website.SUBMIT')}}</button>

			<script>
				function onSubmit(token) {

					document.getElementById("my_captcha_form").submit();

				}

				function onClick() {
					grecaptcha.execute();
				}
			</script>
		  

		</form>
		</div>


  </div>
	@if(Session::has('service_message'))
    <div class="service-alert-background">
        <div class="service-alert">
            <div class="alert-service alert-info">Your submision sent <span>Succesfully</span></div>
            <div class="service-alert-x">
                <span class="span-x5"></span>
                <span class="span-x6"></span>
            </div>

        </div>
    </div>
    @endif
{{-- <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v14.0" nonce="ABgBjhuZ"></script>
	 --}}
	 @include('website.components.burgerMenu')
		@include('website.components.header')
	
	@yield('main')
  
	{{-- @include('website.components.FooterBanner') --}}
	
	@include('website.components.footer')

	@include('website.components.scripts')
	@yield('scripts')
	<!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>
