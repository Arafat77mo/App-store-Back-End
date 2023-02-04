<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use DB;
use App\Models\Notification;

use App\Models\Product;
use App\Models\OrderStatus;
use App\Models\Order;
use App\Models\Category;
use App\Models\Offer;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
   function index()
    {

        return view("admin.Homeinfo");
    }


    public function favourite(Request $request): \Illuminate\Http\JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }
        if (Auth::guard('api')->check()) {
            $userID = auth('api')->user()->getKey();
        }

        $productID = $request->input('product_id');


            //Check if the proudct exist or return 404 not found.
            try { $Product = Product::findOrFail($productID);} catch (ModelNotFoundException $e) {
                return response()->json([
                    'message' => 'The Product you\'re trying to add does not exist.',
                ], 404);
            }

            //check if the the same product is already in the Cart, if true update the quantity, if not create a new one.
            $Favourite = Favourite::where( ['user_id'=>$userID,'product_id' => $productID])->first();
            if ($Favourite) {
                Favourite::where(['user_id'=>$userID, 'product_id' => $productID]);
            } else {
                Favourite::create(['user_id'=>$userID, 'product_id' => $productID]);
            }

            return response()->json(['message' => 'The Favourite was updated with the given product information successfully'], 200);



    }



    public function show($id)
    {
       if (Auth::guard('api')->check()) {
            $userID = auth('api')->user()->getKey();
        }
        // $userID = Auth::user()->id;

        $Favourite = DB::table('favourites')
            ->join('products', 'products.id', '=', 'favourites.product_id')
        ->where('favourites.user_id', '=', auth('api')->user()->getKey())
        ->select([
           'products.id',
            'products.title',
            'products.details',
            'products.image',
            'products.sale_price',
            'products.is_favorite',
            'products.is_cart',
            'products.regular_price',
            'products.slug',
            'favourites.product_id',
        ])
        ->get();
        
         foreach($Favourite as $Favourit){
            $Favourit->image = json_decode($Favourit->image);
        }
       
             return response()->json(['status' => 200, 'Favourite' => $Favourite ]);



    }
    public function destroy($id)
    {

        $Favourite = Favourite::where('user_id',auth('api')->user()->getKey())->where('product_id',$id)->delete();

        return response()->json([
            'message' => 'delete  succefully!',
            'Favourite' => $Favourite,
        ], 200);
    }



  public function Anoncment_product_data(){
        $annoncment = Announcement::select("text","image")->get();
        $products = Product::whereNotNULL("offer_id")->where("active",1)
        ->select("id","title","slug","details","image","regular_price","sale_price","quantity","is_favorite","is_cart")->get();

        // return $products;
        
          foreach($products as $product){
             $product->colors;
        }
        
         foreach($products as $product){
            $product->image = json_decode($product->image);;
       }

        $carts_id = CartItem::select("product_id")->get();
        $favorites_id=Favourite::select("product_id")->get();
        foreach($products as $product){
            foreach($carts_id as $cart_id){
                if($product->id == $cart_id['product_id']){
                    $product->is_cart = 1;
                    break;
                }else{
                    $product->is_cart = 0;
                }
            }
            $product->save();
        }


        foreach($products as $product){
            foreach($favorites_id as $favorite_id){
                if($product->id == $favorite_id['product_id']){
                    $product->is_favorite = 1;
                    break;
                }else{
                    $product->is_favorite = 0;
                }
            }
            $product->save();
        }


         $categories = Category::all();

        foreach($categories as $category)
        {
            $category->subcatrgories;
        }

        return response()->json(["AllAnoncement"=>$annoncment,"AllProduct" => $products,"categories" => $categories]);
    }

    public function HomeInfo(){
        $newstatus = OrderStatus::where("name",'جديد')->first();
        $cancelStatus = OrderStatus::where("id",'5')->first();
        $sendstatus = OrderStatus::where("name",'تم الارسال')->first();
        $receivedStatus = OrderStatus::where("name",'تم التسليم')->first();
        $workStatus = OrderStatus::where("name",'قيد العمل')->first();


        $soldProducts = Product::where('quantity',0)->count();
        $users = User::count();
       $Notification = Notification::count();

        $allProducts = Product::count();
        $allOrder = Order::count();
        $newOrder = Order::where("order_status_id",$newstatus->id)->count();
        $orderCancel = Order::where("order_status_id",$cancelStatus->id)->count();
        $orderwork = Order::where("order_status_id",$workStatus->id)->count();
        $ordersend = Order::where("order_status_id",$sendstatus->id)->count();


;
        return view("admin.Homeinfo",compact(['users','soldProducts','allProducts','orderCancel',
        'allOrder','newOrder','orderwork','ordersend','Notification']));
    }

    public function HomeMony(){


//         $newOrder = Order::where("total_price")->sum();
//  return $newOrder;

$skus = Order::sum('total_price');
$allProducts = Product::count();
$allOrder = Order::count();
$receivedStatus = OrderStatus::where("id",'4')->first();

$userOrder = Order::where("order_status_id",$receivedStatus->id)->count("user_info_id");
$recentOrders = DB::table("orders")->orderBy("created_at","DESC")->get();


            $category =Category::count();
            $offers = Offer::count();

            return view("admin.HomeMony",compact(['skus','allProducts','allOrder','userOrder','category','offers','recentOrders']));

     }


    //  public function recentOrder(){

    //     return view("admin.HomeMony",compact('recentOrders'));
    //  }
    
    
    
    
     public function showOrder()
    {
       
        $order = DB::table('orders')->join('order_status', 'order_status.id', '=', 'orders.order_status_id')
        ->join('order_details', 'order_details.order_id', '=', 'orders.id')

        ->where('orders.user_info_id', '=', auth('api')->user()->getKey())
        
        ->select([
            'order_status.name',
            'orders.total_price',
            'orders.id',
            'order_details.product_id' ,
             'order_details.price' ,
             'order_details.quantity',
             'order_details.total_price',
             'order_details.created_at'

        ])
        ->get();
      
        
             return response()->json(['status' => 200,'orders'=>$order]);
    }
    
    public function product_details($id){
        $product = Product::find($id);
        if(!$product)
        return "Sorry this product doesnot Exists :(";


            $product->colors;
                $product->image = json_decode($product->image);

       $carts_id = CartItem::select("product_id")->get();
       $favorites_id=Favourite::select("product_id")->get();
           foreach($carts_id as $cart_id){
               if($product->id == $cart_id['product_id']){
                   $product->is_cart = 1;
                   break;
               }else{
                   $product->is_cart = 0;
               }
           }
           $product->save();



           foreach($favorites_id as $favorite_id){
               if($product->id == $favorite_id['product_id']){
                   $product->is_favorite = 1;
                   break;
               }else{
                   $product->is_favorite = 0;
               }
           }
           $product->save();

        return response()->json(["status" => true,"statuscode" => 201,"product" => $product]);
    }
}





