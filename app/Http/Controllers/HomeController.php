<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
 use App\Pages;
use App\Manufacturers;
use App\ProductGroups;
use App\Images;
use App\Files;
use App\Products;
use App\Orders;
use App\LicenseProducts;
use App\LicensePackages;
use App\CallQueries;
use App\Feedback;
use App\RelatedProducts;
use Mail;
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

    public function error()
    {
        return view('admin.error', [
            'layout_path' => 'public/adminlte',
        ]);
    }

    public function stats()
    {
        Session::put('active', 'stats');
        return view('admin/statistics', [
            'layout_path' => 'public/adminlte',
        ]);
    }

    public function orders()
    {
        $order = new Orders();
        $orders = $order->all();
        $order->where('seen', '0')->update(['seen' => '1']);
        foreach ($orders as $order) {
            if ($order->email_status == '0') {
                $order->data1 = [
                    'status' => 'primary',
                    'text' => 'Не отправлено',
                ];
            } elseif ($order->email_status == '1') {
                $order->data1 = [
                    'status' => 'success',
                    'text' => 'Отправлено',
                ];
            }
            if ($order->status == '0') {
                $order->data2 = [
                    'status' => 'danger',
                    'text' => 'Отказ',
                ];
            } elseif ($order->status == '1') {
                $order->data2 = [
                    'status' => 'warning',
                    'text' => 'Ожидание',
                ];
            } elseif ($order->status == '2') {
                $order->data2 = [
                    'status' => 'success',
                    'text' => 'Оплачен',
                ];
            }

        }
        Session::put('active', 'orders');
        return view('admin/orders', [
            'layout_path' => 'public/adminlte',
            'orders' => $orders,

        ]);
    }

    public function edit_order($id)
    {
        $orders = new Orders();
        $order = $orders->findOrFail($id);
        $product = new Products();
        $prod = $product->find($order->product_id);
        $order->product_id = $prod->id;
        $order->data_email = [
            'send' => "Отправить",
            'description' => "Отправить документы на эл. почту заказчика.",
            'checked' => ''
        ];
        if ($order->email_status == '1') {
            $order->data_email = [
                'send' => "Отправить еще раз",
                'description' => "Документы уже отправлены на эл. почту заказчика.",
                'checked' => '<div style="color:green" class="fa fa-check-square-o"></div>'
            ];
        }
        $order->data_payment = [
            'send' => "Отправить",
            'description' => "Отправить счет для оплаты услуг на эл. почту заказчика.",
            'checked' => ''
        ];
        if ($order->payment_to_email == "1") {
            $order->data_payment = [
                'send' => "Отправить еще раз",
                'description' => "Счет для оплаты услуг уже отправлен на эл. почту заказчика.",
                'checked' => '<div style="color:green" class="fa fa-check-square-o"></div>',
            ];
        }
        $related = new RelatedProducts();
        $related_product_ids = json_decode($order->related_product_id);
        $related_product_counts = json_decode($order->related_count);

        if($related_product_ids){
             foreach ($related_product_ids as $key => $id) {
                $relateds[] = $related->find($id);
                $rel_counts[] = $related_product_counts[$key];
            }
        }
        else {
            $relateds = [];
            $rel_counts = [];
        }
       
        return view('admin/edit_order', [
            'layout_path' => 'public/adminlte',
            'order' => $order,
            'related_products' => $relateds,
            'rel_counts' => $rel_counts,

        ]);
    }

    public function update_order(Request $request)
    {
        $order = new Orders();
        $this->validate($request, [
        ]);

        $update_to = [
            'name' => $request->input('name'),
            'tel' => $request->input('tel'),
            'from_date' => htmlspecialchars($request->input('from_date')),
            'to_date' => htmlspecialchars($request->input('to_date')),
            'product_name' => htmlspecialchars($request->input('product_name')),
            'product_price' => $request->input('product_price'),
            'related_price' => $request->input('related_price') ? $request->input('related_price') : 0,
            'email' => htmlspecialchars($request->input('email')),
            'address' => htmlspecialchars($request->input('address')),
            'company_name' => htmlspecialchars($request->input('company_name')),
            'time' => htmlspecialchars($request->input('time')),
            'delivery_type' => $request->input('delivery_type') ? $request->input('delivery_type') : '1',
            'delivery_fee' => $request->input('delivery_fee'),
            'pay_type' => $request->input('pay_type'),
            'total_amount' => $request->input('total_amount'),
            'date' => htmlspecialchars($request->input('date')),
            'status' => $request->input('status'),
        ];
        $order->find($request->id)->update($update_to);
        return redirect()->action('HomeController@orders');
    }

    public function delete_order($id)
    {
        $order = new Orders();
        $order->findOrFail($id)->delete();
        Session::flash('success', 'Успешно удалено.');
        return redirect()->action('HomeController@orders');
    }


    public function pages()
    {
        $page = new Pages();
        $pages = $page->all();
        Session::put('active', 'pages');

        return view('admin/pages', [
            'layout_path' => 'public/adminlte',
            'pages' => $pages
        ]);
    }

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


    public function call_queries()
    {
        $allQueries = new CallQueries();
        $allQueries->where('seen', '0')->update(['seen' => '1']);
        $callQueries = $allQueries->orderBy('id', 'desc')->get();
        Session::put('active', 'call_queries');
        return view('admin/call_queries', [
            'layout_path' => 'public/adminlte',
            'callQueries' => $callQueries,
        ]);
    }

    public function update_callQuery($id)
    {
        $query = new CallQueries();
        $that = $query->findOrFail($id);
        $update_to = ($that->status == '0') ? '1' : '0';
        $that->update(array('status' => $update_to));
        return redirect()->action('HomeController@call_queries');
    }


    public function feedback()
    {
        $feed = new Feedback();
        $feed->where('seen', '0')->update(['seen' => '1']);
        $feedback = $feed->orderBy('id', 'desc')->get();
        $products = new Products();
        foreach ($feedback as $feed) {
            $product = $products->find($feed->product_id);
            if ($product)
                $feed->product = $product->name;
        }
        Session::put('active', 'feedback');
        return view('admin/feedback', [
            'layout_path' => 'public/adminlte',
            'feedback' => $feedback
        ]);
    }

    public function edit_feedback($id)
    {
        $feed = new Feedback();
        $feedback = $feed->findOrFail($id);
        $products = new Products();
        $product = $products->find($feedback->product_id);
        if ($product)
            $feedback->product = $product->name;
        return view('admin/edit_feedback', [
            'layout_path' => 'public/adminlte',
            'feedback' => $feedback,
        ]);
    }

    public function update_feedback(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
        ]);
        $feedback = new Feedback();
        $update_to = [
            'username' => $request->input('username'),
            'message' => $request->input('message'),
            'position' => $request->input('position'),
        ];
        $feedback->findOrFail($request->id)->update($update_to);
        Session::flash('success', 'Изменения были успешно внесены.');

        return redirect()->action('HomeController@feedback');
    }

    public function delete_feedback($id)
    {
        $feedback = new Feedback();
        $feedback->findOrFail($id)->delete();
        Session::flash('success', 'Комментарий успешно удален.');
        return redirect()->action('HomeController@feedback');
    }


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

    public function delete_image($id, $path_name)
    {

        $img = new Images();
        $image = $img->findOrFail($id);
        $name = $image->name;
        $image->delete();
        if ($name != '' && File::exists('public/' . $path_name . '/' . $name)) {
            unlink('public/' . $path_name . '/' . $name);
        }
        Session::flash('success', 'Изображение успешно удалено.');
        return redirect()->back();
    }


    public function order_check()
    {

        $order = new Orders();
        $order_count = $order->where('seen', '=', '0')->count();
        if ($order_count > 0) {
            return $order_count;
        }
    }

    public function call_check()
    {
        $call = new CallQueries();
        $call_count = $call->where('seen', '=', '0')->count();
        if ($call_count > 0) {
            return $call_count;
        }
    }

    public function feedback_check()
    {
        $feedback = new Feedback();
        $feedback_count = $feedback->where('seen', '=', '0')->count();
        if ($feedback_count > 0) {
            return $feedback_count;
        }
    }

    public function check_all(Request $request)
    {
        while (1) {
            $check = [
                'order' => $this->order_check(),
                'call' => $this->call_check(),
                'feedback' => $this->feedback_check(),
            ];
            if ($this->order_check() - $request->order !== 0 ||
                $this->call_check() - $request->call !== 0 ||
                $this->feedback_check() - $request->feedback !== 0) {
                $check = json_encode($check);
                return $check;
            }
            sleep(10);
        }
    }

    public function sendDocs(Request $request)
    {
        $data = $request->all();
        $file = new Files();
        $files = $file->where('product_id', $request->id)->get();
        $order = new Orders();
        if (count($files) > 0) {
            Mail::send('emails.document', ['data' => $data], function ($message) use ($request, $files) {
                $message->to($request->email);
                $message->subject('СтомАренда.ру');
                $message->from('info@stomarenda.ru');
                foreach ($files as $file) {
                    if (File::exists($file->path . '/' . $file->name)) {
                        $message->attach(url($file->path . '/' . $file->name));
                    } else {
                        Session::flash('error', 'Документы для даного оборудования не найдены');
                        return redirect()->back();
                    }
                }
            });
            $order->find($request->order_id)->update(['email_status' => '1']);
            Session::flash('success', 'Документы были успешно отправлены.');
        } else {
            Session::flash('error', 'Документы для даного оборудования не добавлены');
        }
        return redirect()->back();
    }

    public function sendRoboCheck(Request $request)
    {
        $data = $request->all();
        $data['days'] = (int)(((strtotime($request->to_date) - strtotime($request->from_date)) / (24 * 3600)) + 1);
        
        $related_products = new RelatedProducts();
        $data['one_product_price'] = $request->product_price;
        $ids = json_decode($request->related_product_id);
        $counts = json_decode($request->related_count);
        $data['related_product'] = [];
        foreach ($ids as $key => $id) {
            $related_prod = $related_products->find($id);
            $related_prod->setAttribute('related_count', $counts[$key]);
            array_push($data['related_product'], $related_prod);
        }
        $order = new Orders();
        $order->find($request->id)->update(['payment_to_email' => '1']);
        Mail::send('emails.pay_check', ['data' => $data], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('СтомАренда.ру');
            $message->from('info@stomarenda.ru');
        });
        Session::flash('success', 'Чек был успешно выставлен.');

        return redirect()->back();
    }
}
