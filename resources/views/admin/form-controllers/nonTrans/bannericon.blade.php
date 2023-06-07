<div class="form-group">
    <label data-icon="-">{{ trans('admin.'.$key) }}</label> <br>
	@if (isset($banner) && $banner->icon != '')
   
	<input type="hidden" name="old_icon" value="{{ $banner->icon }}">
	
	@endif
    <input type="file" name="icon">
	
	<div class="col-md-8 dicon d-flex">
		<img src="/{{ config('config.icon_path') . $banner->icon }}" alt="" style="width: 25%">

		<span class="deleteicon" data-id="{{ $banner->id }}"
			data-token="{{ csrf_token() }}"
			data-route="/{{ app()->getLocale() }}/admin/banners/deleteicon/{{ $banner->id }}"
			delete="{{ $banner->icon }}">X</span>
		
	</div>
</div> 
