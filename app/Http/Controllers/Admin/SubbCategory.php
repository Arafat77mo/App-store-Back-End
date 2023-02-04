<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use App\Models\SubCategory;
use App\Models\Product;
class SubbCategory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index(Request $request){

        $q=$request->q;

         $active=$request->active;
         $items=SubCategory::whereRaw("true");

         if($active)
         {
             $items->where("active",$active);
         }
         if($active=="0")
         {

             $items->where("active",$active);
         }
         if($q)
         {
             $items->whereRaw('(name like ? )',["%$q%"]);
         }


       // dd($active);

         $items=$items->paginate(10)
         ->appends([
             'q'=>$q,
             'active'=>$active
         ]);


       // $items=Category::Paginate(10);
       // dd($items);
        return view("admin.subcategory.index")->with("items",$items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    function create(){
       
$category=Category::all();

        return view("admin.subcategory.create",compact('category'));
      }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
        $category = Category::select("id")->get();

        $validated = $request->validate([
        'sub_name' => "required|unique:sub_categories,sub_name",
        'photo' => 'required',
        'category_id' => 'required|numeric|exists:categories,id'
    ]);

    if($validated)


    $filename = '';
    $filename = uploadImage("subcategory",$request->photo);

        $subcategory = subcategory::create([
            'sub_name' =>$request->sub_name,
            'photo' => $filename,
            'category_id' => $request->category_id,
            'active'=>$request->active
        ]);

         $subcategory->save();
         return redirect()->route('sub_category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        $subcategory = SubCategory::where('category_id',$category->id)->get();

        return response()->json(["status" => true,"statuscode" => 201,"subcategory" => $subcategory]);
    }

    public function get_product_category_subcategory($CategoryID,$SubcategoryID){

        $category = Category::find($CategoryID);
        $subcategory = subcategory::where('category_id',$category->id)->get();
        $specificSub = $subcategory->find($SubcategoryID);
        $product = Product::where("subcategory_id",$specificSub->id)
        ->where("active",1)->get();
        
         foreach($product as $productt){
                $productt->image = json_decode($productt->image);
            }
        return response()->json(["status" => true,"statuscode" => 201,"products" => $product]);
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
                $category = Category::all();

      $item= subcategory::find($id);
        if(!$item)
        {
            session()->flash("msg","Invalid ID");
            return redirect(route("category.index"));

        }
        return view("admin.subcategory.edit",compact('item','category'));
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
        $subcategory = subcategory::find($id);

        $validated = Validator::make($request->all(),[
            'sub_name' => "required",
            
            'category_id' => 'required|numeric|exists:categories,id'
        ]);

        if($validated->fails())

         return response()->json($validated->errors());
         
         
          if($request['photo']){ 
     $data=$request->all();
                      $filename = '';
        $filename = uploadImage("subcategory",$request->photo);
        $data['photo'] = $filename;

           $subcategory->update($data);

}else{
    
   subcategory::where('id', $id)->update(array('sub_name' => $request['sub_name'],'category_id' => $request['category_id']
   ));
            
}
         
         
     
          if($request['active']==1){
            $data['active']=1;
          }
          else{
            $data['active']=0;
          }
         // $data['active']=isset($request['active'])?1:0;
           // dd($data);


                    return redirect (route("sub_category.index"));
                    
                    
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = subCategory::find($id);
        if(!$subcategory)
        return response()->json("the subCategory is not found");

        $subcategory->delete();
        return redirect (route("sub_category.index"));
    }


public function showw($id)
    {
        $category = Category::all();

        $item = subcategory::find($id);

        return view("admin.subcategory.show",compact('item','category'));

    }


    
}
