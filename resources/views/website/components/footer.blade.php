<section>
    <footer>
       
     @if(isset($model) && ($model->type_id !== 4))

     <div class="footer-info">
        <div class="footer-info__div">
            <h1>{{ settings('footer_title') }}</h1>
            <div>
                <a href="tel:{{settings('phone')}}">{{ settings('phone') }}</a>
                <a href="{{ settings('iframe') }}">{{ settings('adress') }}</a>
                <a href="mailto:{{settings('email')}}">{{ settings('email') }}</a>
            </div>
            <div class="footer-icon">
                <a href="{{ settings('facebook') }}" target="_blank">
                    <i class="icon-Path-8"></i>
                </a>
                <a href="{{ settings('twitter') }}" target="_blank">
                    <i class="icon-Path-7"></i>
                </a>
                <a href="{{ settings('instagram') }}" target="_blank">
                    <i class="icon-Path-170"></i>
                </a>
            </div>
        </div>
        <div class="footer-map-img">
            <img src="" alt="">
        </div>
        <div class="footer-map">
            <div class="map">
                <div class="footer-map__frame">
                    <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1oD69hvp6ANXE3BDwQ-pBB3sNPQoSHm0&ehbc=2E312F" width="640" height="480"></iframe>
                </div>
            </div>
        </div>
    </div>
     @endif
       

        <div class="footer-line"></div>
        <div class="container footer-last">
            <div>
              {{__('admin.COPYRIGHT')}}
            </div>
            <div>
               {{__('admin.Developed_by')}} <a href="https://ideadesigngroup.ge/en" target="_blank"> {{ __('admin.idg') }} </a>
            </div>
        </div>
    </footer>
</section>