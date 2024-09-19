<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use App\Jobs\SendOtp;
use App\Mail\MyMail;
use App\Mail\SendOtpMail;
use App\Models\Curd;
use App\Models\Event;
use App\Models\userInvormation;
use Illuminate\Http\Request;
use File;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{
    //index
    public function index() 
    {
        $curd = Cache::rememberForever('curd', function () {
            return Curd::all(); 
        });
        
        return view('backend.home.home', compact('curd'));
    }
    //userInformation
    public function userInformation(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required',
            'curd_id' => 'required',
            'description' => 'required'
        ]);
        $userInfo = new userInvormation();
      
     
        if ($request->hasFile('image')) {
            $request->validate([
                'image'=>'required'
            ]);
            $fileName = time() . '-' . $request->image->getClientOriginalName();
            $filePath = $request->image->storeAs('userInfo', $fileName);
            $userInfo->image = 'storage/'. $filePath; 
        }

        $userInfo->title = $request->title;
        $userInfo->name = $request->name;
        $userInfo->phone = $request->phone;
        $userInfo->email = $request->email;
        $userInfo->password = $request->password;
        $userInfo->curd_id = $request->curd_id;
        $userInfo->description = $request->description;
        $userInfo->save();
        return back();
    }
    //addToCart
    public function addToCart($id){
        $curd = Curd::findOrFail($id);
        Cart::add([
            'id' => $curd->id, 
            'name' => $curd->title, 
            'qty' => 1, 
            'price' => 9.99, 
            'options' => [
                'image' => $curd->image
                ]
            ]);
        return back();
    }
    //eventStore
    public function eventStore(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email', // Added email validation
        ]);
    
        $event = new Event();
        $event->name = $request->name;
        $event->email = $request->email;
        $event->save();
        $name = $request->name;
        $email = $request->email;
        for($i= 0 ; $i < 10; $i++){
            dispatch(new SendMail((object)$request->all(),$name,$email));
        }
        return back()->with('success', 'HTML Email Sent. Check your inbox.'); 
    }
    //sendOtp 
    public function sendOtp(){
        dispatch(new SendOtp())->onQueue('high');
    }
}
