<?php

namespace App\Http\Controllers;

use App\Models\Curd;
use App\Models\userInvormation;
use Illuminate\Http\Request;
use File;

class HomeController extends Controller
{
    //index
    public function index()
    {
        $curd = Curd::all();
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
}
