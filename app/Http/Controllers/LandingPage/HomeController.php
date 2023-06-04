<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
class HomeController extends Controller
{
    function index()
    {
        $data['product'] = Product::all();
        return view('landingPage.index', $data);
    }

    function shop()
    {
        return view('landingPage.shop');
    }

    function wishlist()
    {
        return view('landingPage.wishlist');
    }

    function about()
    {
        return view('landingPage.about');
    }

    function virtualOutlet()
    {
        return view('landingPage.404');
    }
}
