<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\MenuSection;
use App\Models\Post;
use App\Models\PostFile;
use Illuminate\Support\Facades\Validator;
use App\Models\PostTranslation;
use App\Models\SectionTranslation;
use App\Models\Slug;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller
{
    public function index($sec , Request $request){
        $section = Section::where('id', $sec)->with('translations')->first();
       
        if (isset($section->type) && in_array($section->type['type'], [1, 4, 7] ) ){
            $post = Post::where('section_id', $sec)->with(['translations', 'slugs'])->first();
            if (isset($post) && $post !== null) {
                return Redirect::route('post.edit', [app()->getLocale(), $post->id,]);
            }
            return Redirect::route('post.create', [app()->getLocale(), $sec,]);
        }
        $posts = Post::where('section_id', $sec)->orderBy('date', 'desc')->orderBy('created_at', 'asc')
		->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
		->where('post_translations.locale', '=', app()->getLocale())
		->select('posts.*', 'post_translations.text', 'post_translations.desc', 'post_translations.title', 'post_translations.locale_additional', 'post_translations.slug');

        $posts = $posts->with(['translations', 'slugs'])->paginate(settings('Paginate'));


        return view('admin.posts.list', compact(['section', 'posts']));
    }
    public function create($sec){
        $section = Section::where('id', $sec)->with('translations')->first();

        return view('admin.posts.add', compact(['section']));
    }



    public function store($sec, Request $request){
       
        $section = Section::where('id', $sec)->with('translations')->first();
        $values = $request->all();
       
        $values['section_id'] = $sec;
        $values['author_id'] = auth()->user()->id;
        $postFillable = (new Post)->getFillable();
        
       
        $postTransFillable = (new PostTranslation)->getFillable();
       
        if(isset($values['image']) && ($values['image'] != '')){
            $file_name = uniqid() . '.' .$values['image'] ->getClientOriginalExtension();
            // Generate Thumbnail
            Image::make($values['image'])->fit(config('config.thumbnail.width'), config('config.thumbnail.height'))
            ->save(config('config.image_path') . config('config.thumb_path') . $file_name, 70);
        
            // Save original image
            Image::make($values['image'] )->save(config('config.image_path') .  $file_name, 70);
            $values['thumb'] = '';
            $values['thumb'] = $file_name;
        }
       
        $values['additional'] = getAdditional($values, array_diff(array_keys($section->fields['nonTrans']) , $postFillable) );



        foreach(config('app.locales') as $locale){
            // $values[$locale]['slug'] = str_replace(' ', '-', $values[$locale]['title']);
            if($values[$locale]['slug'] != ''){
                $values[$locale]['slug'] = SlugService::createSlug(PostTranslation::class, 'slug', $values[$locale]['slug']);
                $values[$locale]['slug'] = SlugService::createSlug(SectionTranslation::class, 'slug', $values[$locale]['slug']);
            }else{
                $values[$locale]['slug'] = SlugService::createSlug(PostTranslation::class, 'slug', $values[$locale]['title']);
            }
            $fullslug[$locale] = $locale.'/'.$values[$locale]['slug'];

            $values[$locale]['locale_additional'] = getAdditional($values[$locale], array_diff(array_keys($section->fields['trans']), $postTransFillable) );   
         
        }
        $post = Post::create($values);
        
        foreach(config('app.locales') as $locale){
            $post->slugs()->create([
                'fullSlug' => $locale.'/'.$post->translate($locale)->slug,
                'locale' => $locale
            ]);
        }
    
        if (isset($values['files']) && count($values['files']) > 0) {
          
               
			
            foreach($values['files'] as $key => $files){
              
				foreach($files['file'] as $k => $file){
					$postFile = new PostFile;
					$postFile->type = $key;
					$postFile->file = $file;
					$postFile->title = $values['files'][$key]['desc'][$k];
					$postFile->post_id = $post->id;
					$postFile->save();
				}
            }
        }
        
        return Redirect::route('post.list', [app()->getLocale(), $section->id,]);
    }




    public function edit($id){
       
        $post = Post::where('id', $id)->with(['translations', 'files'])->first();
       
        $section = Section::where('id', $post->section_id)->with('translations')->first();
        return view('admin.posts.edit', compact('section', 'post'));
    }


 
    public function update($id, Request $request){
       
        $post = Post::where('id', $id)->with('translations','files')->first();
        
       
        $section = Section::where('id', $post->section_id)->with('translations')->first();

        Post::find($id)->slugs()->delete();

        $values = $request->all();
      
        $postFillable = (new Post)->getFillable();
        $postTransFillable = (new PostTranslation)->getFillable();

        if(isset($values['image']) && ($values['image'] != '')){

            $file_name = uniqid() . '.' .$values['image'] ->getClientOriginalExtension();
            // Generate Thumbnail
            Image::make($values['image'])->fit(config('config.thumbnail.width'), config('config.thumbnail.height'))
            ->save(config('config.image_path') . config('config.thumb_path') . $file_name, 70);
        
            // Save original image
            Image::make($values['image'] )->save(config('config.image_path') .  $file_name, 70);
            $values['thumb'] = '';
            $values['thumb'] = $file_name;
           
        }
       
        if(isset($values['old_image'])){
            $values['thumb'] = $values['old_image'];
            if(file_exists(config('config.image_path').$values['old_image'])){
                unlink(config('config.image_path').$values['old_image']);
                unlink(config('config.image_thumb_path').$values['old_image']);
                }
            
        }

      
        $values['additional'] = getAdditional($values, array_diff(array_keys($section->fields['nonTrans']), $postFillable) );

       
        foreach(config('app.locales') as $locale){

            if($values[$locale]['slug'] != $post[$locale]->slug){

                $values[$locale]['slug'] = SlugService::createSlug(PostTranslation::class, 'slug', $values[$locale]['slug']);

            }
           
				$post->slugs()->create([
					'fullSlug' => $locale.'/'.$post->translate($locale)->slug,
					'locale' => $locale
				]);
       
            $values[$locale]['locale_additional'] = getAdditional($values[$locale], array_diff(array_keys($section->fields['trans']), $postTransFillable) );

        }

        $allOldFiles = PostFile::where('post_id', $post->id)->get();
        
        foreach ($allOldFiles as $key => $fil) {
            if(isset($values['old_file']) && count($values['old_file']) > 0) {
            if(!in_array($fil->id, array_keys($values['old_file']))){
                $fil->delete();
            }
            }else{
                $fil->delete();
            }
        }

       
        Post::find($post->id)->update($values);
       
     
        
        return Redirect::route('post.list', [app()->getLocale(), $section->id,]);
    }

    public function destroy($id){

        $post = Post::where('id', $id)->first();
        // foreach (Post::find($id)->slugs()->get() as $slug) {

        //     // Post::find($id)->delete();
        // }
        $section = Section::where('id', $post->section_id)->with('translations')->first();

        $files = PostFile::where('post_id', $post->id)->get();
        foreach($files as $file){
           
            if(file_exists(config('config.image_path').$file->file)){
                unlink(config('config.image_path').$file->file);
                }else{
                dd('File does not exists.');
                }
                if(file_exists(config('config.image_path').'thumb/'.$file->file)){
                    unlink(config('config.image_path').'thumb/'.$file->file);
                    }else{
                    dd('File does not exists.');
                    }
            $file->delete();
        }

        PostTranslation::where('post_id', $post->id)->delete();

        Post::find($id)->slugs()->delete();
        $post->delete();


        return Redirect::route('post.list', [app()->getLocale(), $section->id,]);
    }






    public function Deleteimage($que) {
       
        $post = Post::where('id', $que)->first();
       
            if(file_exists(config('config.image_path').$post->thumb)){
                unlink(config('config.image_path').$post->thumb);
                }else{
                dd('File does not exists.');
                }
                if(file_exists(config('config.image_path').'thumb/'.$post->thumb)){
                    unlink(config('config.image_path').'thumb/'.$post->thumb);
                    }else{
                    dd('File does not exists.');
                    }
          
        
        $post->thumb = '';
       

        return response()->json(['success' => 'File Deleted']);
    }

}