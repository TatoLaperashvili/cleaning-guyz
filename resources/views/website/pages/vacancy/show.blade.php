@extends('website.master')
@section('main')
@if(Session::has('vacancy_message'))
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
<section class="apply-section">
    <div class="container apply-section_divs">
        <div class="apply-section_div1">

            <div>
                <h1>{{ $model->translate()->title }}</h1>
                <div class="apply-section_div1-va">
                    <i class="icon-Vector-7"></i>
                    <p>{{$model->translate()->address }}</p>
                </div>
            </div>
            <div>
                {!! $model->translate()->desc !!}
            </div>
            <div class="apply-section_div1-box">
                @if(isset($model->additional['start_date'] ) && isset($model->additional['end_date']))
                @if (Carbon\Carbon::now()->gt($model->additional['start_date']) && Carbon\Carbon::now()->lt(
                $model->additional['end_date'])
                )
                <div id="applay">

                    <p>Apply Now</p>

                </div>
                @endif
                @else
                <div id="applay">

                    <p>Apply Now</p>

                </div>
                @endif
                <div>
                    <i class="icon-Vector-8" style="color: wheat"></i>
                    <p>{{ $model->Working_Time }}</p>
                </div>
                <div>
                    <i class="icon-Vector-5"></i>
                    <p>{{ $model->Working_Monthly_Rate }}</p>
                </div>
            </div>
        </div>
        <div class="apply-section_div2">
            <h3>responsibilities</h3>

            <div class="apply-section_div2-info">

                <div>{!!$model->translate()->Responsibilities!!}</div>

            </div>
        </div>

    </div>
</section>
<section class="container morevacancies">
    <div> {!! $model->translate()->Additional_Text !!}</div>
</section>
<section class="container">
    <div class="morevacancies-h1">
        <h1>more vacancies</h1>
    </div>
    <div class="cards-row">
        @foreach($vacancy_slider as $slider)

        <div class="card">
            <div>
                <img src="/website/assets/images/img/image 3.png" alt="">
                <p>{{ $slider->translate()->title }}</p>
            </div>
            <div>
                <i class="icon-Vector-6"></i>
                <p>{{ Str::limit(  $slider->translate()->Position , 30) }}</p>
            </div>
            <div>
                <i class="icon-Vector-7"></i>
                <p>{{ $slider->translate()->address }}</p>
            </div>
            <div>
                <i class="icon-Vector-8"></i>
                <p>{{ $slider->Working_Time }}</p>
            </div>
            <div>
                <i class="icon-Vector-5"></i>
                <p>{{ $slider->Working_Monthly_Rate }}</p>
            </div>
            <div>
                <!--<p>{{Carbon\Carbon::parse($slider->date)->format('M d, Y') }}</p>-->
                <a href="/{{ $slider->getFullSlug() }}">View</a>
            </div>
        </div>
        @endforeach

    </div>
    <div class="pagination">
        @if(isset($vacancy_slider) && (count($vacancy_slider) > 0))

        {{ $vacancy_slider->links("website.components.pagination") }}
        @endif

    </div>
</section>

<section class="aplication-form">
    <div class="aplication-form_background"></div>
    <div class="aplication-form__form">
        <div class="formh1">
            <h1>Aplication Form</h1>
        </div>
        <div class="form-text">Cleaning Specialist</div>

        <form action="/{{app()->getlocale()}}/vacancysubmission/{{$model->id}}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="section_type_id" id="my_captcha_form" value="{{ $vacancy->type_id }}">
            <!--<div class="validation__input-box">-->

            <!--    <label for="aplication-name" class="aplication-name">{{ $formFor_vacancy->name }}</label>-->
            <!--    <input type="text" name="name" id="" value="" required style="position: initial;">-->
            <!--</div>-->
            <!--<div class="validation__input-box">-->
            <!--    <label for="aplication-name" class="aplication-name">{{ $formFor_vacancy->email }}</label>-->
            <!--    <input type="text" name="email" id="" value="" required style="position: initial;">-->
            <!--</div>-->
            <input type="hidden" name="post_id" value="{{ $model->id }}">
            <input type="hidden" name="section_type_id" value="{{$vacancy->type_id}}">

            @foreach($formFor_vacancy->fields as $form)
            @php($i = 0)
            @if($form->type == 1)
            <div>
                <label for="">{{ $form->title }}
                    @if ($form->validation['required'] == 1)
                    <span style="color: red">*</span>
                    @endif
                </label>

                <input type="text" name="answers[{{ $form->title }}]" id="field_{{ $form->id }}"
                    @if($form->validation['required'] == 1) required @endif >
            </div>
            @endif
            @if($form->type == 11)
            <div>
                <input type="number" name="answers[{{ $form->title }}]" id="" placeholder="{{ $form->title }}"
                    onkeypress="return isNumberKey(event)" @if($form->validation['required'] == 1) required @endif>
            </div>
            @endif
            @if($form->type == 3)
            <div>
                <textarea id="w3review" name="answers[{{ $form->title }}]" rows="4" cols="50">

        </textarea>
            </div>
            @endif
            @if($form->type == 8)
            <div>
                <select name="answers[{{ $form->id }}]" id="" @if($form->validation['required'] == 1) required @endif>
                    <option value="">Select Options</option>
                    @if(isset($form->data['options']))
                    @foreach($form->data['options'] as $options)

                    <option value="{{ $options }}">{{ $options  }}</option>

                    @endforeach
                    @endif
                </select>
            </div>

            @endif
            @if($form->type == 10)
            <div class="val-checkbox-main">

                <div>

                    <h3>{{ $form->title }}</h3>
                </div>
                <div class="validation-checkbox">
                    @if(isset($form->data['options']))
                    @foreach($form->data['options'] as $options)
                    <div class="form__checkbox">
                        <div>
                            <input type="checkbox" id="checkbox{{ $i }}"
                                name="answers[title][{{ $form->title }}][{{ $options }}]">
                        </div>
                        <div>
                            <label for="checkbox{{ $i }}">{{ $options }}</label>
                        </div>

                    </div>
                    @php($i ++)
                    @endforeach
                    @endif
                </div>
            </div>
            @endif

            @if($form->type == 3)
            <div class="validation-textarea ">
                <textarea id="w3review" name="answers[{{ $form->title }}]" rows="4" cols="50">

                </textarea>
            </div>
            @endif

            @if($form->type == 6)
            <div class="aplication-form-file">
                <i class="icon-Vector-10"></i>
                <label for="aplication-file">{{ $form->title }}</label>
                <input type="file" name="answers[file][{{ $form->title  }}]" id="aplication-file" multiple>

            </div>
            @endif

            @endforeach

            <div class="g-recaptcha" data-size="invisible" data-callback="onSubmit"
                data-sitekey="6Lc1p0UjAAAAAEurBKZdmqaJVmj-KF1urJnIFEI2"></div>


            <button onclick="onClick()">Apply Now</button>

            <script>
                jQuery(function () {
                    $("#field_{{ $form->id }}").keyup(function () {
                        $(this).removeClass('warning');
                        var val = this.value;
                        let msg = '';
                        @if($form - > validation['required'] == 1)
                        if (val == '') {
                            $(this).addClass('warning');
                            msg = 'this field required';
                        }
                        @endif
                        $(this).siblings('small').text(msg)
                    });
                });

            </script>
            {{-- {{ dd( Carbon\Carbon::now()->gt($model->additional['start_date'])) }} --}}
            <script>
                function onSubmit(token) {

                    document.getElementById("my_captcha_form").submit();

                }

                function onClick() {
                    grecaptcha.execute();
                }

            </script>
        </form>

    </div>

</section>

@endsection
