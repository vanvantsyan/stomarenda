<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Orders;
use Validator;
use File;

class OrdersController extends Controller
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
}