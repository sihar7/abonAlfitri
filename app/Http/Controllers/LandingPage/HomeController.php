<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\AboutUs;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
class HomeController extends Controller
{
    function index()
    {
        $data['product'] = Product::where('slideActive', 0)
        ->limit(8)->get();
        return view('landingPage.index', $data);
    }

    function shop()
    {
        $data['product'] = Product::where('slideActive', 0)
        ->get();
        return view('landingPage.shop', $data);
    }

    function wishlist()
    {
        $data['product'] = Product::where('slideActive', 0)
        ->get();
        return view('landingPage.wishlist', $data);
    }

    function about()
    {
        $data['product'] = Product::where('slideActive', 0)
        ->get();
        $data['about_us'] = AboutUs::limit(1)->orderBy('created_at', 'DESC')->get();
        return view('landingPage.about', $data);
    }

    function virtualOutlet()
    {
        $data['product'] = Product::where('slideActive', 0)
        ->get();
        return view('landingPage.404', $data);
    }
}
