<?php

namespace App\Http\Controllers\Admin;
use App\Models\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\EditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use Spatie\Permission\Models\Role;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use App\Models\AdminNote;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // $q = $request->q;
        // $adminRole = Role::findByName('user');
        // $items = $adminRole->users()->whereRaw('(email like ? or f_name like ? or l_name like ?) ', ["%$q%", "%$q%", "%$q%"])
        //     ->paginate(10)
        //     ->appends(['q' => $q]);

        $users = User::paginate(10);
        return view("admin.user.index",compact('users'));
        return 'fuckus';
    }

    public function create()
    {
        return view("admin.user.create");
    }

    public function store(Request $request)
    {

        $validate = Validator::make($request->all(),[
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        ]);

        $requestData = $request->all();
        $requestData['password'] = bcrypt($requestData['password']);

        $filname = '';
        $filname = uploadImage("categories",$request->image);


        $requestData['image'] = $filname;

        $user = User::create($requestData);
        // $user->assignRole('user');
        Session::flash("msg", "s: تمت عملية الاضافة بنجاح");
        return redirect(route("user.index"));
    }

    public function show($id)
    {
        //
    }
    
      public function deleteProfile(){
        $userID =Auth::id();
        try{
            $user = User::find($userID);
            $user->delete();
            return response()->json(["messages" => "deleted succefully" , "status" => 200]);
        }catch(Exception $ex){
            return response()->json(["messages" =>$e->getError()->message , "status" => 500]);
        }

    }


    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            session()->flash("msg", "e:عنوان المستخدم غير صحيح");
            return redirect(route("user.index"));
        }
        return view("admin.user.edit", compact('user'));
    }

    public function update(EditRequest $request, $id)
    {
        $user = User::find($id);
        $requestData = $request->all();
        if ($request->password) {
            $requestData['password'] = bcrypt($requestData['password']);
        } else {
            unset($requestData['password']);
        }
        $user->update($requestData);

        session()->flash("msg", "s:تم تعديل بيانات المستخدم بنجاح");
        return redirect(route("user.index"));
    }


    public function destroy($id)
    {
        $itemDB = User::find($id);
        $itemDB->delete();
        session()->flash("msg", "w:تم حذف المستخدم بنجاح");
        return redirect(route("user.index"));
    }


    function updateProfile(Request $request)
    {
        $request->validate([
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'phone' => 'numeric',
            'image' => 'image',
        ]);

        $user = auth()->user();
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->phone = $request->phone;

        if ($request->image) {
            $fileName = $request->image->store("public/assets/img");
            $imageName = $request->image->hashName();
            $user->image = $imageName;
        }

        $user->save();
        return view("order.edit", compact('user'));

    }
     


    public function indexx()
    {
        // $users = Auth::user();
        $users = user::where('id',Auth::id())->get();
        // $users = user::all();
        // return $users;
       
        
            return view("admin.admin.index",compact('users'));
    }



    function updateProfilee(Request $request)
    {
        $request->validate([
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'email'  => 'required',
            'phone' => 'numeric',
            'image' => 'image',
        ]);

        $user = auth()->user();
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $filename = '';
         if($request['image']){ 
        $filename = uploadImage("Announcements",$request->image);
        $user->image=$filename;
        $user->save();
         }else{
              $user = auth()->user();
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
                     $user->update();

         }
        
        return view("admin.admin.edit", compact('user'));

    }
    
    
     public function deletenotfy()
    {


        $AdminNote = AdminNote::get();
 $AdminNote->each->delete();;
              return redirect()->back();

    }
    
    public function usernotfy()
    {
       
        $all_push_notifications = Notification::where('to_user_id','=',NULL)->orderBy('created_at', 'desc')->get();
        $push_notifications =Notification::where('to_user_id',auth('api')->user()->getKey())->orderBy('created_at', 'desc')->get();

        
        return response()->json(["status" => true,"statuscode" => 201, 'all_push_notifications'=>$all_push_notifications, "push_notifications" => $push_notifications]);
    }
    
    
     public function deleteMessage($id)
    {


        $Notification = Notification::find($id);
 $Notification->delete();;
              return redirect()->back();

    }
    
     public function deleteAllMessage()
    {


        $Notification = Notification::all();
 $Notification->each->delete();
              return redirect()->back();

    }
    
}



