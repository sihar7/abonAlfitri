<?php

namespace App\Http\Controllers\Payment;

use Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\AboutUs;
class CheckoutController extends Controller
{
    function checkout()
    {
        $data = $this->cartProductGlobal();
        $data['province'] = DB::table('provinces')->orderBy('name', 'ASC')->get();
        $data['about_us'] = AboutUs::limit(1)->orderBy('created_at', 'DESC')
        ->where('status', 1)->get();
        return view('landingPage.payment.checkout', $data);
    }

    function postCheckout(Request $request)
    {
        if($request->payment == null || empty($request->payment))
        {   
            return response()->json(['status' => 3], 201);
        } else {

            if($request->payment == "Payment Cod")
            {
                $payment_status = 5;
            } else {
                $payment_status = 1;
            }

            if($request->alamat2 == "no" || $request->alamat2 == null) 
            {
                $address        = $request->address;
                $address2       = $request->address2;
                $province_id    = $request->province_id;
                $regency_id     = $request->regency_id;
                $district_id    = $request->district_id;
                $villages_id    = $request->villages_id;
                $post_code      = $request->post_code;
                $phone_number   = $request->phone_number;
                $email          = $request->email;
                
            } else if($request->alamat2 == "yes")
            {
                $address        = $request->address1;
                $address2       = $request->address22;
                $province_id    = $request->province_id2;
                $regency_id     = $request->regency_id2;
                $district_id    = $request->district_id2;
                $villages_id    = $request->villages_id2;
                $post_code      = $request->post_code2;
                $phone_number   = $request->phone_number2;
                $email          = $request->email2;
            }
            
            $order = Order::create([
                'order_number'      =>  'ORD-'.strtoupper(uniqid()),
                'user_id'           => auth()->user()->id,
                'status'            =>  'pending',
                'grand_total'       =>  Cart::session(Auth::user()->id)->getSubTotal(),
                'item_count'        =>  Cart::session(Auth::user()->id)->getTotalQuantity(),
                'payment_status'    =>  $payment_status,
                'payment_method'    =>  $request->payment,
                'first_name'        =>  $request->first_name,
                'last_name'         =>  $request->last_name,
                'email'             =>  $email,
                'company'           =>  $request->company,
                'address'           =>  $address,
                'address2'          =>  $address2,
                'province_id'       =>  $province_id,
                'regency_id'        =>  $regency_id,
                'district_id'       =>  $district_id,
                'villages_id'       =>  $villages_id,
                'post_code'         =>  $post_code,
                'phone_number'      =>  $phone_number,
                'notes'             =>  $request->notes,
                
            ]);
    
            if ($order) {
    
                $items = \Cart::session(Auth::user()->id)->getContent();
        
                foreach ($items as $item)
                {
                    // A better way will be to bring the product id with the cart items
                    // you can explore the package documentation to send product id with the cart
                    $product = Product::where('name', $item->name)->first();
        
                    $orderItem = new OrderItem([
                        'product_id'    =>  $product->id,
                        'quantity'      =>  $item->quantity,
                        'price'         =>  $item->getPriceSum()
                    ]);
                    
                    $order->items()->save($orderItem);
                }
                
                \Cart::session(Auth::user()->id)->remove(base64_decode($request->id));   
                 
                return response()->json(['status' => 1], 201);
            } else {
                return response()->json(['status' => 2], 201);
            }
        }
    
    }
}
