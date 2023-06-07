@extends('website.master')
@section('main')
<section class="container">
    <div class="services-detail">
        <h1>{{ $model->translate()->title }}</h1>
       
        <div>
            {!! $model->translate()->desc !!}
        </div>
    </div>
</section>
<section class="container">
    <div class="examples">
        @php($i = 1)
        @foreach($our_values as $values)
       
        <div class="examples-div">
          
            <span class="plius" style="  position: absolute;
            font-size: 58px;
            color: #0b6aa1;
            opacity: 20%;
            top: 0px;
            left: 44px;
            font-weight: 900">{{ $i++ }}.</span>
            <div class="examples-img"> <img src="/{{ config('config.icon_path') . $values->icon }}" alt="ss"></div>
            <h3>{{ $values->translate()->title }}</h3>
        </div>
        @endforeach
    </div>
</section>
<section class="container">
<div class="services-tags">
    <h3>{{ __('website.Tags') }}</h3>
    <div class="project-detail_services">
        @if(($model->translate()->tags != '') && is_array(explode(",", $model->translate()->tags)))
        @foreach(explode(",", $model->translate()->tags) as $keywords)
        <div>  {{ $keywords }}</div>
        @endforeach
        @endif
      
    </div>
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
        </div> <div class="bookaservise-form">
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

                        <option  value="{{ $model->id }}">{{ $model->translate()->title }}</option>

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

@endsection