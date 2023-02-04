<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\color;
use App\Models\color_product;
use \Exception;

use DB;
use Session;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\CartItem;
use App\Models\Favourite;

use App\Models\Product;
use App\Models\Offer;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\products\ProdRequest;
use App\Http\Requests\products\ProdRequestEdit;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function activate($id){
        //sleep(3);
        $item = Product::find($id);
        if($item){
            $item->active=!$item->active;
            $item->save();
            return response()->json(['status'=>1,'msg'=>'updated successfully']);
        }
        return response()->json(['status'=>0,'msg'=>'invalid id']);
    }
   public function indexxx(Request $request)
        {
            $q = $request->q;
            $subcategories = $request->subcategories;
            $active = $request->active;
            $skus = OrderDetail::selectRaw('COUNT(*)')
            ->whereColumn('product_id','products.id')
            ->getQuery();

        $query = Product::select('*')
            ->selectSub($skus, 'skus_count')
            ->orderBy('skus_count', 'DESC')->get() ;
            if($active!=''){
                $query->where('active',$active);
            }

            if($subcategories){
                $query->where('subcategory_id',$subcategories);
            }

            if($q){
                $query->whereRaw('(title like ? or slug like ?)',["%$q%","%$q%"]);
            }

            $products = $query;
            
             foreach($products as $product){
                $product->image = json_decode($product->image);
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



            $subcategories = SubCategory::all();
            return response()->json(['status' => 200, 'item' =>  $products,  $subcategories ]);

        }

        public function indexx(Request $request)
        {
            $q = $request->q;
            $subcategory = $request->subcategory;
            $active = $request->active;
            $skus = OrderDetail::selectRaw('COUNT(*)')
            ->whereColumn('product_id','products.id')
            ->getQuery();

        $query = Product::select('*')
            ->selectSub($skus, 'skus_count')
            ->orderBy('skus_count', 'DESC')->paginate(8) ;
            if($active!=''){
                $query->where('active',$active);
            }

            if($subcategory){
                $query->where('subcategory_id',$subcategory);
            }

            if($q){
                // $query->whereRaw('(title like ? or slug like ?)',["%$q%","%$q%"]);
                //  return $q;
                $query->where("title","LIKE","%$q%");
            }


            $products = $query;

            $subcategories = SubCategory::all();
            $categories = Category::all();

            // $product = Product::find(15)->subCategory->sub_name;
            // return $product;
                return view("admin.product.index",compact(['products','subcategories','categories']));
        }
         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
    {
        $Categorries = Category::all();

        $SubCategory = SubCategory::all();
        $offers = Offer::all();
                $colors = color::all();
        return view("admin.product.create",compact(['SubCategory','offers','Categorries','colors']));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => "required",
            'quantity'=>"required",
            'regular_price'=>"required",
            'details'=>"required",
            'slug' =>"required",
            "image.*" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",

        ]);

        if($request->hasfile("image")){
            foreach($request->file("image") as $image){
                $filename[] = uploadImage("products",$image);
            }
        }

        $requestData = $request->all();


        $requestData['image'] = json_encode ($filename);

        if($requestData["offer_id"]=="لايوجد خصم"){
            $requestData["offer_id"] = NULL;
        }

        if($requestData["category_id"]=="لايوجد قسم رئيسى"){
            $requestData["category_id"] = NULL;
        }

        if($requestData["subcategory_id"]=="لايوجد قسم فرعى"){
            $requestData["subcategory_id"] = NULL;
        }

        if ($requestData["offer_id"] !=NULL){
            $myoffer = Offer::where("id",$requestData["offer_id"])->select("offer_price")->first();
            $requestData["sale_price"] =  $requestData["regular_price"] - ($myoffer['offer_price']/100 * $requestData["regular_price"]);
        }else{
            $requestData["sale_price"] = $requestData["regular_price"];
        }

        try{
            $product = Product::create($requestData);
            $color_product = color_product::create([
                "color_id" => $request->color_id,
                "product_id" =>$product->id
            ]);
        }catch (Exception $exception) {
            return back()->withError( "sorry you make some thing doing error try again please ::(");
        }
        return redirect()->route('products.indexx');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = product::find($id);
        if(!$product){
            session()->flash("msg","w: العنوان غير صحيح");
            return redirect(route("products.index"));
        }
        return view("admin.product.show",compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = product::find($id);
        if(!$product){
            session()->flash("msg","e:العنوان غير صحيح");
            return redirect(route("products.index"));
        }
        // return $product;
        $Category = Category::all();

        $SubCategories = SubCategory::all();
        // return $SubCategories;
        $offers = Offer::all();
        return view("admin.product.edit",compact('product','SubCategories','offers','Category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $productDB = product::find($id);
        $request['slug'] = Str::slug($request['title']);
       if($request->hasfile("image")){
            foreach($request->file("image") as $image){
                $filename[] = uploadImage("products",$image);
            }
        }

        $requestData = $request->all();


        $requestData['image'] = json_encode ($filename);

        $productDB->fill( $requestData)->save();

        session()->flash("msg","s:تم تعديل المنتج بنجاح");
        return redirect(route("products.indexx"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $product = Product::find($id);
            $color = color_product::where("product_id",$product->id);
            $color->delete();
            $product->delete();
        }catch (Exception $e) {
            return back()->withError( "sorry you Cant delete this product beacause product has color ::(");
        }
        session()->flash("msg","w:تم حذف المنتج بنجاح");
        return redirect(route("products.indexx"));
    }

     public function searchproduct($title){
        $result  = Product::where("title" , "like","%$title%")
        ->orWhere("slug" , "like" ,"%$title%")
        ->orWhere("details" , "like" ,"%$title%")
        ->orWhere("regular_price" , "like" ,"%$title%")
        ->orWhere("sale_price" , "like" ,"%$title%")
        ->orderBy("id","DESC")
        ->get();
        
         foreach($result as $results){
            $results->image = json_decode($results->image);
        }
        if(count($result)){
             return response()->json(['status' => true , 'statusCode' => 201 , 'results' => $result]);
        }else{
            return response()->json(['status' => false, 'statusCode' => 404, 'message' => 'product NOt found']);
        }
    }


    public function index(Request $request)
    {
        $q = $request->q;
        $category = $request->category;
        $active = $request->active;



        // $query = product::whereRaw('true') ;

        $skus = OrderDetail::selectRaw('COUNT(*)')
        ->whereColumn('product_id','products.id')
        ->getQuery();

    $query = Product::select('*')
        ->selectSub($skus, 'skus_count')
        ->orderBy('skus_count', 'DESC') ;
        if($active!=''){
            $query->where('active',$active);
        }

        if($category){
            $query->where('category_id',$category);
        }

        if($q){
            $query->whereRaw('(title like ? or slug like ?)',["%$q%","%$q%"]);
        }


        $products = $query->paginate(8)
            ->appends([
                'q'     =>$q,
                'category'=>$category,
                'active'=>$active
            ]);

        $categories = category::all();

        return view ('admin.product.index',['products'=>$products,'categories'=> $categories]);

    }
    
     public function catproduct($id){
        $category = Category::find($id);

        $catproduct = Product::where("category_id",$category->id)->get();

        return response()->json(["status" => true,"statuscode" => 201, "CatProduct" => $catproduct]);
    }


    
    
    
    
    
    public function productSoldOut(Request $request)
    {
        $q = $request->q;
        $category = $request->category;
        $active = $request->active;



        // $query = product::whereRaw('true') ;

       

    $query = Product::where('quantity','=',0);
      
        if($active!=''){
            $query->where('active',$active);
        }

        if($category){
            $query->where('category_id',$category);
        }

        if($q){
            $query->whereRaw('(title like ? or slug like ?)',["%$q%","%$q%"]);
        }


        $products = $query->paginate(8)
            ->appends([
                'q'     =>$q,
                'category'=>$category,
                'active'=>$active
            ]);

  $categories = Category::all();

        $subcategories = SubCategory::all();
        // return $SubCategories;
        $offers = Offer::all();
        return view("admin.product.productSoldOut",compact('products','subcategories','offers','categories'));

    }
    
    
    
    
    
}
