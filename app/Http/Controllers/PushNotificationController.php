<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\Notification;
use DB;
class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function message()
    {
                $users = User::all();

        $push_notifications = Notification::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.message', compact('push_notifications','users'));
    }
    public function bulksend(Request $req){
        $comment = new Notification();
        $comment->title = $req->input('title');
        $comment->body = $req->input('body'); 
        $comment->to_user_id =$req->input('to_user_id'); 
        $comment->save();
        
        $url = 'https://fcm.googleapis.com/fcm/send';
        if($req->to_user_id !=NULL){
       $FcmToken =[User::whereNotNull('devise_token')->where('id',$comment->to_user_id)->pluck('devise_token')->first()];
        }else{
         $FcmToken = User::whereNotNull('devise_token')->pluck('devise_token')->all();
         }      
         $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $req->title,
                "body" => $req->body,
                'sound' => 'default',
            ]
        ];
        $fields = json_encode ($data);
        $headers = array (
            'Authorization: key=' . "AAAAOvzNBmI:APA91bH8YV406jne-9DRYAas2JZq6xcv6HCgWg1aMBkL2y6T6EhG1qCmBx_7zt2YZUiyHVQSXNfVbq7EWYzbxQaYo-CTH6_Ze7R53f8cOz6pZuQHrjbnxeB_5Rze6d7F5SE6MjJv7akX",
            'Content-Type: application/json'
        );
        
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        $result = curl_exec ( $ch );
        curl_close ( $ch );
        
        return redirect()->back()->with('success', 'Notification Send successfully');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users= User::all();
        return view('admin.create',compact('users'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $pushNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(PushNotification $pushNotification)
    {
        //
    }
}