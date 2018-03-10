<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\RelatedProducts;
use Validator;
use File;

class RelatedProductsController extends Controller
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
     

 
public function related_products()
    {
        $related_product = new RelatedProducts();
        $related_products = $related_product->get();
        $groups = new ProductGroups();
        $manufacturers = new Manufacturers();
        foreach ($related_products as $related_product) {
            $group = $groups->find($related_product->group_id);
            $manufacturer = $manufacturers->find($related_product->manufacturer_id);
            if ($group)
                $related_product->group = $group->name;
            if ($manufacturer)
                $related_product->manufacturer = $manufacturer->name;
        }

        Session::put('active', 'related_products');
        return view('admin/related_products', [
            'layout_path' => 'public/adminlte',
            'related_products' => $related_products
        ]);
    }

    public function create_relatedProduct()
    {
        $group = new ProductGroups();
        $groups = $group->get();
        $manufacturer = new Manufacturers();
        $manufacturers = $manufacturer->get();
        return view('admin/create_related_product', [
            'layout_path' => 'public/adminlte',
            'groups' => $groups,
            'manufacturers' => $manufacturers
        ]);
    }

    public function add_relatedProduct(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
        ]);
        $related_product = new RelatedProducts();
        $related_product->name = $request->input('name');
        $related_product->model = $request->input('model');
        $related_product->manufacturer_id = $request->input('manufacturer_id');
        $related_product->group_id = $request->input('group_id');
        $related_product->price = $request->input('price');
        $related_product->image = "";
        if ($request->image) {
            $related_product->image = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('images-related'), $related_product->image);
        }
        $related_product->save();
        Session::flash('success', 'Добавлен новый сопутствующий товар.');
        return redirect()->action('HomeController@related_products');
    }

    public function edit_relatedProduct($id)
    {
        $relatedProduct = new RelatedProducts();
        $relatedProducts = $relatedProduct->findOrFail($id);
        $group = new ProductGroups();
        $groups = $group->get();
        $manufacturer = new Manufacturers();
        $manufacturers = $manufacturer->get();
        return view('admin/edit_related_product', [
            'layout_path' => 'public/adminlte',
            'relatedProduct' => $relatedProducts,
            'groups' => $groups,
            'manufacturers' => $manufacturers
        ]);
    }

    public function update_relatedProduct(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $related_products = new RelatedProducts();
        $related_product = $related_products->findOrFail($request->id);
        if ($request->image != NULL) {
            $old_img_name = $related_product->image;
            $image = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('images-related'), $image);
            if ($old_img_name != '' && File::exists('public/images-related/' . $old_img_name)) {
                unlink('public/images-related/' . $old_img_name);
            }
            $update_to = [
                'name' => $request->input('name'),
                'model' => $request->input('model'),
                'manufacturer_id' => $request->input('manufacturer_id'),
                'group_id' => $request->input('group_id'),
                'price' => $request->input('price'),
                'image' => $image
            ];
        } else {
            $update_to = [
                'name' => $request->input('name'),
                'model' => $request->input('model'),
                'manufacturer_id' => $request->input('manufacturer_id'),
                'group_id' => $request->input('group_id'),
                'price' => $request->input('price'),
            ];
        }

        $related_product->findOrFail($request->id)->update($update_to);
        Session::flash('success', 'Изменения были внесены успешно.');

        return redirect()->action('HomeController@related_products');
    }

    public function delete_relatedProduct($id)
    {
        $relatedProducts = new RelatedProducts();
        $product = $relatedProducts->findOrFail($id);
        $image_name = $product->image;
        $product->delete();
        if ($image_name != '' && File::exists('public/images-licensepack/' . $image_name)) {
            unlink('public/images-related/' . $image_name);
        }
        Session::flash('success', 'Успешно удалено.');
        return redirect()->action('HomeController@related_products');
    }
    

}





