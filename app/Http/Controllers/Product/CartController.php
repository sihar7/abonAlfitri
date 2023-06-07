<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepository;

class CartController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {
        $data = [
            'cart' => $request->session()->get('cart'),
            'product' => $this->productRepository->findAll()
        ];

        return view('landingPage/cart')->with($data);
    }

    public function buy($id, Request $request)
    {
        if (!$request->session()->has('cart')) {
            $cart = array();
            array_push($cart, [
                'product' => $this->productRepository->find(base64_decode($id)),
                'quantity' => 1
            ]);
            $request->session()->put('cart', $cart);
        } else {
            $cart = $request->session()->get('cart');
            $index = $this->exists(base64_decode($id), $cart);
            if ($index == -1) {
                array_push($cart, [
                    'product' => $this->productRepository->find(base64_decode($id)),
                    'quantity' => 1
                ]);
            } else {
                $cart[$index]['quantity']++;
            }
            $request->session()->put('cart', $cart);
        }
        return redirect('cart');
    }

    public function remove($id, Request $request)
    {

        $cart = $request->session()->get('cart');
        $index = $this->exists(base64_decode($id), $cart);
        unset($cart[$index]);
        $request->session()->put('cart', array_values($cart));       
        return response()->json(['status' => 1], 201);
    }

    public function update(Request $request)
    {
        $quantities = $request->input('quantity');
        $cart = $request->session()->get('cart');
        for ($i = 0; $i < count($cart); $i++) {
            $cart[$i]['quantity'] = $quantities[$i];
        }
        $request->session()->put('cart', $cart);
        
        return response()->json(['status' => 1], 201);
    }

    public function clearAll(Request $request)
    {
        $userId = base64_encode(Auth::id());
        $index = $this->exists(base64_decode($id), $cart);
        unset($cart[$index]);
        $request->session()->put('cart', array_values($cart));
       
        return response()->json(['status' => 1], 201);
    }

    private function exists($id, $cart)
    {
        for ($i = 0; $i < count($cart); $i++) {
            if (base64_decode($cart[$i]['product']->id) == base64_decode($id)) {
                return $i;
            }
        }
        return -1;
    }
    
}
