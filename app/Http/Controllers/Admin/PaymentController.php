<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Order;
use Stripe;
use Stripe\Stripe as StripeStripe;
use Exception;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaymentController extends Controller
{

   public function payment(Request $request){

        try{
        $stripe = new \Stripe\StripeClient('sk_test_51LPt1HHqRgQUoXwuczhgaRLZvn634EdGeYrDugMKJrSH9GyVJ1rm4GrSayAVadcRKJDiALWAOzz8b2YtAxSighY400gfAnidm9');
        $res = $stripe->tokens->create([
            'card' => [
                'number' => $request->number,
                'exp_month' => $request->exp_month,
                'exp_year' => $request->exp_year,
                'cvc' => $request->cvc,
            ],
        ]);

        if (Auth::guard('api')->check()) {
            $userID = auth('api')->user()->getKey();
        }

        $cartItem = CartItem::where( ['user_id'=>$userID])->get();

            $name = $request->input('name');
            $adress = $request->input('address');
            $TotalPrice = (float) 0.0;
            $items = $cartItem;
            $order_status_id = $request->input('order_status_id');
            $email= $request->input('email');
            $phone =$request->input('phone');
            $mobile=$request->input('mobile');
            $city=$request->input('city');
           $text=$request->input('text');


            foreach ($items as $item) {
                $product = Product::find($item->product_id);
                $price = $product->sale_price;
                $inStock = $product->quantity;
                if ($inStock >= $item->quantity) {

                    $TotalPrice = $TotalPrice + ($price * $item->quantity);

                    $product->quantity = $product->quantity - $item->quantity;

                    $product->save();

                } else {
                    return response()->json([
                        'message' => 'The quantity you\'re ordering of ' . $item->title .
                        ' isn\'t available in stock, only ' . $inStock . ' units are in Stock, please update your cart to proceed',
                    ], 400);
                }
            }

            $PaymentGatewayResponse = true;
            $transactionID = md5(uniqid(rand(), true));
            if (Auth::guard('api')->check()) {
                $ID = auth('api')->user()->getKey();

            }
            if ($PaymentGatewayResponse) {

                $cartItem = CartItem::where( ['user_id'=>$ID])->get();


                if($cartItem->isEmpty()){
                  return response()->json([
                            'message' => 'CartItem is empety you shoud Add to Cart first.',
                        ], 400);

                }else {
                    $items = CartItem::where( ['user_id'=>$userID])->get();
                    $skus= count($items);

                    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                    $response = $stripe->charges->create([
                      'amount' => $request->total_price * 100,
                       'currency' => 'USD',
                       'source' => $res->id,
                       'description' => $request->description,
                     ]);

                 $order = Order::create([
                    'total_items' => $skus,
                    'total_price' =>  $request->total_price,
                    'name' => $name,
                    'user_info_id' =>$ID,
                    'transactionID' => $transactionID,
                    'order_status_id' => $order_status_id,
                    'email' => $email,
                    'phone' => $phone,
                    'mobile' => $mobile,
                    'city' => Null,
                    'address' => Null ,
                    'text' => Null
                 ]);
                 $items = CartItem::where( ['user_id'=>$userID])->get();
                    foreach ($items as $item) {
$product = Product::find($item->product_id);
$price = $product->sale_price;
$productID= $product->id;
                 $OrderDetail = OrderDetail::create([
                    'order_id' =>$order->id,
                    'product_id'=>$productID,
                   'price'=>$price,
                  'quantity'=>$item->quantity,
                   'total_price' =>$order->total_price

                 ]);
                }
                 $cartItem = CartItem::where( ['user_id'=>$userID]);
                 $cartItem->delete();
                 return response()->json([
                    'message' => 'you\'re order has been completed succefully, thanks for shopping with us!',
                    'orderID' => $order->getKey(),
                    "statusCode" => 200
                 ], 200);
                }
            }

        }
        catch(\Stripe\Exception\CardException $e){
            return response()->json(["response" => "error","status" => $e->getError()->message],500);
        }
    }
    }


