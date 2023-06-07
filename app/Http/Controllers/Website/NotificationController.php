<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubmissionFile;
use App\Models\Submission;
use App\Models\Form;
use App\Models\FormField;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Exception;
use App\Models\Subscription;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NotificationController extends Controller
{
    public static function subscribe(Request $request)
	{
		
		$validatedData = $request->validate([
			'email' => 'required|email',
		]);
		$subscriber = Subscription::where('email', $validatedData['email'])->first();
		if ($subscriber == null) {
			$subscription = new Subscription;
			$subscription->locale = app()->getLocale();
			$subscription->email = $validatedData['email'];
			$subscription->save();
			return response()->json(trans('website.successfuly_subscribed'));
		}
		return response()->json(trans('website.allready_subscribed'));
	}
	public static function submission(Request $request){
		$values = request()->all();
		
        if(auth()->user()){
            $values['user_id'] = auth()->user()->id;
        }else{
            $values['user_id'] = 1;
        };
	
		$values['additional'] = getAdditional($values, config('submissionAttr.additional'));
		
		$submission = Submission::create($values);
		
		return back()->with([
			'message' => trans('website.submission_sent'),
		]);
	}

	public static function formsubmission(Request $request, $id){
		
		$values = request()->all();
		
		
		if(isset($values['answers']['file']) && ($values['answers']['file'] != '')){
			foreach($values['answers']['file'] as $key => $file){
				$newcoverName = uniqid() . "." . $file->getClientOriginalExtension();
				$file->move(config('config.file_path'), $newcoverName );
				$values['answers']['file'][$key] =  $newcoverName;
			}
          
        }
		$values['additional'] = getAdditional($values, config('submissionAttr.additional'));
		
		$submission = Submission::create($values);
		
		return back()->with([
			'vacancy_message' => trans('website.submission_sent'),
		]);
	}
	
	public static function servicesubmission(Request $request){
		
		$values = request()->all();
		
			$validator = Validator::make($request->all(), [
				'name' => 'required',
				'email' => 'regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/',
				'post_id' => 'required',
				'section_type_id' => 'nullable'
				
			]);
			
			if ($validator->fails()) {
				
				return redirect()->back()->withErrors($validator)->withInput();
			}else{
			
				$data = $validator->validated();
				
		$values['additional'] = getAdditional($values, config('submissionAttr.additional'));
			
		
		$submission = Submission::create($values);
				
		return back()->with([
			'service_message' => trans('website.submission_sent'),
			
		]);
	}
	}
		
	public static function collaborate(Request $request, $id){
		// dd($request->hasFile);
		$values = request()->all();
		
		$validator=Validator::make($request->all(),[
			'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha',
		]);
		
		
			if (isset($values['answers']['file']) && ($values['answers']['file'] != '')) {
				// dd($values['answers']['file']);
				foreach($values['answers']['file'] as $key => $file){
						foreach($file as $n => $f){
							$fileName = time().'_'.$f->getClientOriginalName();
							$f->move(config('config.file_path'), $fileName);
							$values['answers']['file'][$key][$n] = $fileName;
						}
				
				}
			   
			}else {
				$values['answers']['file'] = '';
			}
			
		
		
		$values['additional'] = getAdditional($values, config('submissionAttr.additional'));
		
		$submission = Submission::create($values);
		
		return back()->with([
			'coll_message' => trans('website.submission_sent'),
		]);
	
}
}
