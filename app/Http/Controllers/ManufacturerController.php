<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Manufacturers;
use Validator;
use File;

class ManufacturersController extends Controller
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
     

    public function manufacturers()
    {
        $manufacturer = new Manufacturers();
        $manufacturers = $manufacturer->all();
        Session::put('active', 'manufacturers');
        return view('admin/manufacturers', [
            'layout_path' => 'public/adminlte',
            'manufacturers' => $manufacturers
        ]);
    }

    public function create_manufacturer()
    {
        return view('admin/create_manufacturer', [
            'layout_path' => 'public/adminlte',
        ]);
    }

    public function add_manufacturer(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'country' => 'required',
            'information' => 'required',
            'image' => 'required',
        ]);
        $manufacturer = new Manufacturers();
        $manufacturer->name = $request->input('name');
        $manufacturer->information = $request->input('information');
        $manufacturer->country = $request->input('country');
        $manufacturer->image = "";
        if ($request->image) {
            $manufacturer->image = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('images-manuf'), $manufacturer->image);
        }
        $manufacturer->save();

        Session::flash('success', 'Производитель успешно добавлен.');
        return redirect()->action('HomeController@manufacturers');

    }

    public function edit_manufacturer($id)
    {
        $manufacturer = new Manufacturers();
        $edit_manufacturer = $manufacturer->findOrFail($id);

        return view('admin/edit_manufacturer', [
            'layout_path' => 'public/adminlte',
            'manufacturer' => $edit_manufacturer
        ]);
    }

    public function update_manufacturer(Request $request)
    {
        $manufacturers = new Manufacturers();
        $manufacturer = $manufacturers->findOrFail($request->id);
        $old_img_name = $manufacturers->image;
        $this->validate($request, [
            'name' => 'required',
        ]);
        if ($request->image != NULL) {
            $file_name = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('images-images-manuf'), $file_name);
            if ($old_img_name != '' && File::exists('public/images-manuf/' . $old_img_name)) {
                unlink('public/images-manuf/' . $old_img_name);
            }
            $update_to = [
                'name' => $request->input('name'),
                'information' => $request->input('information'),
                'country' => $request->input('country'),
                'meta_description' => $request->input('meta_description'),
                'image' => $file_name
            ];
        } else {
            $update_to = [
                'name' => $request->input('name'),
                'information' => $request->input('information'),
                'country' => $request->input('country'),
                'meta_description' => $request->input('meta_description'),
            ];
        }
        $manufacturers->findOrFail($request->id)->update($update_to);

        return redirect()->action('HomeController@manufacturers');
    }

    public function delete_manufacturer($id)
    {
        $manufacturer = new Manufacturers();
        $manufacturer->findOrFail($id)->delete();

        Session::flash('success', 'Успешно удалено.');
        return redirect()->action('HomeController@manufacturers');
    }

}