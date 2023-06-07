<!-- <div class="body"></div> -->
<section class="container">

<header>
    <div class="header-img">
        <a href="/{{ app()->getLocale() }}">
            <img src="/website/assets/images/img/image 2.png" alt="">
        </a>
    </div>
    
    <div class="header-menu">
        
        @foreach($sections as $section)
        
        
        <div  @if (isset($model[app()->getlocale()]->slug) && ($model[app()->getlocale()]->slug  == $section[app()->getlocale()]->slug)) class="active-page" @endif>
            <a href="/{{ $section->getFullSlug() }}">{{ $section[app()->getlocale()]->title }}</a>
        </div>
       
       
        @endforeach
      
    </div>
   
    <div class="header-search">
        <form action="/{{ app()->getLocale() }}/search" method="GET" role="search">
            <div>

                <button style="background: transparent;
                border: none;
                cursor: pointer;"> <i class="icon-Vector-search"></i></button>
                <input type="text" placeholder="{{ trans('website.search') }}" name="que" value="@if(isset($que)) {{$que}} @endif">
            </div>
        </form>
       
    </div>
    <div class="header-contact">
        <button class="contact-btn">{{ trans('website.Book_A_Meeting') }}</button>
      
    </div>
</header>
</section>