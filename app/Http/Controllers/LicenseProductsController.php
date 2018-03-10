<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\LicenseProducts;
use Validator;
use File;

class LicenseProductsController extends Controller
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
     

 
  public function license_products()
    {
        $product = new LicenseProducts();
        $products = $product->all();
        Session::put('active', 'license_products');
        return view('admin/license_products', [
            'layout_path' => 'public/adminlte',
            'products' => $products
        ]);
    }

    public function create_licenseProducts()
    {
        return view('admin/create_license_product', [
            'layout_path' => 'public/adminlte',
        ]);
    }


    public function add_licenseProducts(Request $request)
    {
        foreach ($request->name as $key => $val) {
            $have = intval((isset($request->have[$key])) ? $request->have[$key] : 0);
            $price = ($request->price[$key] == "") ? 0 : $request->price[$key];
            $product_list[] = [
                'name' => $val,
                'price' => $price,
                'have' => $have
            ];
        }

        $product_list = json_encode($product_list, JSON_UNESCAPED_UNICODE);

        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:license_products'
        ]);
        $product = new LicenseProducts();
        $product->type_name = $request->input('type_name');
        $product->title = $request->input('title');
        $product->meta_description = $request->input('meta_desc');
        $product->slug = $request->input('slug');
        $product->product_info = $product_list;
        $product->image = "";
        if ($request->image) {
            $product->image = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('images-licenseprod'), $product->image);
        }

        $product->save();
        Session::flash('success', 'Добавлен новый список оборудований для лицензирования.');
        return redirect()->action('HomeController@license_products');
    }

    public function edit_licenseProduct($id)
    {
        $product = new LicenseProducts();
        $license_product = $product->findOrFail($id);
        $license_product_info = json_decode($license_product->product_info);
        return view('admin/edit_license_product', [
            'layout_path' => 'public/adminlte',
            'products' => $license_product,
            'license_product_info' => $license_product_info
        ]);
    }

    public function update_licenseProduct(Request $request)
    {
        foreach ($request->name as $key => $val) {
            $have = intval((isset($request->have[$key])) ? $request->have[$key] : 0);
            $product_list[] = [
                'name' => $val,
                'price' => $request->price[$key],
                'have' => $have
            ];
        }
        $product_list = json_encode($product_list, JSON_UNESCAPED_UNICODE);

        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:license_products,slug,'.$request->id
        ]);
        $products = new LicenseProducts();
        $product = $products->findOrFail($request->id);
        if ($request->image != NULL) {
            $old_img_name = $product->image;
            $image = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('images-licenseprod'), $image);
            if ($old_img_name != '' && File::exists('public/images-licenseprod/' . $old_img_name)) {
                unlink('public/images-licenseprod/' . $old_img_name);
            }
            $update_to = [
                'type_name' => $request->input('type_name'),
                'title' => $request->input('title'),
                'meta_description' => $request->input('meta_desc'),
                'slug' => $request->input('slug'),
                'product_info' => $product_list,
                'image' => $image
            ];
        } else {
            $update_to = [
                'type_name' => $request->input('type_name'),
                'title' => $request->input('title'),
                'meta_description' => $request->input('meta_desc'),
                'slug' => $request->input('slug'),
                'product_info' => $product_list,
            ];
        }
        $product->update($update_to);

        Session::flash('success', 'Изменения были успешно внесены.');
        return redirect()->action('HomeController@license_products');
    }

    

}





