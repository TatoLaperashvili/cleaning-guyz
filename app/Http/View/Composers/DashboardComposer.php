<?php

namespace App\Http\View\Composers;

use App\Models\BookNow;
use Illuminate\View\View;
use App\Models\Submission;
use Illuminate\Support\Facades\Config;
class DashboardComposer

{
    public $locales = [];

    public function __construct()
    {
        $this->notifications = Submission::where('seen', 0)->with('post.parent')->orderBy('created_at', 'desc')->get();
        $this->contact_notifications = Submission::where('seen', 0)->where('section_type_id', 4)->with('post.parent')->orderBy('created_at', 'desc')->get();
        $this->vacancy_notifications = Submission::where('seen', 0)->where('section_type_id', 3)->with('post.parent')->orderBy('created_at', 'desc')->get();
        $this->service_notifications = Submission::where('seen', 0)->where('section_type_id', 6)->with('post.parent')->orderBy('created_at', 'desc')->get();
        $this->collaborate_notifications = Submission::where('seen', 0)->where('section_type_id', 7)->with('post.parent')->orderBy('created_at', 'desc')->get();
        // $this->notifications = Submission::where('seen', 0)->with('post.parent')->orderBy('created_at', 'desc')->get();
        // $this->notifications = Submission::where('seen', 0)->with('post.parent')->orderBy('created_at', 'desc')->get();
        

        foreach (Config::get('app.locales') as $locale) {
            $currentLocale = "/".app()->getLocale()."/";
            $thisLocale = "/".$locale."/";
            $this->locales[$locale] = str_replace($currentLocale,$thisLocale,url()->full());
        }
    }


    public function compose(View $view)
    {

        $view->with([
            'notifications' => $this->notifications,
            'contact_notifications' => $this->contact_notifications,
            'vacancy_notifications' => $this->vacancy_notifications,
           'service_notifications' =>   $this->service_notifications,
           'collaborate_notifications' =>   $this->collaborate_notifications,
            "locales" => $this->locales
        ]);
    }
}
