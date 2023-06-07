<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\BookNow;
use Illuminate\Http\Request;

class BookNowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Bookservices = BookNow::all();
        dd($Bookservices);
        return view('admin.booknow.index', compact(['Bookservices']));
    }

    public function show($id)
    {
        $Bookservices = BookNow::orderBy('created_at', 'desc')->with('post', 'post.translations', 'post.parent', 'post.parent.translations')->where('id', $id)->first();
        $Bookservices->seen = 1;
        $Bookservices->save();
        
        return view('admin.BookNow.show', compact(['submission']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BookNow::where('id', $id)->delete();

        
        return back();
    }
}
