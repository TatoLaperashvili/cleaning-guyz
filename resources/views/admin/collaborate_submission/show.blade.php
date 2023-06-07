@extends('admin.layouts.app')

@push('name')
    {{ trans('admin.submissions') }}
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
                <h5 style="font-weight: 400; line-height:20px"><b style="margin-right: 15px">{{trans('admin.name')}} :</b>
                    {{ $submission->name}}</h5>
                    <h5 style="font-weight: 400; line-height:20px"><b style="margin-right: 15px">{{trans('admin.email')}} :</b>
                        {{ $submission->email}}</h5>
            @foreach ($submission->additional as $key => $additional)
            @if($key == 'answers')
            @foreach($additional as $key1 => $answers)
            @if($key1 == 'title')
                <div class="chackbox">
                    
                    <div class="row chackbox-row">
                       
                        @foreach($answers as $checkbox_title => $checkbox_name)
                        <div class="col-sm-2">
                          
                            <h5 style="font-weight: 500; line-height:20px; margin-top:30px;">
                                <b style="margin-right: 15px">{{ $checkbox_title }}:</b>
                                    @foreach($checkbox_name as $options_title => $options)
                                                <p >{{ $options_title }} : {{  $options }}</p>
                                    @endforeach
                
                            </h5>
                            
                        </div>
                        @endforeach
                    </div>   
                </div>
            @elseif($key1 == 'file')
             @if($answers > 0)
            @foreach($answers as $file_title => $file_name)
            <h5 style="font-weight: 500; line-height:20px; margin-top:30px;"><b style="margin-right: 15px">{{ $file_title }}:</b>
                    @foreach($file_name as $name)
                    <a href="/{{ config('config.file_path') . $name}}" target="_blank" style="color: black"> <span class="submission_files_name">  {{ $name }} </span></a>
                    @endforeach

            </h5>
           
            @endforeach
            @endif

            @else
            <h5 style="font-weight: 500; line-height:20px"><b style="margin-right: 15px">{{ $key1 }}:</b>
                {{ $answers }}
               
            </h5>
                     @endif
                   
                @endforeach
                @endif
            @endforeach

            {{-- {{dd($submission->additional)}} --}}
            {{-- <a class="btn btn-warning" href="/{{ app()->getLocale() }}/admin/submission/exportcollaborate/{{$submission->id }}">Export Submission Data</a> --}}
        </div>
    </div>
</div>
@endsection
<style>
    .chackbox-row{
        align-items: center;
    }
</style>