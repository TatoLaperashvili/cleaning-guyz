<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\SectionTranslation;
use App\Models\Subscription;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\PostFile;
use App\Models\Slug;

class SearchController extends Controller
{
    public static function search(Request $request)
	{
		$model = [];
		$locales = [];
		foreach (config('app.locales') as $value) {
			$locales[$value] =  '/'.$value;

		}
		
		$validatedData = $request->validate([
			'que' => 'required',
		]);
		$searchText = $validatedData['que'];
		$postTranlations = PostTranslation::whereActive(true)->whereLocale(app()->getLocale())
			->where('title', 'LIKE', "%{$searchText}%")
			->orWhere('desc', 'LIKE', "%{$searchText}%")
			->orWhere('text', 'LIKE', "%{$searchText}%")
			->orWhere('keywords', 'LIKE', "%{$searchText}%")
			->orWhere('locale_additional', 'LIKE', "%{$searchText}%")->pluck('post_id')->toArray();
		$posts  = Post::whereIn('id', $postTranlations)->with('translations', 'parent', 'parent.translations')->paginate(settings('paginate'));
		$posts->appends(['que' => $searchText]);
		$count = $posts->count();
		
		$data = [];
		foreach ($posts as $post) {
			$data[] = [
				'slug' => $post->getFullSlug() ?? '#',
				'title' => $post->translate(app()->getLocale())->title,
				'desc' => str_limit(strip_tags($post->translate(app()->getLocale())->desc)),
			];
		}
		
		return view('website.pages.search.index', compact('posts', 'locales'));
	}	

	public static function SearchProduct(request $request)
	{
		
		$que = $request->que;
		$model = Section::where('type_id', 14)->with('translations')->first();
		
		$products  = Section::where('type_id', 14)->with('translations', 'posts')->first();
		$category  = Section::where([['type_id', 13], ['parent_id', null]])->with('translations', 'children', 'children.children')->get();
		$language_slugs = $model->getTranslatedFullSlugs();

		$products_posts = Post::Where('section_id', $model->id)->whereHas('translations', function ($q) use ($que) {
			$q->where('title', 'LIKE', "%{$que}%");
			$q->orWhere('desc', 'LIKE', "%{$que}%");
			$q->orWhere('text', 'LIKE', "%{$que}%");
		})->paginate(settings('products_pagination'));
		
		
		
		return view('website.pages.products.index', compact('products_posts', 'model', 'category', 'products', 'language_slugs' , 'que'));
	}
	
}
