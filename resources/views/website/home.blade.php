@extends('website.master')

@section('main')

<main>

    @if(isset($mainBanners))
    <section class="container">
        <div class="main-banner">
            <div class="main-banner__info">
                <div class="main-banner__info-info">
                    <h1>{{$mainBanners->translate()->title}} </h1>
                    <div class="main_banner22">
                        {!! str_limit($mainBanners->translate()->desc , 160) !!}
                    </div>
                    <button class="contact-btn">
                        {{ __('website.Book_A_Meeting') }}</button>


                </div>
                <div class="main-banner__info-link">
                    @if(isset($mainBanners->icon))
                    <div>
                        <a href="{{ $mainBanners->translate()->slug }}" target="_blank">
                            <img src="/{{ config('config.icon_path') . $mainBanners->icon }}" alt="ss">
                            <p> {{$mainBanners->translate()->logo_link}}</p>

                        </a>
                    </div>
                    @endif
                    <div>

                        {{ $mainBanners->translate()->logo_desc }}

                    </div>
                </div>

            </div>
            <div class="main-banner__img">
                <div>

                    <img src="{{ image($mainBanners->thumb) }}" alt="main_banner">

                </div>
            </div>
        </div>
    </section>
    @endif
    <section class="partner">
        <div class="partner-trusted">
            <div>trusted by</div>
        </div>
        <div class="container partner_slider">

            @foreach($partners_banner as $post)

            <div class="partner_slider-item">
                <a href="{{ $post->translate()->slug  }}" target="_blank">
                    <img src="/{{ config('config.icon_path') . $post->icon }}" alt="ss">
                </a>
            </div>
            @endforeach

        </div>
    </section>
    <section class="container">
        <div class="testimonial">
            <div class="testimonial-info">
                <h4>{{ __('website.testimonial_Block_Name') }}</h4>
                <h1>{{ __('website.Testimonial_Block_Title') }}</h1>
                <div>
                    {{ __('website.Testimonial_Block_Description') }}
                </div>
            </div>

            <div class="testimonial-slider">
                @foreach($projects->posts as $projectpost)
                <a href="/{{ $projectpost->getFullSlug() }}" style="text-decoration: none">
                    <div class="testimonial-slider__div">
                        <i class="icon-Vector-2"></i>

                        <div>
                            {!! strip_tags(Str::limit( $projectpost->translate()->testimonials , 200)) !!}
                        </div>

                        <h4>{{ $projectpost->translate()->testimonials_author }}</h4>
                    </div>
                </a>
                @endforeach
            </div>
         
    </section>
    <section class="container">
        @if(isset($about_post))
        <div class="about-company">

            <h1>{{ $about_post->translate()->title }}</h1>
            <div>
                {!! $about_post->translate()->desc !!}
            
            </div>
        </div>
        @endif

    </section>
    <section class="container" >
        <div class="number-div">
            @foreach ($staticBanner as $stBanner)

            <div class="number-div__div">
                <div class="counter-main">
                    <div class="counter" data-count={{ $stBanner->translate()->numbers }}>
                        {{-- {{ $stBanner->translate()->numbers }} --}}
                        0
                    </div>
                    <span>+</span>
                </div>
                <div>
                    {{$stBanner->translate()->title}}
                </div>
            </div>
            @endforeach

        </div>
        <div class="number-div__link">
            <a href="/{{ $about_company->getFullSlug() }}">{{ __('website.Read_More') }}</a>
        </div>
    </section>

    <section class="bookaservise">

        <div class="bookaservise-div">
            <img src="{{ image($book_service->thumb) }}" alt="book">
            <div class="bookaservise-h1">

                <h1> {{ $book_service->translate()->title }}</h1>
                {{$book_service->translate()->desc}}

            </div>
        </div>

        <div class="bookaservise-form">
            <form method="POST" action="/{{app()->getLocale()}}/servicesubmission" id="my_captcha_form" novalidate>
                @csrf

                <input type="hidden" name="section_type_id" id="" value="{{ $service->type_id }}">

                <div class="validation__input-box">
                    @if($errors->has('name'))
                    <small style="color: red">{{ trans('admin.name') }} {{ trans('admin.is_required') }}</small>
                    @endif
                    <input type="text" value="{{ old('name') }}" name="name" placeholder="{{trans('admin.name')}}"
                        required>

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


                <div class="g-recaptcha" data-size="invisible" data-callback="onSubmit"
                    data-sitekey="6Lc1p0UjAAAAAEurBKZdmqaJVmj-KF1urJnIFEI2"></div>
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
    </section>


</main>

@endsection
