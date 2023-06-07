{{-- <ul class="nav nav-tabs">

    @foreach (config('app.locales') as $locale)
    <li class="nav-item ">
        <a href="#locale-{{ $locale }}" data-toggle="tab" aria-expanded="false"
            class="nav-link @if($locale == app()->getLocale()) active @endif">
            <span class="d-none d-sm-block">{{ trans('admin.locale_'.$locale) }}</span>
        </a>
    </li>
    @endforeach

</ul> --}}
<div class="tab-content">
    @foreach (config('app.locales') as $locale)

    <div role="tabpanel" class="tab-pane fade @if($locale == app()->getLocale()) active show @endif "
        id="locale-{{ $locale }}">

        <div class="form-group">

            {{ Form::label(trans('admin.title'), null, ['class' => 'control-label']) }}
            {{ Form::text($locale.'[title]',  $directory->title ?? null, array_merge(['class' => 'form-control'])) }}

        </div>

    </div>
    @endforeach
</div>
<br>

    <div class="form-group">

        <br>
        <div class="form-group text-right mb-0">
            <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                {{ trans('admin.save') }}
            </button>
        </div>
	</div>
