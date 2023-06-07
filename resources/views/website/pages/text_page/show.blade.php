@extends('website.master')
@section('main')

<main>

    <section class="container">
        <div class="whyus">
            <div class="whyus-info">

                <h1>{{ $post->translate()->title }}</h1>
                <div>
                    {!! $post->translate()->text !!}

                </div>
            </div>
            <div class="whyus-img">
                <div>
                    <img src="{{ '/' . config('config.image_path') . config('config.thumb_path') .  $post->thumb }}" alt="img">
                </div>
            </div>
        </div>
    </section>
    <section class="container">
        <div class="unicsale">
            @if(isset($post->translate()->Feature_1))
            <div>
                <h2>
                    {{$post->translate()->Feature_1}}
                </h2>
            </div>
            @endif
            @if(isset($post->translate()->Feature_2))
            <div>
                <h2>
                    {{$post->translate()->Feature_2}}
                </h2>

            </div>
            @endif
            @if(isset($post->translate()->Feature_3))
            <div>
                <h2>
                    {{$post->translate()->Feature_3}}
                </h2>
            </div>
            @endif
        </div>
        <div class="unicsale">
            @if(isset($post->translate()->Feature_4))
            <div>
                <h2>
                    {{$post->translate()->Feature_4}}
                </h2>
            </div>
            @endif
            @if(isset($post->translate()->Feature_5))
            <div>
                <h2>
                    {{$post->translate()->Feature_5}}
                </h2>
            </div>
            @endif
            @if(isset($post->translate()->Feature_6))
            <div>
                <h2>
                    {{$post->translate()->Feature_6}}
                </h2>
            </div>
            @endif
        </div>
    </section>
    <section class="container">
        <div class="sometext">
            {!! $post->translate()->Additional_Text !!}
        </div>
    </section>
    <section class="container">
        <div class="examples-h1">
            <h1>our values</h1>
        </div>

        <div class="examples">
            @php($i = 1)
            @foreach ($our_values as $our_value)

            <div class="examples-div">

                @if(isset($our_value->icon))
                <span class="plius" style="  position: absolute;
            font-size: 58px;
            color: #0b6aa1;
            opacity: 20%;
            top: 0px;
            left: 44px;
            font-weight: 900">{{ $i++ }}.</span>

                <div class="examples-img"> <img src="/{{ config('config.icon_path') . $our_value->icon }}" alt="value">
                </div>
                @else
                <div class="examples-img"> <img src="{{ image($our_value->thumb) }}" alt="value">
                </div>
                @endif
                <h3>{{ $our_value->translate()->title }}</h3>
                <p>
                    {{ $our_value->translate()->desc }}

                </p>

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

                @foreach($projects->posts as $projects_posts)
                <a href="" style="text-decoration: none">
                    <div class="testimonial-slider__div">
                        <i class="icon-Vector-2"></i>
                        <div>
                            {!! Str::limit( $projects_posts->translate()->testimonials , 200) !!}
                        </div>
                        <h4>{{ $projects_posts->translate()->testimonials_author }}</h4>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    <section>
        <div class="offering">
            <div class="offering-div">
                <div class="offering-info">
                    <h1>{{ __('website.text_page_service_title') }}</h1>
                    <div>
                        {{ __('website.text_page_service_desc') }}
                    </div>
                    <a href="/{{$service->getFullSlug()  }}">{{ __('website.All_Services') }}</a>
                </div>
            </div>
            <div class="offering-slider-main">
                <div class="offering-slider">
                    @foreach ($text_page_banner as $text_banner )
                    <div class="offering-slider_item">
                        <div>
                            <a href="{{ $text_banner->translate()->slug }}"><img src="{{ image($text_banner->thumb) }}" alt="text_banner"></a>
                            <div class="offering-slider-background"></div>
                            <div class="offering-slider-background__info">

                                <a href="{{ $text_banner->translate()->slug }}" target="_blank" style="text-decoration:none;color:aliceblue;"> {{ $text_banner->translate()->title }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="line">
        <div class="container boxes">
            <div class="boxes-h1">
                    
                <h1>{{ __('website.HOW_WE_ARE_SUCCESSFUL') }}</h1>
            </div>
            <div class="boxes-box">
                <div class="boxes-box__div">
                    @foreach($text_page as $text_title)
                    <div class="boxes-box__div-box">
                      
                        <div>{{$text_title->translate()->title  }}
                           </div>
                          
                    </div>
                    @endforeach

                </div>
            </div>
    </section>
    <section class="bookaservise">

        <div class="bookaservise-div">
            <img src="{{ image($book_service->thumb) }}" alt="">
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


                    modalBtn.addEventListener("click", () => {
                        // modalBox.style = "display: block;"; 
                        console.log('sssss')
                        modalBox.classList.add('pop-up');
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