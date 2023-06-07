<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Directory;
use App\Models\SectionTranslation;
use App\Models\Subscription;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Form;
use App\Models\FormField;
use App\Models\PostFile;
use App\Models\Slug;
use App\Models\Submission;
use App\Models\SubmissionFile;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\View\View;
use DB;
use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

class PagesController extends Controller
{
	public static function index($model,Request $request)
	{
		
		$language_slugs = $model->getTranslatedFullSlugs();
		if ($model->type_id == 0) {
			return self::homePage($model, $language_slugs);
			
		}
		if (request()->method() == 'POST') {
			$values = request()->all();
			
			$values['additional'] = getAdditional($values, config('submissionAttr.additional'));
			$submission = Submission::create($values);
			return redirect()->back()->with([
				'message' => trans('website.submission_sent'),
			]);
		}
		
		// dd($language_slugs);
		// BreadCrumb ----------------------------
		$breadcrumbs = [];
		$breadcrumbs[] = [
			'name' => $model[app()->getlocale()]->title,
			'url' => $model->getFullSlug()
		];
		
		$section = $model;
		

		while ($section->parent_id !== null) {

			$section = Section::where('id', $section->parent_id)->with('translations')->first();
			$breadcrumbs[] = [
				'name' => $section->title,
				'url' => $section->getFullSlug()
			
			];
			
		}
		$breadcrumbs = array_reverse($breadcrumbs);

		
		
		if ($model->type_id == 4) {
			
			return self::contact($model, $language_slugs);
			
		}
		
		if ($model->type_id == 1) {
			
            $post = Post::where('section_id', $model->id)->with('translations', 'files')->first();
			$our_values = Banner::where('type_id', bannerTypes()['Our_Values']['id'])->orderBy('date', 'desc')
			->whereHas('translation', function ($q) {
				$q->where('active', 1);
			})
			->orderBy('date', 'desc')
			->get();
			$text_page = Directory::where('type_id', 0)->where('parent_id', null)->with(['translations', 'children', 'services'])->orderBy("order_by", "asc")->get();
			
			$projects = Section::where('type_id', 12)->with('translations','posts')->first();
			
			$service = Section::where('type_id', 6)->with('translations')->first();
			$service_posts = Post::where('section_id', $service->id)->whereHas('translations',function ($q) {
				$q->where('active', 1);
			})->get();
			$text_page_banner =Banner::where('type_id', bannerTypes()['text_page_banner']['id'])->orderBy('date', 'desc')
			->whereHas('translation', function ($q) {
				$q->where('active', 1);
			})
			->orderBy('date', 'desc')
			->first();
			
            return self::show($post, $language_slugs, $our_values, $projects,$text_page,$service,$text_page_banner,'model','service_posts');
        }
		if($model->type_id  == 3){
			
			$vacancy = Section::where('type_id', 3)->with('translations')->first();
			
			$vacancy_posts = Post::where('section_id' , $model->id)->wherehas('translations',function ($q) {
				$q->where('active', 1);
			})->orderBy('date', 'desc')
			->paginate(settings('paginate'));
			$starrt_career = Directory::where('type_id', 1)->where('parent_id', null)->with(['translations', 'children', 'services'])->orderBy("order_by", "asc")->get();
			return view('website.pages.vacancy.index', compact('vacancy', 'vacancy_posts','language_slugs','starrt_career','model'));
		}
		if($model->type_id  == 6){
			
			$service = Section::where('type_id', 6)->with('translations')->first();
			$service_post = Post::where('section_id' , $model->id)->wherehas('translations',function ($q) {
				$q->where('active', 1);
			})->orderBy('date', 'desc')
			->where('special_service', 0)->get();	
			$service_posts = Post::where('section_id' , $service->id)->wherehas('translations',function ($q) {
				$q->where('active', 1);
			})->orderBy('date', 'desc')
			->get();
			$special_service = Post::where('section_id', $service->id)->wherehas('translations',function ($q) {
				$q->where('active', 1);
			})->where('special_service', 1)->get();
			$projects = Section::where('type_id', 12)->with('translations','posts')->first();
			$book_service = Banner::where('type_id', bannerTypes()['Book_A_Service']['id'])->orderBy('date', 'desc')
		->whereHas('translation', function ($q) {
			$q->where('active', 1);
		})
		->orderBy('date', 'desc')
		->first();
		$book_service_id = Post::where('section_id' , $service->id)->first();
		$service_banner = Banner::where('type_id', bannerTypes()['service_banner']['id'])->orderBy('date', 'desc')
			->whereHas('translation', function ($q) {
				$q->where('active', 1)->whereLocale(app()->getLocale());
			})
			->orderBy('date', 'desc')
			->get();
			return view('website.pages.service.index', compact('service', 'special_service','service_post',
			'book_service','projects','service_posts','book_service_id','service_banner','model','language_slugs'));
		}
		if($model->type_id  == 7){
			
			$collaborate = Section::where('type_id', 7)->with('translations')->first();
			
			$collaborate_posts = Post::where('section_id' , $model->id)->wherehas('translations',function ($q) {
				$q->where('active', 1);
			})->first();
			$our_values = Banner::where('type_id', bannerTypes()['Our_Values']['id'])->orderBy('date', 'desc')
			->whereHas('translation', function ($q) {
				$q->where('active', 1);
			})
			->orderBy('date', 'desc')
			->get();
			$partners_banner = Banner::where('type_id', bannerTypes()['partners_banner']['id'])->orderBy('date', 'desc')
		->whereHas('translation', function ($q) {
			$q->where('active', 1)->whereLocale(app()->getLocale());
		})
		->orderBy('date', 'desc')
		->get();
		$projects = Section::where('type_id', 12)->with('translations')->first();
		$project_posts = Post::Where('section_id', $projects->id)->whereHas('translations', function ($q) {
			$q->where('active', 1);
		})->orderBy('date', 'desc')->paginate(settings('paginate'));
		$collaborate_form = Form::where('id',$collaborate_posts->form_select)->with('fields')->first();
		$countFiles = 0;
		foreach($collaborate_form->fields as $fields){
			if($fields->type == 6){
				$countFiles ++;
			}
		}
			return view('website.pages.collaborate.index', compact('collaborate_form','collaborate',
			 'collaborate_posts','our_values','partners_banner','projects','project_posts','countFiles' ,'model'));
		}
		if($model->type_id  == 12){
			$projects = Section::where('type_id', 12)->with('translations')->first();
			$project_posts = Post::Where('section_id', $model->id)->whereHas('translations', function ($q) {
				$q->where('active', 1);
			})->orderBy('date', 'desc')->paginate(settings('paginate'));
			return view('website.pages.project.index', compact('projects', 'project_posts','language_slugs','model'));
		}
		
		$posts = Post::where('section_id', $model->id)
		->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
		->where('post_translations.locale', '=', app()->getLocale())
		->select('posts.*', 'post_translations.text', 'post_translations.desc', 'post_translations.title',
		 'post_translations.locale_additional', 'post_translations.slug');
	
		return view("website.pages.{$model->type['folder']}.index", compact(['model','posts', 'breadcrumbs',
		 'language_slugs']));
	}
	public static function homePage($model, $locales = null)
	{
		if ($model == null) {
			$model = Section::where('type_id', 0)->first();
		}
		if ($locales == null) {
			$locales = [];
			foreach (config('app.locales') as $value) {
				$locales[$value] =  '/'.$value;

			}
		}
			$about = Section::where('type_id', 1)->with('translations')->first();
            $about_post = Post::where('section_id', $about->id)->with('translations', 'files')->first();
			
		$mainBanners = Banner::where('type_id', bannerTypes()['main_banner']['id'])->orderBy('date', 'desc')
		->whereHas('translation', function ($q) {
			$q->where('active', 1)->whereLocale(app()->getLocale());
		})
		->orderBy('date', 'desc')
		->limit('1')
		->first();
		$staticBanner = Banner::where('type_id', bannerTypes()['Statistics_banner']['id'])->orderBy('date', 'desc')
		->whereHas('translation', function ($q) {
			$q->where('active', 1)->whereLocale(app()->getLocale());
		})->limit(4)
		->orderBy('date', 'desc')
		->get();
		$book_service = Banner::where('type_id', bannerTypes()['Book_A_Service']['id'])->orderBy('date', 'desc')
		->whereHas('translation', function ($q) {
			$q->where('active', 1)->whereLocale(app()->getLocale());
		})
		->orderBy('date', 'desc')
		->first();
		$partners_banner = Banner::where('type_id', bannerTypes()['partners_banner']['id'])->orderBy('date', 'desc')
		->whereHas('translation', function ($q) {
			$q->where('active', 1)->whereLocale(app()->getLocale());
		})
		->orderBy('date', 'desc')
		->get();
		$projects = Section::where('type_id', 12)->with('translations','posts')->first();
		$about_company = Section::where('type_id', sectionTypes()['text_page']['id'])->whereHas('translation', function($q){
			$q->where('active', 1);
		})->first();
		$about_post = Post::where('section_id', $about_company->id)->whereHas('translation', function($q){
			$q->where('active', 1);
			$q->where('active_on_home', 1);
			
		})->first();
		$service = Section::where('type_id', 6)->with('translations')->first();
		$service_posts = Post::where('section_id', $service->id)->whereHas('translations',function ($q) {
				$q->where('active', 1);
			})->get();
			
			
        return view('website.home', compact('locales','model','mainBanners','partners_banner',
		'projects','about_post','about_company','staticBanner'
		,'book_service','service','service_posts','about','about_post'));


	}
	public static function contact($model)
	{
		
		$breadcrumbs = [];
		$sec = $model;
		$breadcrumbs[] = [
			'name' => $model->title,
			'url' => $model->getFullSlug()
		];
		while ($sec->parent_id !== null) {
			$sec = Section::where('id', $model->parent_id)->with('translations')->first();
			$breadcrumbs[] = [
				'name' => $sec->title,
				'url' => $sec->getFullSlug()
			];
		}
		$sec = Section::where('type_id', sectionTypes()['home']['id'])->with('translations')->first();

		$breadcrumbs[] = [
			'name' => $sec->title,
			'url' => $sec->getFullSlug()
		];
		$breadcrumbs = array_reverse($breadcrumbs);
		$submenu_sections = Section::where('parent_id', $model->id)->orderBy('order', 'asc')->get();
		$post = Post::where('section_id', $model->id)->whereHas('translations', function($q){
			$q->where('active', 1);
		})->first();
		
		return view("website.pages.contact.show", compact('model', 'submenu_sections', 'breadcrumbs','post'));
	}
	public static function submenu($model)
	{

		$breadcrumbs = [];
		$sec = $model;
		$breadcrumbs[] = [
			'name' => $model->title,
			'url' => $model->getFullSlug()
		];
		while ($sec->parent_id !== null) {
			$sec = Section::where('id', $model->parent_id)->with('translations')->first();
			$breadcrumbs[] = [
				'name' => $sec->title,
				'url' => $sec->getFullSlug()
			];
		}
		$sec = Section::where('type_id', sectionTypes()['home']['id'])->with('translations')->first();

		$breadcrumbs[] = [
			'name' => $sec->title,
			'url' => $sec->getFullSlug()
		];
		$breadcrumbs = array_reverse($breadcrumbs);
		$submenu_sections = Section::where('parent_id', $model->id)->orderBy('order', 'asc')->get();

		return view("website.pages.submenu.index", compact('model', 'submenu_sections', 'breadcrumbs'));
	}
	public static function show($model)
	{
		
		if (isset($model)) {
			
		$language_slugs = $model->getTranslatedFullSlugs();
		// dd($language_slugs);
			// BreadCrumb ----------------------------
		$breadcrumbs = [];
		$breadcrumbs[] = [
			'name' => $model[app()->getLocale()]->title,
			'url' => $model->getFullSlug()
		];
		if ($model->section_id !== null) {
			$section = Section::where('id', $model->section_id)->with('translations')->first();
			$breadcrumbs[] = [
				'name' => $section->title,
				'url' => $section->getFullSlug()
			];
			while ($model->parent_id !== null) {
				$sec = Section::where('id', $section->section_id)->with('translations')->first();
		
				$breadcrumbs[] = [
					'name' => $sec->title,
					'url' => $sec->getFullSlug()
				];
			}
		}
		$contact = Section::where('type_id', 4)->with('translations')->first();
		$text_page_banner =Banner::where('type_id', bannerTypes()['text_page_banner']['id'])->orderBy('date', 'desc')
		->whereHas('translation', function ($q) {
			$q->where('active', 1)->whereLocale(app()->getLocale());
		})
		->orderBy('date', 'desc')
		->get();
		$projects = Section::where('type_id', 12)->with('translations')->first();
		$project_posts = Post::where('section_id', $model->id)->whereHas('translation', function($q){
			$q->where('active', 1)->whereLocale(app()->getLocale());
		})->orderBy('date', 'desc')->get();
		$project_slider = Post::where('section_id', $model->section_id)
		->wherehas('translations', function($q){
			$q->where('active', 1)->whereLocale(app()->getLocale());
			$q->where('locale', app()->getlocale());
		}) 
		->where('posts.id' , '!=', $model->id)
		->orderby('date', 'desc')
		->paginate(settings('paginate')); 
	
		$breadcrumbs = array_reverse($breadcrumbs);
		$our_values = Banner::where('type_id', bannerTypes()['Our_Values']['id'])->orderBy('date', 'desc')
		->whereHas('translation', function ($q) {
			$q->where('active', 1)->whereLocale(app()->getLocale());
		})
		->orderBy('date', 'desc')
		->get();
		$text_page = Directory::where('type_id', 0)->where('parent_id', null)
		->with(['translations', 'children', 'services'])->orderBy("order_by", "asc")->get();
		$service = Section::where('type_id', 6)->with('translations')->first();
			$service_posts = Post::where('section_id', $service->id)->whereHas('translations',function ($q) {
				$q->where('active', 1);
			})->get();
			
		$vacancy = Section::where('type_id', 3)->with('translations')->first();
		$vacancy_posts = Post::where('section_id', $vacancy->id)->whereHas('translations',function ($q) {
				$q->where('active', 1)
				->whereLocale(app()->getLocale());
			})->orderBy('date', 'asc')->first();

				$formFor_vacancy = Form::where('id' , $model->form_select)->with('fields')->first();
				
				$countFiles = 0;
				if($formFor_vacancy != ''){
				foreach($formFor_vacancy->fields as $fields){
					if($fields->type == 6){
						$countFiles ++;
					}
				}
			}else{
				$formFor_vacancy = '';
			}
			$vacancy_slider = Post::where('section_id', $vacancy->id)
		->whereHas('translations', function($q){
			$q->where('active', 1)->whereLocale(app()->getLocale());
			$q->where('locale', app()->getlocale());

		})->where('posts.id' , '!=', $model->id)->orderby('date', 'desc')->paginate(settings('paginate'));
		
		$book_service = Banner::where('type_id', bannerTypes()['Book_A_Service']['id'])->orderBy('date', 'desc')
		->whereHas('translation', function ($q) {
			$q->where('active', 1)->whereLocale(app()->getLocale());
		})
		->orderBy('date', 'desc')
		->first();
		$post = Post::where('posts.id', $model->id)
		
			->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
			->where('post_translations.locale', '=', app()->getLocale())
			->select('posts.*', 'post_translations.text', 'post_translations.desc', 'post_translations.title', 'post_translations.locale_additional', 'post_translations.slug')
			->with('files')->first();

		
		
		return view("website.pages.{$section->type['folder']}.show", [
			'model' => $model,'section' => $section,'post' => $post,'post' => $model,
			'breadcrumbs' => $breadcrumbs,
			'language_slugs' => $language_slugs,
			'projects' => $projects,
			'our_values' => $our_values,
			'text_page' => $text_page,
			'service' => $service,
			'vacancy' => $vacancy,
			'contact' => $contact,
			'vacancy_posts' => $vacancy_posts,
			'text_page_banner' => $text_page_banner,
			'project_posts' => $project_posts,
			'project_slider' => $project_slider,
			'vacancy_slider' => $vacancy_slider,
			'service_posts' => $service_posts,
			'book_service' => $book_service,
			'formFor_vacancy' => $formFor_vacancy,

		])->render();
	}  else{

		return redirect()->back()->with([
			'message' => trans('website.notinformation'),
		]);
	}

	}


}
