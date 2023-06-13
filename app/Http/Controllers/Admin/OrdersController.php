<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Validator,Redirect,Response,File;
class OrdersController extends Controller
{
    function index(Request $request)
    {
        if(request()->ajax()) {
            $data = Order::orderBy('id', 'DESC')
            ->get();
            return DataTables()->of($data)
                ->addColumn('action', function($data){
                    return '<a href="#" class="btn btn-dark" id="button_detail"><i class="fe fe-eye"></i> Detail</a>'  . '<a href="#" class="btn btn-squared btn-info mr-2 mb-2" data-id="'.$data->id.'" data-toggle="modal" data-target="#modelId" id="buton_edit"><i class="fe fe-edit"></i> Edit</a> '.
                    '<a href="#" class="btn btn-danger" data-id="'.$data->id.'" id="buton_hapus"><i class="fe fe-trash"></i> Hapus</a>';
                })

                ->addColumn('harga', function($data){
                    return 'Rp. '.number_format($data->harga, 0, ',', '.').'';
                })
                ->addColumn('harga_laba', function($data){
                    return 'Rp. '.number_format($data->harga_laba, 0, ',', '.').'';
                })
                        ->addColumn('total_harga', function($data){
                    return 'Rp. '.number_format($data->total_harga, 0, ',', '.').'';
                })
                 ->addColumn('aktif', function($data){
                    if ($data->aktif == 0) {
                        return '<span class="badge badge-danger">Non Aktif</span>';
                    } elseif($data->aktif == 1) {
                        return ' <span class="badge badge-success">Aktif</span>';
                    }
                })

                ->rawColumns(['action', 'harga', 'harga_laba', 'total_harga', 'aktif'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('superadmin.barang.index');
    }
}
