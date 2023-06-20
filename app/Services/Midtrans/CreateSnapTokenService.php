<?php
 
namespace App\Services\Midtrans;
 
use Midtrans\Snap;
use Cart;
use Illuminate\Support\Facades\Auth;
class CreateSnapTokenService extends Midtrans
{
    protected $order;
 
    public function __construct($order)
    {
        parent::__construct();
 
        $this->order = $order;
    }
 
    public function getSnapToken()
    {
        $carts = \Cart::session(Auth::user()->id)->getContent();

        foreach ($carts as $key => $item) {
            $params = [
                'transaction_details' => [
                    'order_id' => $this->order->order_number,
                    'gross_amount' => $this->order->grand_total,
                ],
                'item_details' => [
                    [
                        'id' => $item->id,
                        'price' => $item->price,
                        'quantity' => $this->order->item_count,
                        'name' => $item->name,
                    ]
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone_number' => $item->phone_number
                ]
            ];
        }
            

        $snapToken = Snap::getSnapToken($params);
 
        return $snapToken;
    }
}