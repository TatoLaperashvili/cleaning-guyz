<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Website\PagesController;
use Illuminate\Http\Request;
use App\Models\Slug;

class RoutesController extends Controller
{
    public function index($url,Request $request){
        
        
        if($url == 'search'){
            return SearchController::search($request);
        }
        
        // Check if the slug corresponds to a post
        $postSlug = Slug::where('fullSlug', app()->getLocale()."/{$url}")
                        ->where('slugable_type', 'App\Models\Post')
                        ->first();
        if ($postSlug) {
            $post = $postSlug->slugable;
            return PagesController::show($post);
        }
        
        // Check if the slug corresponds to a section
        $sectionSlug = Slug::where('fullSlug', app()->getLocale()."/{$url}")
                           ->where('slugable_type', 'App\Models\Section')
                           ->first();
        if ($sectionSlug) {
            $section = $sectionSlug->slugable;
            return PagesController::index($section, $request);
        }
    }
}
