<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\ProductGroups;
use Validator;
use File;

class ProductGroupsController extends Controller
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
     

    public function productGroups()
    {
        $productGroup = new ProductGroups();
        $productGroups = $productGroup->all();
        Session::put('active', 'productGroups');
        return view('admin/product_groups', [
            'layout_path' => 'public/adminlte',
            'productGroups' => $productGroups
        ]);
    }

    public function create_productGroup()
    {
        return view('admin/create_group', [
            'layout_path' => 'public/adminlte',
        ]);
    }

    public function add_productGroup(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $productGroups = new ProductGroups();
        $productGroups->name = $request->input('name');
        $productGroups->image = "";
        if ($request->image) {
            $productGroups->image = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('images-prodgroups'), $productGroups->image);
        }

        $productGroups->save();

        Session::flash('success', 'Успешно добавлено');
        return redirect()->action('HomeController@productGroups');

    }

    public function edit_productGroup($id)
    {
        $productGroups = new ProductGroups();
        $group = $productGroups->findOrFail($id);

        return view('admin/edit_group', [
            'layout_path' => 'public/adminlte',
            'group' => $group
        ]);
    }

    public function update_productGroup(Request $request)
    {
        $productGroups = new ProductGroups();
        $productGroup = $productGroups->findOrFail($request->id);
        $old_img_name = $productGroup->image;
        $this->validate($request, [
            'name' => 'required',
        ]);
        if ($request->image != NULL) {
            $file_name = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('images-prodgroups'), $file_name);
            if ($old_img_name != '' && File::exists('public/images-prodgroups/' . $old_img_name)) {
                unlink('public/images-prodgroups/' . $old_img_name);
            }
            $update_to = [
                'name' => $request->input('name'),
                'image' => $file_name
            ];
        } else {
            $update_to = [
                'name' => $request->input('name'),
            ];
        }
        $productGroup->findOrFail($request->id)->update($update_to);
        return redirect()->action('HomeController@productGroups');
    }

    public function delete_productGroup($id)
    {
        $productGroups = new ProductGroups();
        $productGroups->findOrFail($id)->delete();
        Session::flash('success', 'Успешно удалено.');
        return redirect()->action('HomeController@productGroups');
    }

    

}