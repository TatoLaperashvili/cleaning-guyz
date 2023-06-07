<?php

namespace App\Http\View\Composers;


use Illuminate\View\View;
use App\Models\Section;
use App\Models\Banner;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
class WebsiteComposer
{

    private $sections;
    private $footerSections;
    private $service;
    private $service_posts;
    private $mainBanner;
    
    


    public function __construct()
    {
        
        $model = [];

        $this->sections = Section::whereHas('translations', function($q) {
            $q->whereActive(true)->whereLocale(app()->getLocale());
        })
        ->whereHas('menuTypes', function($q){
            $q->where('menu_type_id', 1);
        })->where('parent_id', null)
        ->orderBy('order', 'asc')
        ->get();
       

      
         $this->footerSections = Section::whereHas('translations', function($q) {
            $q->whereActive(true)->whereLocale(app()->getLocale());
        })
        ->whereHas('menuTypes', function($q){
            $q->where('menu_type_id', 2);
        })
        ->where('parent_id', null)
        ->orderBy('order', 'asc')
        ->get();
            $this->mainBanner = Banner::whereHas('translations', function($q) {
                $q->where('active' ,1)->whereLocale(app()->getLocale());
            })->orderBy('date', 'asc')->get();
          
			  $this->service = Section::where('type_id', 6)->with('translations')->first();
            $this->service_posts = Post::where('section_id', $this->service->id)->whereHas('translations',function ($q) {
				$q->where('active', 1);
			})->get();

    }
    public function compose(View $view)
    {
        $view->with([
			'sections' => $this->sections,
			'footerSections' => $this->footerSections,
			'mainBanner' => $this->mainBanner,
			'sidebar_menu' => $this->footerSections,
            'service' => $this->service,
            'service_posts' => $this->service_posts,
            
		]);
    }
}
