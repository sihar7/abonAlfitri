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
use App\Repositories\Product\ProductRepository;
class HomeController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    function index(Request $request)
    {
        $data = [
            'cart' => $request->session()->get('cart'),
            'product' => Product::where('slideActive', 0)
            ->limit(8)->get()
        ];
        
        return view('landingPage/index')->with($data);
    }

    function shop(Request $request)
    {
        $data = [
            'cart' => $request->session()->get('cart'),
            'product' => $this->productRepository->findAll()
        ];
        
        return view('landingPage.shop', $data);
    }

    function wishlist(Request $request)
    {
        $data['product'] = Product::where('slideActive', 0)
        ->get();
        $data['cart'] = $request->session()->get('cart');
        return view('landingPage.wishlist', $data);
    }

    function about(Request $request)
    {
        $data['product'] = Product::where('slideActive', 0)
        ->get();
        $data['about_us'] = AboutUs::limit(1)->orderBy('created_at', 'DESC')->get();
        $data['cart'] = $request->session()->get('cart');
        return view('landingPage.about', $data);
    }

    function virtualOutlet(Request $request)
    {
        $data['product'] = Product::where('slideActive', 0)
        ->get();
        $data['cart'] = $request->session()->get('cart');
        return view('landingPage.404', $data);
    }
}
