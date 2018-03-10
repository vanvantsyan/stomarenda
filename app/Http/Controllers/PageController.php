<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Pages;
use Validator;
use File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
public function create_page()
     {
         return view('admin/create_page', [
             'layout_path' => 'public/adminlte',
         ]);
     }

     public function add_page(Request $request)
     {

         $this->validate($request, [
             'name' => 'required',
         ]);

         $page = new Pages();
         $page->name = $request->input('name');
         $page->title = $request->input('title');
         $page->meta_description = $request->input('meta-desc');
         $page->save();

         Session::flash('success', 'Успешно добавлено.');
         return redirect()->action('HomeController@pages');

     }

     public function edit_page($id)
     {
         $pages = new Pages();
         $edit_pages = $pages->findOrFail($id);

         return view('admin/edit_page', [
             'layout_path' => 'public/adminlte',
             'page' => $edit_pages
         ]);
     }

     public function update_page(Request $request)
     {
         $pages = new Pages();
         $this->validate($request, [
             'name' => 'required',
         ]);
         $update_to = [
             'title' => $request->input('title'),
             'meta_description' => $request->input('meta-desc'),
         ];
         $pages->findOrFail($request->id)->update($update_to);

         return redirect()->action('HomeController@pages');
     }

     public function delete_page($id)
     {
         $pages = new Pages();
         $pages->findOrFail($id)->delete();

         Session::flash('success', 'Успешно удалено.');
         return redirect()->action('HomeController@pages');
     }
}