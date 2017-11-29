<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PharIo\Manifest\License;
use Session;
use App\Manufacturers;
use App\Pages;
use App\ProductGroups;
use App\Images;
use App\Products;
use App\Orders;
use App\LicenseProducts;
use App\LicensePackages;
use App\CallQueries;
use App\Feedback;
use App\RelatedProducts;

class FrontController extends Controller
{
    public function index()
    {
        $pages = new Pages();
        $page = $pages->find(1);
        $group = new ProductGroups;
        $groups = $group->get();
        foreach ($groups as $group) {
            if ($group->id == 3) {
                $name = $group->name;
                if (($pos = strpos($name, " ")) !== false) {
                    $group->name = substr($name, 0, $pos + 1) . "<br />" . substr($name, $pos + 1);
                }
            }
        }
        $manufacturer = new Manufacturers;
        $manufacturers = $manufacturer->all();
        return view('site.index', [
            'layout_path' => 'public',
            'groups' => $groups,
            'manufacturers' => $manufacturers,
            'page' => $page
        ]);
    }

    public function packages()
    {
        $pages = new Pages();
        $page = $pages->find(5);
        $package = new LicensePackages();
        $packages = $package->all();
        foreach ($packages as $package) {
            $pieces = explode(" ", $package->information);
            $first_part = implode(" ", array_splice($pieces, 0, 8));
            $package->information = $first_part . '...';
        }

        return view('site.packages', [
            'layout_path' => 'public',
            'packages' => $packages  ,
            'page' => $page

        ]);
    }

    public function package($slug)
    {
        $packages = new LicensePackages();
        $package = $packages->whereSlug($slug)->first();

        return view('site.package', [
            'layout_path' => 'public',
            'package' => $package,
        ]);
    }

    public function licenseProducts()
    {
        $pages = new Pages();
        $page = $pages->find(4);
        $licenseProduct = new LicenseProducts();
        $licenseProducts = $licenseProduct->all();
        foreach ($licenseProducts as $key => $licenseProduct) {
            $licenseProduct->color = 'light';
            if ($key == 0 || $key == 2 || $key == 5 || $key == 7 || $key == 8 || $key == 10) {
                $licenseProduct->color = 'dark';
            }
        }
        return view('site.licenseproducts', [
            'layout_path' => 'public',
            'licenseProducts' => $licenseProducts   ,
            'page' => $page

        ]);
    }

    public function licenseProduct($slug)
    {
        $products = new LicenseProducts();
        $product = $products->whereSlug($slug)->first();
        $license_product_info = json_decode($product->product_info);
        foreach ($license_product_info as $info) {
            if ($info->have == '1') {
                $have = "Есть";
                $purchase = true;
            } else if ($info->have == '0') {
                $have = "Нет";
                $purchase = false;
            }
            $info->have = $have;
            $info->purchase = $purchase;
        }

        return view('site.licenseProduct', [
            'layout_path' => 'public',
            'product' => $product,
            'license_product_info' => $license_product_info
        ]);



    }

    public function add_call_query(Request $request)
    {
        $call = new CallQueries();
        $this->validate($request, [
            'name' => 'required|alpha',
            'tel' => 'required|numeric|min:5'
        ]);
        $call->name = htmlspecialchars($request->input('name'));
        $call->tel = htmlspecialchars($request->input('tel'));
        if ($call->save()) {
            return 'Мы вам перезвоним за короткое время.';
        }
    }

    public function category($slug)
    {
        $groups = new ProductGroups;
        $group = $groups->whereSlug($slug)->first();
        $id = $group->id;
        $pages = new Pages();
        if($id == 1)
            $page_id = 3;
        else if($id == 2)
            $page_id = 2;
        $page = $pages->find($page_id);

        $product = new Products;
        $products = $product->where('group_id', $id)->get();
        $manufacture = new Manufacturers;
        $manufacturers = $manufacture->all();
        foreach ($products as $product) {
            $manufacturer = $manufacture->find($product->manufacturer_id);
            if ($manufacturer) {
                $product->manufacturer = $manufacturer->name;
                $product->country = $manufacturer->country;
            }
        }
        $related_product = new RelatedProducts();
        $related_products = $related_product->where('group_id', $id)->take(4)->get();
        foreach ($related_products as $related_product) {
            $manufacturer = $manufacture->find($product->manufacturer_id);
            if ($manufacturer) {
                $related_product->manufacturer = $manufacturer->name;
                $related_product->country = $manufacturer->country;
            }
        }

        foreach ($related_products as $key => $related_product) {
                if ($key == 1 || $key == 3 ) {
                    $background = 'light';
                }
                else{
                    $background = 'dark';
                }

                $related_product->background = $background;

        }
        return view('site.category', [
            'layout_path' => 'public',
            'products' => $products,
            'manufacturers' => $manufacturers,
            'group' => $group,
            'related_products' => $related_products,
            'page' => $page
        ]);
    }

    public function add_feedback(Request $request)
    {

        $feedback = new Feedback();
        $this->validate($request, [
            'username' => 'required|alpha|min:3',
            'position' => 'required|alpha|min:3',
            'message' => 'required|min:3'
        ]);
        $feedback->product_id = $request->input('product_id');
        $feedback->username = htmlspecialchars($request->input('username'));
        $feedback->position = htmlspecialchars($request->input('position'));
        $feedback->message = htmlspecialchars($request->input('message'));
        if ($feedback->save()) {
            echo 'Спасибо за оставленный отзыв . Ваше мнение очень важно для нас.';
        }

    }

    public function product($slug)
    {
        $products = new Products;
        $product = $products->whereSlug($slug)->first();
        $id =  $product->id;
        $groups = new ProductGroups();
        $group = $groups->find($product->group_id);
        $product->group = $group->name;
        $related_products = new RelatedProducts();
        $related_product = $related_products->find($id);
        $feed = new Feedback();
        $feedback = $feed->where('product_id', $id)->get();
        $manufacture = new Manufacturers();
        $manufacturer = $manufacture->find($product->manufacturer_id);
        $image = new Images();
        $images = $image->where('product_id', $id)->limit(2)->get();
        if ($manufacturer) {
            $product->manufacturer = $manufacturer->name;
            $product->country = $manufacturer->country;
            $product->about_brand = $manufacturer->information;
        }
        return view('site.product', [
            'layout_path' => 'public',
            'product' => $product,
            'related_product' => $related_product,
            'feedback' => $feedback,
            'images' => $images,
        ]);
    }

    public function card($product_type, $slug, Request $request)
    {
        if ($product_type == 'products') {
            $products = new Products;
            $product = $products->whereSlug($slug)->first();
            $product->name = $product->name . ' ' . $product->model;
            $product->type = $product_type;
            $product->image_path = 'products';
            $related_product = new RelatedProducts();
            $related_products = $related_product->where('group_id', $product->group_id)->get();
        }
        else if ($product_type == 'packages') {
            $products = new LicensePackages();
            $product = $products->whereSlug($slug)->first();
            $product->type = $product_type;
            $product->image_path = 'licensepack';
            $related_products = "";
        }

        return view('site.card', [
            'layout_path' => 'public',
            'product' => $product,
            'related_products' => $related_products,
        ]);
    }

    public function licProd_card(Request $request)
    {
        $products = new LicenseProducts();
        $product = $products->findOrFail($request->id);
        $product->name = $product->type_name;
        $product->price = $request->total_lprod_amount;
        $product->type = 'license-products';
        $product->image_path = 'licenseprod';
        $related_product = "";

        return view('site.card', [
            'layout_path' => 'public',
            'product' => $product,
            'related_product' => $related_product,
        ]);
    }

    public function add_order(Request $request)
    {

        $order = new Orders();
        $this->validate($request, [
            'name' => 'required|alpha|min:3',
            'email' => 'required|email',
            'tel' => 'required',
        ]);
        $products = new Products();
        $lic_products = new LicenseProducts();
        $lic_packages = new LicensePackages();
        $days = 1;
        if($request->input('product_type') == 'products'){
            $product = $products->findOrFail($request->input('product_id'));
            $days =  (int)((strtotime($request->input('to_date'))-strtotime($request->input('from_date')))/(3600*24))+1;
            $product_total_price = $days*$product->price ;

        }
        else if($request->input('product_type') == 'license-products'){
            $product_total_price = $request->product_price;
        }
        else if($request->input('product_type') == 'packages'){
            $product =  $lic_packages->findOrFail($request->input('product_id'));
            $product_total_price = $product->price;
        }

        $delivery_fee = ($request->input('delivery_fee') == 'in')? 1000 : 0;
        $related_product = new RelatedProducts();
        $related = 0;
        $related_count = [];
        $related_ids = [];
        $related_total_price = 0;
        if($request->input('related_product_id')){
            $related_ids = $request->input('related_product_id');
            foreach($request->input('related_product_id') as $id){
                $related = $related_product->findOrFail($id);
                $input_name = 'related_count'.$id;
                $related_count[] = (int)$request->input($input_name);
                $related_total_price =$related_total_price+( (int)$request->input($input_name) * $related->price);
            }
        }
        $total_amount = (int)($related_total_price+$product_total_price+$delivery_fee);


        $order->name = htmlspecialchars($request->input('name'));
        $order->product_name = htmlspecialchars($request->input('product_name'));
        $order->product_id = $request->input('product_id');
        $order->product_price = $product_total_price;
        $order->product_type = htmlspecialchars($request->input('product_type'));
        $order->related_count = json_encode($related_count);
        $order->related_price = $related_total_price;
        $order->related_product_id = json_encode($related_ids);
        $order->tel = htmlspecialchars($request->input('tel'));
        $order->email = htmlspecialchars($request->input('email'));
        $order->company_name = htmlspecialchars($request->input('company_name'));
        $order->from_date = htmlspecialchars($request->input('from_date'));
        $order->to_date = htmlspecialchars($request->input('to_date'));
        $order->time = htmlspecialchars($request->input('time'));
        $order->delivery_type = ($request->input('delivery') != null)?$request->input('delivery'):'1';
        $order->delivery_fee = $delivery_fee;
        $order->address = htmlspecialchars($request->input('address'));
        $order->pay_type = htmlspecialchars($request->input('payment'));
        $order->total_amount = $total_amount;
        $order->payed_amount = 0;
        $order->payed_time = "";
        $order->date = date('d.m.Y H:i');
        $order->status = '1';
        $order->seen = '0';
        if ($order->pay_type == '2') {
            Session::flash('pay_message', 'После подтверждения заказа администрацией , на вашу эл. почту будет выслана ссылка для онлайн оплаты заказа.`');
        }
        if ($order->save()) {
            return redirect()->action('FrontController@confirmation');
        }

    }

    public function confirmation()
    {

        $pay_message = ((Session::has('pay_message'))) ? (Session::get('pay_message')) : "";
        return view('site.confirmation', [
            'text_all' => 'Мы свяжемся с вами в течении 10 минут.',
            'text_online' => $pay_message,
            'layout_path' => 'public',
        ]);
    }
    public function success(Request $request)
    {
        $mrh_pass1 = "KQ6kYKO73Hu04kOxtOUu";
        $out_summ = $request->OutSum;
        $inv_id = $request->InvId;
        $shp_item = $request->Shp_item;
        $crc = $request->SignatureValue;
        $crc = strtoupper($crc);
        $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item"));
        if ($my_crc != $crc)
        {
            return view('site.error', [
                'paymenError' => 'При попытке оплаты счета произошла ошибка .',
                'layout_path' => 'public',
            ]);
        }else {
            $order = new Orders();
            $order->where('id',$inv_id)->update([
                'status' => '2',
                'payed_amount' => $out_summ,
                'payed_time' => date('Y-m-d H:i:s', time())
            ]);
            return view('site.result', [
                'action' => 'Счет успешно оплачен',
                'text_all' => 'Мы свяжемся с вами в течении 10 минут.',
                'color' => "",
                'layout_path' => 'public',
            ]);
        }
    }
    public function fail()
    {
        return view('site.result', [
            'action' => 'Вы отказались от оплаты.',
            'text_all' => '',
            'color' => "",
            'layout_path' => 'public',
        ]);
    }

    public function error()
    {
        return view('site.error', [
            'layout_path' => 'public',
        ]);
    }


}