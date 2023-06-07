@extends('website.master')
@section('main')
</section>
<section>
    <div class="collaboration-section">
        <div class="collaboration-div1">
            <img src="{{ image($collaborate_posts->thumb) }}" alt="collaborate">
            <div>
                <h1> {{ $collaborate_posts->translate()->title }}
                </h1>
                <p>{!! $collaborate_posts->translate()->desc  !!}</p>
            </div>
        </div>
     
        <div class="collaboration-div2">
            <h1>Let`s Collaborate</h1>
            <form action="/{{app()->getlocale()}}/collaboratesubmission/{{$collaborate_posts->id}}" method="POST" enctype="multipart/form-data" id="my_captcha_form"> 
                @csrf      
               
                   <div class="form-container">
                    <div class="collaboration-grid1 ">
                     <div class="validation__input-box">
                        <input type="text" name="name" id="" placeholder="{{ $collaborate_form->name }}" required  class="valid">
                        <label for="" class="collaborate-label">{{ $collaborate_form->name }}</label>
                     </div>
                     <div class="validation__input-box">
                    <input type="email" name="email" id="email" placeholder="{{ $collaborate_form->email }}" required class="valid">
                    <label for="" class="collaborate-label">{{ $collaborate_form->email }}</label>
                    
                     </div>
                    <span id="text"></span>
                    </div>
                    
            <input type="hidden" name="post_id" value="{{ $collaborate_posts->id }}">
            <input type="hidden" name="section_type_id" value="{{$collaborate->type_id}}">
            @php($i = 0)
            @php($j = 0)
            @if(isset($collaborate_form))
           
                        @foreach($collaborate_form->fields as $field)
                            @if($field->type == 1)
                                <div class="form__field form__field--input @if($field->validation['small_screen'] == 1) form__field--small @endif ">
                                    <input type="text" name="answers[{{ $field->title }}]" id="text" placeholder="">
                                    @if ($field->validation['required'] == 1)
                            <label class="required-collaborate" for="text">{{ $field->title }}</label>
                        @endif
                                </div>
                            @endif
                            @if($field->type == 11)
                            <div class="form__field form__field--input field-number @if($field->validation['small_screen'] == 1) form__field--small @endif ">
         
                                <input type="number" name="answers[{{ $field->title }}]" id="number" placeholder="" onkeypress="return isNumberKey(event)" required>
                                @if ($field->validation['required'] == 1)
                                <label class="required-collaborate" for="number">{{ $field->title }}</label>
                            @endif
                            </div>
                        @endif
                        @if($field->type == 3)
         
                        <div class="form__field form__field--input @if($field->validation['small_screen'] == 1) form__field--small @endif ">
                            <textarea id="w3review" name="answers[{{ $field->title }}]" rows="4" cols="50">
                              
                            </textarea>
                            @if ($field->validation['required'] == 1)
                            <label class="required-collaborate" for="w3review">{{ $field->title }}</label>
                        @endif
                        </div>
                          @endif
                            @if($field->type == 8)
                            
                            <div class="form__field form__field--select @if($field->validation['small_screen'] == 1) form__field--small @endif ">
                                <select name="answers[{{ $field->title }}]" id="" @if($field->validation['required'] == 1) required @endif>
                                    <option value="">{{ $field->title }}</option>
                                    @if(isset($field->data['options']))
                                    @foreach($field->data['options'] as $options)
                    
                                    <option value="{{ $options }}">{{  $options  }}</option>
                                    @endforeach
                                    @endif

                                </select>
                            </div>
                            @endif

                            @if($field->type == 6)
                           
                                <div class="form__field form__field--file colaboration-files @if($field->validation['small_screen'] == 1) form__field--small @endif">
                                    <i class="icon-Vector-11"></i>
                                    
                                    <label for="file{{ $i }}" class="labelinputfile">{{ $field->title }}</label>
          
                                    <input type="file" name="answers[file][{{ $field->title  }}][]"  id="file{{ $i }}" class="inputfile" @if($field->validation['required'] == 1) required @endif multiple>
                                 
                            
                                    @php($i ++)
                                </div>
                            @endif

                            @if($field->type == 10)
                                <div class="form__field form__field--checkbox  @if(count($field->data['options']) <=4 ) form__field--horizontal @else form__field--vertical @endif">
         
                                    <div class="form__field-title checkbox-title_0">
                                        
                                        <h3>{{ $field->title }}</h3>
                                    </div>
                                    <div class="form__field-content">
                                      @if(isset($field->data['options']))
                                        @foreach($field->data['options'] as $options)
                                        <div  class="form__checkbox">
                                            <div>
                                                <input type="checkbox" id="checkbox{{ $j }}" name="answers[title][{{ $field->title }}][{{ $options }}]" 
                                               >
                                            </div>
                                           <div>
                                            <label for="checkbox{{ $j }}" >{{ $options }}</label>
                                           </div>
                                           
                                        </div>
                                        @php($j ++)
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @endif
                    </div>
                   
                    <div class="g-recaptcha" data-size="invisible" data-callback="onSubmit" data-sitekey="6Lc1p0UjAAAAAEurBKZdmqaJVmj-KF1urJnIFEI2"></div>
                <div class="collaboration-row">
                    <button  onclick="onClick()">Contact</button>
                </div>
                @if(Session::has('coll_message'))
                <div class="service-alert-background">
                    <div class="service-alert">
                        <div class="alert-service alert-info">Your submision sent <span>Succesfully</span></div>
                        <div class="service-alert-x">
                            <span class="span-x5"></span>
                            <span class="span-x6"></span>
                        </div>
                        
                    </div>
                </div>
                    @endif
                  
                    <script>
                        jQuery(function () {
                            $("#field_{{ $field->id }}").keyup(function () {
                                $(this).removeClass('warning');
                                var val = this.value;
                                let msg = '';
                                @if ($field->validation['required'] == 1)
                                    if (val == '') {
                                        $(this).addClass('warning');
                                        msg = 'this field required';
                                    }
                                @endif
                                $(this).siblings('small').text(msg)
                            });
                        });
                    </script>
                   
                <script>
                    function onSubmit(token) {
                        
                      document.getElementById("my_captcha_form").submit();
                     
                    }
                    function onClick(){
                     grecaptcha.execute();
                    }
                  </script>
            </form>
            <div class=""></div>
        </div>
    </div>
</section>
<section class="partner">
        <div class="partner-trusted">
            <div>trusted by</div>
        </div>
        <div class="container partner_slider">

            @foreach($partners_banner as $post)

            <div class="partner_slider-item">
                <a href="{{ $post->translate()->slug  }}" target="_blank">
                    <img src="/{{ config('config.icon_path') . $post->icon }}" alt="ss">
                </a>
            </div>
            @endforeach

        </div>
    </section>
<section class="container collaboration-examlpes">
    <h1>Our Values</h1>
    <div class="examples">
        @php($i = 1)
            @foreach ($our_values as $our_value)
            
            <div class="examples-div">
             
                @if(isset($our_value->icon))
                <span class="plius" style="  position: absolute;
            font-size: 58px;
            color: #0b6aa1;
            opacity: 20%;
            top: 0px;
            left: 44px;
            font-weight: 900">{{ $i++ }}.</span>
               
                <div class="examples-img"> <img src="/{{ config('config.icon_path') . $our_value->icon }}" alt="value">
                </div>
                @else
                <div class="examples-img"> <img src="{{ image($our_value->thumb) }}" alt="value">
                </div>
                @endif
                <h3>{{ $our_value->translate()->title }}</h3>
                <p>
                    {{ $our_value->translate()->desc }}

                </p>

            </div>
           
            @endforeach
    </div>
</section>
<section class="container">
    <div class="collaborarion">
        <div>
            <h1>{{ __('website.collaboration_With_Us') }}</h1>
        </div>
        <div>
          
            {!! $collaborate_posts->translate()->Additional_Text   !!} 
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
                <a href="/{{ $project->getFullSlug() }}">{{ $project->translate()->title }}</a>
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

<script>
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }    
    </script>

@endsection