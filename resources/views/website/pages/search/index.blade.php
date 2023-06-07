@extends('website.master')
@section('main')
<main>
    <section class="container">
        <div class="search">
            <h1>Search</h1>
            <div class="search-input">
                <form action="">
                    <input type="text" id="search" name="que" value="@if(isset($searchText)) {{$searchText}} @endif">
                </form>
            </div>
            <div class="search-result">
                <div>You Searched: <span>About Us</span></div>
                <div>Founded Result: <span>{{ $posts->count() }}</span></div>
            </div>
        </div>
    </section>
    <section class="search-info">
        @foreach ($posts as $item)

        <div class="search1">

            <div class="container search-info__divs">
                <h2>{!! strip_tags($item->translate(app()->getlocale())->title) !!} </h2>
                <div>
                    {!! $item->translate(app()->getlocale())->desc !!}
                </div>
                <a href="/{{ $item->getfullslug() }}">Read More</a>
            </div>
        </div>
        @endforeach

        <section>
            <div class="container">
                <div class="pagination pagination-2">
                @if (isset($posts) && count($posts) > 0)
            {{ $posts->links('website.components.pagination') }}
        @endif
 
                </div>
            </div>
            
        </section>
    </main>
@endsection
