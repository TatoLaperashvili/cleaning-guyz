<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountAnswer;
use App\Models\Dictionarie;
use Illuminate\Support\Facades\Validator;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FormsController extends Controller
{
    public function index(Request $request)
    {
     
        $forms = Form::all();
     
        if ($request->has('name')) {
            $forms->where('name', 'LIKE', '%'.$request->get('name').'%');
        }
      
        return view('admin.forms.index',compact('forms'));
    }
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $formTypes = formTypes();
         
        return view('admin.forms.create',compact(['formTypes']));
    }
    public function store(Request $request)
    {
       
        $data = $request->validate([
			
            'title' => 'required',
           
		]);
       
       
        // Form Data
        $formData = [
            'name' => $request['name'],
            'title' =>  $data['title'],
            'email' =>  $request['email'],
        ];
       
        $form = Form::create($formData);
        
        if (isset($request['n_fields'])) {
            
            $formFieldsData = [];
            foreach ($request['n_fields'] as $key => $value) {
              
                $formFieldsData[$key] = [
                    'title' => $value['name'],
                    'type' => $value['type_id'],
                    'validation' => json_encode($value['validation']),
                    'data' => json_encode(['options' => $value['options'] ?? null]),
                    'form_id' => $form->id
                ];
               
            }
            
            
            FormField::insert($formFieldsData);
           
        }
        return Redirect::route('forms.index', [app()->getLocale()])->with('success', 'save successfully');
    }

public function edit($id){
   
    $form = Form::where('id', $id)->first();
   
    return view('admin.forms.update', compact(['form']));
}

public function update($id, Request $request){

    $values = $request->all();
    // dd($values);
   Validator::validate($values, [
           
            'title' => 'required',
           
          
   ]);
    FormField::where('form_id', $id)->delete();

    if (isset($values['n_fields'])) {
       
        $formFieldsData = [];
        foreach ($values['n_fields'] as $key => $value) {
        //    dd($value);
            $formFieldsData = [
                'title' => $value['name'],
                'type' => $value['type_id'],
                'validation' => json_encode($value['validation']),
                'data' => json_encode(['options' => $value['options'] ?? null]),
                'form_id' => $id
            ];
           
        FormField::insert($formFieldsData);
           
        }
      
    }
    $form = Form::find($id)->update($values);

    return redirect()->route('forms.index', [app()->getLocale()])->with('success', 'update successfully');

}


    public function destroy($id)
    {
        $form = Form::where('id', $id)->first();
           
        FormField::where('form_id', $form->id)->delete();
            $form->delete();
            DB::commit();

            return Redirect::route('forms.index', [app()->getLocale()])->with('delete', 'Delete successfully');

       
    }


}
