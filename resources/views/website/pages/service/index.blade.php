@extends('website.master')
@section('main')
<main>
    <section class="container">
        <div class="our-services">
            <h1>{{ $model->translate()->title }}</h1>
            <div>
                {!! $model->translate()->desc !!} 
            </div>
        </div>
    </section>

    <section class="container">
        <div class="our-services_grid">
            @if(isset($service_post) && count($service_post) > 0)
            @foreach($service_post as $posts)
            <a href="/{{ $posts->getFullSlug() }}">
            <div>
                <span style="color: black">{{$posts->translate()->title}}</span>
            </div>
        </a>
            @endforeach
            @endif
        </div>
    </section>
    <section class="speciality">
        <div class="speciality1">
         <div>
            <img src="/website/assets/images/img/mkjr_-2zUjvV0M9dQ-unsplash 1.png" alt="">
         </div>
        </div>
        <div class="speciality2">
         <div>
            <h1>
                speviality cleanings
            </h1>
         </div>
         <div class="speciality-grid">
            
            @foreach($special_service as $specialService)
           
            <div>             
                <i class="icon-task-line"></i>
                <a href="/{{ $specialService->getFullSlug() }}">{{$specialService->translate()->title}}</a>       
            </div>
            @endforeach
          
         </div>
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
             
               @foreach($projects->posts as $projects_posts)
             <a href="" style="text-decoration: none">
                <div class="testimonial-slider__div">
                    <i class="icon-Vector-2"></i>
                    <div>
                        {!! strip_tags(Str::limit( $projects_posts->translate()->testimonials , 200))!!}
                    </div>
                    <h4>{{ $projects_posts->translate()->testimonials_author }}</h4>
                </div>
            </a>
            @endforeach
            </div>
        </div>
    </section>
    <section class="container services-img">
        <div class="project-img__grid">
            @foreach($service_banner as $serviceBanner)
            <div class="project-img__grid-div">
                <img src="{{ image($serviceBanner->thumb) }}" alt="service">
                <span>{{ $serviceBanner->translate()->title }}</span>
                <div class="project-link">
                    <a href="{{ $serviceBanner->translate()->slug }}" target="_blank">Detail View</a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <section class="bookaservise">

        <div class="bookaservise-div">
            <img src="{{ image($book_service->thumb) }}" alt="book">
            <div>

                <h1> {{ $book_service->translate()->title }}</h1>
                {{$book_service->translate()->desc}}

            </div>
        </div>
        <div class="bookaservise-form">
            <form method="POST" action="/{{app()->getLocale()}}/servicesubmission" id="my_captcha_form">
                @csrf
                <input type="hidden" name="section_type_id" id="" value="{{ $service->type_id }}">
                <div class="validation__input-box">
                    @if($errors->has('name'))
                    <small style="color: red">{{ trans('admin.name') }} {{ trans('admin.is_required') }}</small>
                    @endif
                    <input type="text" value="{{ old('name') }}" name="name" placeholder="{{trans('admin.name')}}" required>
                    
                    <label for="service-name">{{trans('admin.name')}}</label>
                </div>
             
                <input type="phone" name="phone" placeholder="{{trans('admin.phone')}}">
               
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
                <script>
                    const modalBox = document.querySelector(".modal-container");
                    const modalBtn = document.querySelector(".modal-btn");
                    const body = document.querySelector(".body");


                    modalBtn.addEventListener("click", () => {
                        // modalBox.style = "display: block;"; 
                        console.log('sssss')
                        modalBox.classList.add('pop-up');
                        body.classList.add('homeblaidform-background')
                    });
                    window.addEventListener("click", (e) => {
                        if (e.target == modalBox) {

                            modalBox.style = "display: none;";
                            location.reload(true)
                        }


                    });
                </script>

            </form>
        </div>
    </section>  
</main>
@endsection
