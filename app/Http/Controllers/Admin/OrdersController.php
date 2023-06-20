<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Validator,Redirect,Response,File;
use Illuminate\Support\Carbon;
class OrdersController extends Controller
{
    function index(Request $request)
    {
        if(request()->ajax()) {
            $data = Order::orderBy('id', 'DESC')
            ->get();
            return DataTables()->of($data)
                ->addColumn('action', function($data){
                    return '<a href="'.url('admin/orders/show', base64_encode($data->id)).'" class="btn btn-dark" id="button_detail"><i class="fa-solid fa-eye me-2"></i> Detail</a>'.'&nbsp;'.'<a href="#" class="btn btn-danger" data-id="'.$data->id.'" id="buttonUpdate"><i class="fa-solid fa-calendar me-2"></i> Expired</a>';
                })

                ->addColumn('grand_total', function($data){
                    return 'Rp. '.number_format($data->grand_total, 0, ',', '.').'';
                })
                 ->addColumn('payment_status', function($data){
                    if ($data->payment_status == 1) {
                        return '<span class="badge badge-info">Menunggu Pembayaran</span>';
                    } elseif($data->payment_status == 2) {
                        return '<span class="badge badge-success">Sudah Dibayar</span>';
                    } elseif($data->payment_status == 5) {
                        return '<span class="badge badge-info">Bayar Cod</span>';
                    } else {
                        return '<span class="badge badge-danger">Kadaluarsa</span>';
                    }
                })
                ->addColumn('created_at', function($data){
                    return Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y');
                 })
                 ->addColumn('name', function($data){
                    return $data->first_name .' '. $data->last_name;
                 })

                ->rawColumns(['action', 'grand_total', 'payment_status', 'name', 'created_at'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.orders.index');
    }

    function show($id)
    {
        $data['order'] = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->join('provinces', 'orders.province_id', '=', 'provinces.id')
        ->join('regencies', 'orders.regency_id', '=', 'regencies.id')
        ->join('districts', 'orders.district_id', '=', 'districts.id')
        ->join('villages', 'orders.villages_id', '=', 'villages.id')
        ->select(
            'orders.*',
            'order_items.price',
            'products.name as name_product',
            'order_items.quantity as quantity_item',
            'products.description as descriptionn',
            'products.priceDisc as price_products',
            'users.id as id_user',
            'users.email as email_user',
            'users.name as name_user',
            'provinces.name as name_province',
            'regencies.name as name_regencies',
            'districts.name as name_districts',
            'villages.name as name_villages'
        )
        ->where('orders.id', base64_decode($id))
        ->get();

        // return response()->json($data);
        return view('admin.orders.show', $data);
    }

    function updateStatus($id)
    {
        $order = Order::where('id', $id)->first();
        $order->payment_status = 3;
        $order->save();

        
        return response()->json($order);
    }
}
