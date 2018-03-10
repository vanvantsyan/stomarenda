<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Products;
use Validator;
use File;

class ProductsController extends Controller
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
     
 public function products()
    {
        $product = new Products();
        $products = $product->all();
        $prodGroup = new ProductGroups();
        $manufacturers = new Manufacturers();
        foreach ($products as $product) {

            $group = $prodGroup->find($product->group_id);
            if ($group) {
                $product->groups = $group->name;
            }
            $manufacturer = $manufacturers->find($product->manufacturer_id);
            if ($manufacturer) {
                $product->manufacturer = $manufacturer->name;
            }

        }
        Session::put('active', 'products');
        return view('admin/products', [
            'products' => $products,
            'layout_path' => 'public/adminlte',
        ]);
    }

    public function create_product()
    {
        $group = new ProductGroups();
        $prodGroups = $group->get();
        $manufacturer = new Manufacturers();
        $manufacturers = $manufacturer->get();
        return view('admin/create_product', [
            'layout_path' => 'public/adminlte',
            'prodGroups' => $prodGroups,
            'manufacturers' => $manufacturers
        ]);
    }

    public function add_products(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'model' => 'required',
            'price' => 'required',
            'image' => 'image',
            'images.*' => 'image',
            'files.*' => 'mimes:pdf',
            'slug' => 'required|unique:products'
        ]);

        $product = new Products();
        $product->name = $request->input('name');
        $product->model = $request->input('model');
        $product->price = $request->input('price');
        $product->group_id = $request->input('group');
        $product->manufacturer_id = $request->input('manufacturer');
        $product->title = htmlspecialchars($request->input('title'));
        $product->meta_description = htmlspecialchars($request->input('meta_desc'));
        $product->slug = htmlspecialchars($request->input('slug'));
        $product->description = $request->input('description');
        $product->attributes = $request->input('attributes');
        $product->image = "";
        if ($request->image) {
            $product->image = $request->image->getClientOriginalName();
            $request->image->move(public_path('images-products'), $request->image->getClientOriginalName());
        }

        $product->save();
        $lastInsertId = $product->id;

        $images = $request->file('images');
        if ($images != NULL) {
            foreach ($images as $image) {
                $image_name = time() . $image->getClientOriginalName();
                $image->move(public_path('images-products'), $image_name);
                $img = new Images();
                $img->name = $image_name;
                $img->product_id = $lastInsertId;
                $img->save();
            }
        }
        $files = $request->file('files');
        if ($files != NULL) {
            foreach ($files as $file) {
                $file_name = $lastInsertId . '_' . time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('pdf'), $file_name);
                $pdf = new Files();
                $pdf->name = $file_name;
                $pdf->product_id = $lastInsertId;
                $pdf->path = 'public/pdf';
                $pdf->save();
            }
        }
        Session::flash('success', 'Продукт успешно добавлен.');
        return redirect()->action('HomeController@products');

    }

    public function edit_product($id)
    {
        $prodGroup = new ProductGroups();
        $prodGroups = $prodGroup->all();
        $manufacturer = new manufacturers();
        $manufacturers = $manufacturer->all();
        $product = new Products();
        $edit_product = $product->findOrFail($id);
        $image = new Images();
        $images = $image->where('product_id', $id)->get();
        $file = new Files();
        $files = $file->where('product_id', $id)->get();
        return view('admin/edit_product', [
            'layout_path' => 'public/adminlte',
            'prodGroups' => $prodGroups,
            'manufacturers' => $manufacturers,
            'product' => $edit_product,
            'images' => $images,
            'files' => $files
        ]);
    }

    public function update_product(Request $request)
    {
        $product = new Products();
        $prod = $product->findOrFail($request->id);
        $old_img_name = $prod->image;
        $this->validate($request, [
            'image' => 'image',
            'images.*' => 'image',
            'files.*' => 'mimes:pdf',
            'slug' => 'required|unique:products,slug,'.$request->id
        ]);
        if ($request->image != NULL) {
            $file_name = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('images-products'), $file_name);
            if ($old_img_name != '' && File::exists('public/images-products/' . $prod->image)) {
                unlink('public/images-products/' . $prod->image);
            }
            $update_to = [
                'name' => $request->name,
                'model' => $request->model,
                'price' => $request->price,
                'manufacturer_id' => $request->manufacturer_id,
                'group_id' => $request->group_id,
                'title' => $request->title,
                'meta_description' => $request->meta_desc,
                'slug' => $request->slug,
                'description' => $request->description,
                'attributes' => $request->input('attributes'),
                'image' => $file_name
            ];
        } else {
            $update_to = [
                'name' => $request->name,
                'model' => $request->model,
                'price' => $request->price,
                'manufacturer_id' => $request->manufacturer_id,
                'group_id' => $request->group_id,
                'title' => $request->title,
                'meta_description' => $request->meta_desc,
                'slug' => $request->slug,
                'description' => $request->description,
                'attributes' => $request->input('attributes'),
            ];
        }
        if ($product->findOrFail($request->id)->update($update_to))
            Session::flash('success', 'Изменения удачно внесены.');

        $images = $request->file('images');
        if ($images != NULL) {
            foreach ($images as $image) {
                $image_name = time() . $image->getClientOriginalName();
                if ($image->move(public_path('images-products'), $image_name)) {
                    $img = new Images();
                    $img->name = $image_name;
                    $img->product_id = $request->id;
                    $img->save();
                } else {
                    Session::flash('error', 'Изображения  не загружены');
                }
            }
        }
        $files = $request->file('files');
        if ($files != NULL) {
            foreach ($files as $file) {
                $file_name = $request->id . '_' . time() . '_' . $file->getClientOriginalName();
                if ($file->move(public_path('pdf'), $file_name)) {
                    $pdf = new Files();
                    $pdf->name = $file_name;
                    $pdf->product_id = $request->id;
                    $pdf->path = 'public/pdf';
                    $pdf->save();
                } else {
                    return redirect()->back()->with('errors', 'Файл не загружен');
                }

            }
        }
        return redirect()->action('HomeController@products');
    }

    public function delete_product($id)
    {
        $product = new Products();
        $prod = $product->findOrFail($id);
        $image_name = $prod->image;
        $product->where('id', $id)->delete();
        if ($image_name != '' && File::exists('public/images-products/' . $image_name)) {
            unlink('public/images-products/' . $image_name);
        }
        $image = new Images();
        $images = $image->where('product_id', $id)->get();
        foreach ($images as $img) {
            if ($img->name != '' && File::exists('public/images-products/' . $img->name)) {
                unlink('public/images-products/' . $img->name);
            }
        }
        $image->where('product_id', $id)->delete();


        Session::flash('success', 'Успешно удалено.');
        return redirect()->action('HomeController@products');
    }

 

    

}





