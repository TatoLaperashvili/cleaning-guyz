@if (isset($type["fields"]['trans']) && count($type["fields"]['trans']) > 0)
        @foreach (config('app.locales') as $locale)
            @foreach ($type["fields"]['trans'] as $key => $field)
                @include('admin.form-controllers.trans.'.$field['type'])
            @endforeach
        
        @endforeach  
@endif
@if (isset($type["fields"]['nonTrans']) && count($type["fields"]['nonTrans']) > 0)
    @foreach ($type["fields"]['nonTrans'] as $key => $field)
        @include('admin.form-controllers.nonTrans.'.$field['type'])
    @endforeach
@endif
                    
                    
                
 
                
                
                

<div class="form-group text-right mb-0">
    <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
        {{ trans('admin.save') }}
    </button>
</div>
                