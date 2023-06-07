@extends('website.master')
@section('main')
<main>
    @if(Session::has('message'))
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
    <section class="contact-page">
        <div class="container contact-main">
            <div>
               
                {!! $model->translate()->desc !!}
            </div>
            <div class="contact-body">
                <div class="contact1">
                    <div class="contact1-link">
                        <a href="">
                            <div class="contact-icon">
                                <i class="icon-Vector-51"> </i>
                            </div>
                            <div class="contact-info"> {{$post->phone}}</div>
                        </a>
                    </div>
                    <div class="contact1-link">
                        <a href="">
                            <div class="contact-icon">
                                <i class="icon-message-2-fill"> </i>
                            </div>
                            <div class="contact-info">{{$post->email}}</div>
                        </a>
                    </div>
                    <div class="contact1-link">
                        <a href="">
                            <div class="contact-icon">
                                <i class="icon-Vector-7"> </i>
                            </div>
                            <div class="contact-info">{{$post->adress}}</div>
                        </a>
                    </div>

                </div>
                <div class="contact2">
                    <h1>{{ $post->translate()->title }}</h1>
                    <form method="POST" action="/{{ app()->getLocale()}}/submission">
                        @csrf
                        <input type="hidden" placeholder="Name" name="post_id" value="{{$post->id}}">
                        <input type="hidden" placeholder="Name" name="section_type_id" value="{{$model->type_id}}">
                        <div class="validation__input-box">
                            <input type="text" name="name" id="" placeholder="Full Name" required>
                            <label>Full Name</label>
                        </div>
                        <div class="validation__input-box">
                            <input type="email" name="email" id="" placeholder="E-Mail" required>
                            <label>E-Mail</label>
                        </div>

                        <input type="phone" name="phone" id="" placeholder="Phone">
                        <div class="validation__input-box">
                            <input type="text" name="subject" id="" placeholder="Subject" required>
                            <label>Subject</label>
                        </div>

                        <div class="validation__input-box box-text">
                            <textarea name="text" id="" cols="30" rows="10" placeholder="Massage Text"></textarea>
                            <label>Massage Text</label>
                        </div>
                        <button type="submit">Submit</button>
                     
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1oD69hvp6ANXE3BDwQ-pBB3sNPQoSHm0&ehbc=2E312F" width="640" height="480"></iframe>
        </div>
    </section>
</main>
<style>
    [data-icon]:before {
        float: right;
        color: red;
        font-size: 24px;
    }

</style>
@endsection
