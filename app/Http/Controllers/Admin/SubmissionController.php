<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Subscription;
use App\Models\Post;
use App\Models\Section;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\collaborateexport;
use App\Exports\ServiceExport;
use App\Exports\ContactExport;
use App\Exports\VacancyExport;
use App\Exports\exportPostSubmission;
class SubmissionController extends Controller
{
    public function index(){
        $post = null;
        if (isset(request()->all()['post_id'])) {
            $post = Post::where('id', request()->all()['post_id'])->with('translations')->first();
           
            $submissions = Submission::orderBy('created_at', 'desc')->where('post_id', request()->all()['post_id'])->with('post')->paginate(10);
        }
        else {
           
            $submissions = Submission::where('section_type_id', NULL)->orderBy('created_at', 'desc')->with('post')->where('id','post_id')->paginate(100);
            
        }
        return view('admin.submissions.index', compact(['submissions', 'post']));

    }
    public function contact(){
        $post = null;
        if (isset(request()->all()['post_id'])) {
            $post = Post::where('id', request()->all()['post_id'])->with('translations')->first();
           
            $submissions = Submission::orderBy('created_at', 'desc')->where('post_id', request()->all()['post_id'])->with('post')->paginate(10);
        }
        else {
           
            $submissions = Submission::where('section_type_id',4)->orWhere('section_type_id', NULL)->orderBy('created_at', 'desc')->with('post')->paginate(100);
            
        }
        return view('admin.submission_contact.index', compact(['submissions', 'post']));

    }
    public function vacancy(){
        $post = null;
        $vacancysub = 'cont';
       
        if (isset(request()->all()['post_id'])) {
           
            $post = Post::where('id', request()->all()['post_id'])->with('translations')->first();
           
           
            $submissions = Submission::where('section_type_id', 3)->orderBy('created_at', 'desc')->where('post_id', request()->all()['post_id'])->with('post')->paginate(100);
        }
        else {
            $submissions = Submission::where('section_type_id', 3)->orderBy('created_at', 'desc')->with('post')->paginate(100);
        }

        return view('admin.submissions_vacancy.index', compact(['submissions', 'post','vacancysub' ]));
    }
    public function service(){
        $post = null;
        $servicesub = 'cont';
       
        if (isset(request()->all()['post_id'])) {
           
            $post = Post::where('id', request()->all()['post_id'])->with('translations')->first();
          
           
            $submissions = Submission::where('section_type_id', 6)->orderBy('created_at', 'desc')->where('post_id', request()->all()['post_id'])->with('post')->paginate(100);
        }
        else {
            $submissions = Submission::where('section_type_id', 6)->orderBy('created_at', 'desc')->with('post')->paginate(100);
        }

        return view('admin.submission_service.index', compact(['submissions', 'post','servicesub']));
    }
    public function collaborate(){
        $post = null;
        $collaboratesub = 'cont';
       
        if (isset(request()->all()['post_id'])) {
           
            $post = Post::where('id', request()->all()['post_id'])->with('translations')->first();
           
           
            $submissions = Submission::where('section_type_id', 7)->orderBy('created_at', 'desc')->where('post_id', request()->all()['post_id'])->with('post')->paginate(100);
        }
        else {
            $submissions = Submission::where('section_type_id',7)->orWhere('section_type_id', NULL)->orderBy('created_at', 'desc')->with('post')->paginate(100);
          
        }
       

        return view('admin.collaborate_submission.index', compact(['submissions', 'post','collaboratesub']));
    }

    public function serviceshow($id){
        $submission = Submission::orderBy('created_at', 'desc')->with('post', 'post.translations', 'post.parent', 'post.parent.translations')->where('id', $id)->first();
       
        $submission->seen = 1;
        $submission->save();
        
        return view('admin.submission_service.show', compact(['submission']));

    }
    public function contactshow($id){
        $submission = Submission::orderBy('created_at', 'desc')->with('post', 'post.translations', 'post.parent', 'post.parent.translations')->where('id', $id)->first();
       
        $submission->seen = 1;
        $submission->save();
        
        return view('admin.submission_contact.show', compact(['submission']));

    }
    public function collaborateshow($id){
        $submission = Submission::orderBy('created_at', 'desc')->with('post', 'post.translations', 'post.parent', 'post.parent.translations')->where('id', $id)->first();
        $submission->seen = 1;
        $submission->save();
        
        return view('admin.collaborate_submission.show', compact(['submission']));

    }
    public function vacancyshow($id){
        $submission = Submission::orderBy('created_at', 'desc')->with('post', 'post.translations', 'post.parent', 'post.parent.translations')->where('id', $id)->first();
        $submission->seen = 1;
        $submission->save();
        
        return view('admin.submissions_vacancy.show', compact(['submission']));

    }

    public function show($id){
        $submission = Submission::orderBy('created_at', 'desc')->with('post', 'post.translations', 'post.parent', 'post.parent.translations')->where('id', $id)->first();
        $submission->seen = 1;
        $submission->save();
        
        return view('admin.submissions.show', compact(['submission']));

    }
    public function destroy($id){
        Submission::where('id', $id)->delete();

        
        return back();

    }


    public function exportPostSubmission($id){
       
        $file_name = 'exportPostSubmission'.date('Y_m_d_H_i_s').'.xlsx';
        
        $submissions = Submission::where('post_id' , $id)->orderBy('created_at', 'desc')->get();
        
        return Excel::download(new exportPostSubmission($submissions), $file_name  );
      
    }

    public function export(){
        $file_name = 'collaborate'.date('Y_m_d_H_i_s').'.xlsx';
        if (isset(request()->all()['post_id'])) {
           
            $submissions = Submission::where('section_type_id', 7)->orderBy('created_at', 'desc')->where('post_id', request()->all()['post_id'])->with('post')->paginate(100);
        }
        else {
            $submissions = Submission::where('section_type_id',7)->orWhere('section_type_id', NULL)->orderBy('created_at', 'desc')->with('post')->paginate(100);
          
        }
        return Excel::download(new collaborateexport($submissions), $file_name  );
      
    }

    public function exportservice(){
        $file_name = 'exportservice'.date('Y_m_d_H_i_s').'.xlsx';
        if (isset(request()->all()['post_id'])) {
           
            $submissions = Submission::where('section_type_id', 6)->orderBy('created_at', 'desc')->where('post_id', request()->all()['post_id'])->with('post')->paginate(100);
        }
        else {
            $submissions = Submission::where('section_type_id', 6)->orderBy('created_at', 'desc')->with('post')->paginate(100);
        }
        return Excel::download(new ServiceExport($submissions), $file_name  );
      
    }
    public function exportcontact(){
        $file_name = 'exportcontact'.date('Y_m_d_H_i_s').'.xlsx';
        if (isset(request()->all()['post_id'])) {
           
            $submissions = Submission::orderBy('created_at', 'desc')->where('post_id', request()->all()['post_id'])->with('post')->paginate(10);
        }
        else {
           
            $submissions = Submission::where('section_type_id',4)->orWhere('section_type_id', NULL)->orderBy('created_at', 'desc')->with('post')->paginate(100);
            
        }
        return Excel::download(new ContactExport($submissions), $file_name  );
      
    }
    public function vacancyexport(){
        $file_name = 'vacancyexport'.date('Y_m_d_H_i_s').'.xlsx';
        if (isset(request()->all()['post_id'])) {
           
            $submissions = Submission::orderBy('created_at', 'desc')->where('post_id', request()->all()['post_id'])->with('post')->get();
        }
        else {
           
            $submissions = Submission::where('section_type_id',3)->orWhere('section_type_id', NULL)->orderBy('created_at', 'desc')->with('post')->get();
            
        }
        return Excel::download(new VacancyExport($submissions), $file_name  );
      
    }
}
