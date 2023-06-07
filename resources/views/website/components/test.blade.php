@extends('website.master')
@section('main')

<main>
    <section>
        <div class="home-slider-section flex items-center w-full relative">
            <div class="relative w-full">
                <div class="slide w-full h-full hidden">
    
                    <div class="slide-img w-full relative">
                        <img src="/website/img/home-slider-cover.png" alt="" class="w-full h-full relative cover top-0 left-0 z-10">
                        <img src="{{ image($model->cover) }}" alt="" class="w-full h-full cover absolute top-0 left-0 z-1">
                    </div>

                    <div class="slide-info flex column items-start">
                        <div class="title">
                            @if (isset($model->translate(app()->getlocale())->title))
                                <h2 class="nune-light weight-700 font text-3xl">{{ $model->translate(app()->getlocale())->title }}</h2>
                            @endif
                        </div>

                        @if (isset($model->translate(app()->getlocale())->desc))
                            <div class="text nune-light weight-300">
                                {!! $model->translate(app()->getlocale())->desc !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    
            <div class="slider-buttons flex column absolute z-10 items-end justify-between">
                <div class="border-block w-full h-full relative"></div>
            </div>
        </div>
    </section>
    
    @if(isset($breadcrumbs))
        <section>
            <div class="breadcrumbs">
                <div class="container">
                    <div class="flex items-center justify-start">
                        <a href="/{{app()->getlocale()}}" class="transition-duration nune-light text-base relative weight-300">{{ trans('website.home') }}</a>

                        @foreach ($breadcrumbs as $breadcrumb)
                            <div class="line"></div>
                            <a href="/{{ $breadcrumb['url'] }}" class="transition-duration nune-light text-base relative weight-300">{{ $breadcrumb['name'] }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    
    <div class="map-page">
        <div class="container">
            <div class="title nune-light weight-700 white text-3xl mb-1">
                {{$map->translate(app()->getLocale())->title}}
            </div>

            <div class="text nune-light weight-300 white mb-4">
                {!! $map->translate(app()->getLocale())->desc !!}
            </div>
        </div>

        <div class="multi-map" style="filter: grayscale(100%) invert(90%);">
            <div id="map" class="multi-map w-full h-full"></div>
        </div>
    </div>
        <style>
                .gm-style-iw.gm-style-iw-c,
                .gm-style .gm-style-iw-tc::after {
                    filter: invert(1);
                }
        </style>
</main>
@endsection

@push('scripts')
<script type="text/javascript">
    function initMap() {
        const myLatLng = { lat: 42.030349, lng: 43.835142};
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 8,
            center: myLatLng,
        });

        // var locations = <?php echo json_encode($lnglat); ?>;
        var locations = [
        @foreach($map->posts as $article)
        ["{{$article[app()->getlocale()]['title']}} </br> {!!$article[app()->getlocale()]['text']!!}", {{$article->latitude}}, {{$article->longitude}}], //YOU NEED A COMMA TO SEPARATE EACH ELEMENT
        @endforeach
        ];
        var infowindow = new google.maps.InfoWindow();

        var marker, i;
          
        for (i = 0; i < locations.length; i++) {  
              marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
              });
                
              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent(locations[i][0]);
                  infowindow.open(map, marker);
                }
              })(marker, i));

        }
    }

    window.initMap = initMap;
</script>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?v=3.exp&signed_in=true&key={{settings('google_map_key')}}&callback=initMap"></script>
@endpush