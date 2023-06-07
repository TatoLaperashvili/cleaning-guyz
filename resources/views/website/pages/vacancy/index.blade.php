@extends('website.master')
@section('main')

<main>
    <section class="container">
        <div class="employment">
            <h1>{{ $vacancy->translate()->title }}</h1>
            <div>
                {!! $vacancy->translate()->desc !!}
            </div>
        </div>
    </section>
    <section class="container">
        <div class="cards-row">
          @foreach($vacancy_posts as $post)
            <div class="card">
                <div>
                    <img src="/website/assets/images/img/image 3.png" alt="">
                    <p>{{ Str::limit( $post->translate()->title , 30)}}</p>
                </div>
                <div>
                    <i class="icon-Vector-6"></i>
                    <p>{{ Str::limit(  $post->translate()->Position , 30) }}</p>
                </div>
                <div>
                    <i class="icon-Vector-7"></i>
                    <p>{{ $post->translate()->address }}</p>
                </div>
                <div>
                    <i class="icon-Vector-8"></i>
                    <p>{{ $post->Working_Time }}</p>
                </div>
                <div>
                    <i class="icon-Vector-5"></i>
                    <p>{{ $post->Working_Monthly_Rate }}</p>
                </div>
                <div>
                    
                    <p>{{Carbon\Carbon::parse($post->date)->format('M d, Y') }}</p>
                    <a href="/{{ $post->getFullSlug() }}">View</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination">
            @if(isset($vacancy_posts) && (count($vacancy_posts) > 0))

            {{ $vacancy_posts->links("website.components.pagination") }}
            @endif
          
        </div>
    </section>
    <section class="vacancy-section">
        <div class="container vacancy">
            <div class="boxes">
                <div class="vacancy-boxes-h1">
              
                    <h1>{{ __('website.START__CAREER_WITH_US') }} </h1>
                </div>
                <div class="amazing-box">
                    <div class="amazing-box_grid">
                        @foreach($starrt_career as $career)
                      <div class="amazing-box_grid-div"> <div>{{ $career->translate()->title }}</div></div> 
                      @endforeach 
                    </div>
                </div>     
        </div>

    </section>
</main>

@endsection