@extends('website.master')
@section('main')
<main>

    <section class="container">

        <div class="projects">
            <h1>{{ $projects->translate()->title }}</h1>
            <div>
              {!! $projects->translate()->desc !!}
            </div>
        </div>
    </section>
    <section class="container">
        <div class="project-img__grid">
            @if(isset($project_posts) && (count($project_posts) > 0))
            @foreach($project_posts as $project)
            
            <div class="project-img__grid-div">
                <img src="{{ image($project->thumb) }}" alt="post">
                 <span>{{ $project->translate()->title }}</span>
                <div class="project-link">
                    <a href="/{{ $project->getFullSlug() }}">Detail View</a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
      
        <div class="pagination">
            @if(isset($project_posts) && (count($project_posts) > 0))

            {{ $project_posts->links("website.components.pagination") }}
            @endif
          
        </div>
    </section>

</main>
@endsection