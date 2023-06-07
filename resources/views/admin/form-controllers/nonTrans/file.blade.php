
<div class="form-group">
    <label data-icon="-">{{ trans('admin.'.$key) }}</label> <br>
	@if (isset($post) && $post->thumb != '')

	<input type="hidden" name="{{ $key }}]" value="{{ $post->thumb }}">
	
	@endif
    <input type="file" name="image">
	@if (isset($post) && $post->thumb != '')
	<div class="col-md-3 dimage d-flex">
		<img class="card-img" src="{{ '/' . config('config.image_path') . config('config.thumb_path') .  $post->thumb }}" alt="ss" >

		<span class="deleteimage" data-id="{{ $post->id }}"
			data-token="{{ csrf_token() }}"
			data-route="/{{ app()->getLocale() }}/admin/post/deleteimage/{{ $post->id }}"
			delete="{{ $post->thumb }}">X</span>
		
	</div>
	@endif
</div> 
<style>
.d-flex{
	margin-top: 30px;
	
}
.card-img{
    width: 100%;
    border-style: double;
    border-radius: 5%;	
}
.deleteimage{
	margin-left: 10px;
    color: red;
    width: 100%;
    max-width: 20px;
    height: auto;
}
</style>