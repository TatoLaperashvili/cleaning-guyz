@extends('admin.layouts.app')

@push('name')
{{ trans('admin.booknow') }}
@endpush



@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div style="display: flex; align-items:center; justify-content: space-between; padding:20px 0">
                @if ($booknow->post->translate(app()->getLocale()) !== null)
                <h4 class=" ">{{ $booknow->post->translate(app()->getLocale())->title }} </h4>

                @elseif ($booknow->post->parent->translate(app()->getLocale())->title)
                <h4>{{ $booknow->post->parent->title }} </h4>
                @endif
                {{-- {{dd($booknow->post)}} --}}

            </div>

            <h4 style="font-weight: 600; line-height:20px; font-size:16px">{{ trans('admin.send_date') }} :
                {{ $booknow->created_at->format('H:i - d.m.Y') }}</h4>
            <h5 style="font-weight: 500; line-height:20px"><b style="margin-right: 15px"></h5>
            <h5 style="font-weight: 400; line-height:20px"><b style="margin-right: 15px">{{trans('admin.text')}} :</b>
                    {{ $booknow->text}}</h5>
            @foreach ($booknow->additional as $key => $additional)


            <h5 style="font-weight: 500; line-height:20px"><b style="margin-right: 15px">{{ trans('admin.'.$key) }}:</b>
                {{  $additional }}</h5>
            @endforeach

            {{-- {{dd($booknow->additional)}} --}}

        </div>
    </div>
</div>
@endsection