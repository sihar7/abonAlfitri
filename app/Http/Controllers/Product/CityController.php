<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
class CityController extends Controller
{
    public function getKabupaten($id)
    {
        $data = DB::table('regencies')
            ->select('id', 'name')
            ->where('province_id', $id)
            ->orderBy('name', 'asc')
            ->get();
        $res = '<option value="" selected>Pilih Salah Satu</option>';
        foreach ($data as $item) {
            $res .= '<option value="'.$item->id.'">'.$item->name.'</option>';
        }
        return response()->json(['res' => $res], 201);
    }

    public function getKecamatan($id)
    {
        $data = DB::table('districts')
            ->select('id', 'name')
            ->where('regency_id', $id)
            ->orderBy('name', 'asc')
            ->get();
        $res = '<option value="" selected>Pilih Salah Satu</option>';
        foreach ($data as $item) {
            $res .= '<option value="'.$item->id.'">'.$item->name.'</option>';
        }
        return response()->json(['res' => $res], 201);
    }

    public function getKelurahan($id)
    {
        $data = DB::table('villages')
            ->select('id', 'name')
            ->where('district_id', $id)
            ->orderBy('name', 'asc')
            ->get();
        $res = '<option value="" selected>Pilih Salah Satu</option>';
        foreach ($data as $item) {
            $res .= '<option value="'.$item->id.'">'.$item->name.'</option>';
        }
        return response()->json(['res' => $res], 201);
    }
}
