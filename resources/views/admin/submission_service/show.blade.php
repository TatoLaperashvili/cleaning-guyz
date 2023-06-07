@extends('admin.layouts.app')

@push('name')
{{ trans('admin.submission') }}
@endpush



@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box">

            <div style="display: flex; align-items:center; justify-content: space-between; padding:20px 0">
                @if ($submission->post->translate(app()->getLocale()) !== null)
                <h4 class=" ">{{ $submission->post->translate(app()->getLocale())->title }} </h4>

                @elseif ($submission->post->parent->translate(app()->getLocale())->title)
                <h4>{{ $submission->post->parent->title }} </h4>
                @endif

            </div>


            <h4 style="font-weight: 600; line-height:20px; font-size:16px">{{ trans('admin.submission_datetime') }} :
                {{ $submission->created_at->format('H:i - d.m.Y') }}</h4>
            <h5 style="font-weight: 500; line-height:20px"><b style="margin-right: 15px"></h5>
            @if(isset($submissions->text))
            <h5 style="font-weight: 400; line-height:20px"><b style="margin-right: 15px">{{trans('admin.text')}} :</b>
                @endif
                {{ $submission->text}}</h5>

            @foreach ($submission->additional as $key => $additional)
            <h5 style="font-weight: 500; line-height:20px"><b style="margin-right: 15px">{{ $key }}:</b>
                {{ $additional }}
            </h5>
            @endforeach
            @if(isset($submission->post))
            
            <h5 style="font-weight: 500; line-height:20px"><b style="margin-right: 15px">{{ __('admin.select_service') }}:</b>
                
                    {{ $submission->post->translate()->title }}
               
            </h5>
            @endif
            {{-- {{dd($submission->additional)}} --}}

        </div>
    </div>
</div>
@endsection
<style>
    .chackbox-row{
        align-items: center;
    }
</style>