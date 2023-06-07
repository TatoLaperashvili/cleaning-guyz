@extends('website.master')
@section('main')

    <main>

        <section class="container">
            <div class="project-detail">
                <div>
                    <h1>{{ $model->translate()->title }}</h1>
                </div>
                <div class="project-detail_main">
                    <div class="project-detail_img">
                        <div>
                            <img src="{{ image($model->thumb) }}" alt="project">
                        </div>
                    </div>
                    <div class="project-detail_info">
                        <div class="project-detail_info1">
                          
                            {!!  $model->translate()->desc  !!}
    
                        </div>
                        <div class="project-detail_info2">
                            <div class="testimonial-slider__div">
                                <i class="icon-Vector-2"></i>
                                <div>
                                    {!! Str::limit($model->translate()->testimonials,225) !!}
                                </div>
                                <h4>{{ $model->translate()->testimonials_author }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="project-detail_tags">
                <div class="pro3">
                    <i class="icon-Vector-31"></i>
                    {{ __('website.Services_We_Use') }}
                </div>
               
                <div class="project-detail_services">
                    @if(($model->translate()->keywords != '') && is_array(explode(",", $model->translate()->keywords)))
                    @foreach(explode(",", $model->translate()->keywords) as $keywords)
                    <div> <a>{{ $keywords }}</a></div>
                    @endforeach
                    @endif
        
                </div>
            </div>
        </section>
       <section class="container more-projects">
        <div><h1>more Projects</h1></div>
        <div class="more-priject_row">
            @foreach($project_slider as $slider_project)
            <div class="project-img__grid-div">
                <img src="{{ image($slider_project->thumb) }}" alt="slider">

                <div class="moreProject__grid">
                    <p>{{ $slider_project->translate()->title }}</p>
                    @if(($slider_project->translate()->keywords != '') && is_array(explode(",", $slider_project->translate()->keywords)))
                    @foreach(explode(",", $slider_project->translate()->keywords) as $keywords)
                    <p>{{ $keywords }}</p>
                    @endforeach
                    @endif
                </div>
                <div class="project-link">
                    <a href="/{{ $slider_project->getFullSlug() }}">Detail View</a>
                </div>
            </div>
        
            @endforeach

        </div>
        <div class="pagination">
            @if(isset($project_slider) && (count($project_slider) > 0))

            {{ $project_slider->links("website.components.pagination") }}
            @endif
          
        </div>
       </section>
    
    </main>
   
@endsection
