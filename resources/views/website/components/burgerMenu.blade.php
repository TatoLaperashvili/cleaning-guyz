
<div class="burger-icon">
        <div>
            <span class="span1"></span>
            <span class="span2"></span>
            <span class="span3"></span>
        </div>
    </div>
    <section class="burger">
        <div class="burger-img"> 
           <a href="/{{ app()->getLocale() }}"> <img src="website/assets/images/img/respon-ligo.png" alt="cleaning guyz"></a>
        </div>
        <div class="burg-search">
          <form action="/{{ app()->getLocale() }}/search" method="GET" role="search">
                  <button style="background: transparent;
                border: none;
                cursor: pointer;"> <i class="icon-Vector-search"></i></button>
                <input type="text" placeholder="{{ trans('website.search') }}..." name="que" value="@if(isset($que)) {{$que}} @endif">
            </form>
        </div>
        <div class="burger-main">
          @foreach($sections as $section)
        @if($section->type['type'] !== 4)
            <div>
               <a href="/{{ $section->getFullSlug() }}">{{ $section[app()->getlocale()]->title }}</a>
            </div>
           
            @endif
             @endforeach
        </div>
        <div class="burger-share">
            <div>
                <a href="">
                    <i class="icon-Path-8"></i>
                </a>
            </div>
            <div>
                <a href="">
                    <i class="icon-Path-7"></i>
                </a>
            </div>
            <div>
                <a href="">
                    <i class="icon-Path-170"></i>
                </a>
            </div>
        </div>
        <div class="burger-contact">
              <a href="/{{app()->getLocale() }}/contact">{{ trans('website.contact') }}</a>
        </div>
    </section>