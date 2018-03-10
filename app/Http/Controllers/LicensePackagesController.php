<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\LicensePackages;
use Validator;
use File;

class LicensePackagesController extends Controller
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
     

 public function license_packages()
    {
        $package = new LicensePackages();
        $packages = $package->all();
        Session::put('active', 'license_packages');
        return view('admin/license_packages', [
            'layout_path' => 'public/adminlte',
            'packages' => $packages
        ]);
    }

    public function create_licensePackages()
    {
        return view('admin/create_license_package', [
            'layout_path' => 'public/adminlte',
        ]);
    }

    public function add_licensePackages(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:license_packages'
        ]);
        $package = new LicensePackages();
        $package->name = $request->input('name');
        $package->information = $request->input('information');
        $package->price = $request->input('price');
        $package->title = $request->input('title');
        $package->meta_description = $request->input('meta_desc');
        $package->slug = $request->input('slug');

        $package->image = "";
        if ($request->image) {
            $package->image = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('images-licensepack'), $package->image);
        }
        $package->save();
        Session::flash('success', 'Добавлен новый пакет.');
        return redirect()->action('HomeController@license_packages');
    }

    public function edit_licensePackage($id)
    {
        $package = new LicensePackages();
        $license_package = $package->findOrFail($id);
        return view('admin/edit_license_package', [
            'layout_path' => 'public/adminlte',
            'package' => $license_package,
        ]);
    }


    public function update_licensePackage(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:license_packages,slug,'.$request->id
        ]);
        $packages = new LicensePackages();
        $package = $packages->findOrFail($request->id);
        if ($request->image != NULL) {
            $old_img_name = $package->image;
            $image = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('images-licensepack'), $image);
            if ($old_img_name != '' && File::exists('public/images-licensepack/' . $old_img_name)) {
                unlink('public/images-licensepack/' . $old_img_name);
            }
            $update_to = [
                'name' => $request->input('name'),
                'information' => $request->input('information'),
                'price' => $request->input('price'),
                'title' => $request->input('title'),
                'meta_description' => $request->input('meta_desc'),
                'slug' => $request->input('slug'),
                'image' => $image,

            ];
        } else {
            $update_to = [
                'name' => $request->input('name'),
                'information' => $request->input('information'),
                'price' => $request->input('price'),
                'title' => $request->input('title'),
                'meta_description' => $request->input('meta_desc'),
                'slug' => $request->input('slug'),
            ];
        }

        $package->update($update_to);
        Session::flash('success', 'Изменения были успешно внесены.');

        return redirect()->action('HomeController@license_packages');
    }

    public function delete_licensePackage($id)
    {
        $license_package = new LicensePackages();
        $package = $license_package->findOrFail($id);
        $image_name = $package->image;
        $package->delete();
        if ($image_name != '' && File::exists('public/images-licensepack/' . $image_name)) {
            unlink('public/images-licensepack/' . $image_name);
        }
        Session::flash('success', 'Успешно удалено.');
        return redirect()->action('HomeController@license_packages');
    }


    

}





