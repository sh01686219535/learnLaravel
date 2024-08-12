<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AjaxCurd;
use Illuminate\Http\Request;
use File;

class AjaxCurdController extends Controller
{
    //ajaxCurd
    public function ajaxCurd()
    {
        $ajax = AjaxCurd::latest()->paginate(4);
        return view('backend.ajaxCurd.index', compact('ajax'));
    }
    //addCurd
    public function addCurd(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif'
            ],
            [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'phone.required' => 'Phone is required',
                'image.*.image' => 'Each file must be an image',
                'image.*.mimes' => 'Accepted image formats: jpeg, png, jpg, gif',

            ]
        );

        $ajax = new AjaxCurd();
        $imgPth = [];

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $imgPth[] = 'images/' . $filename;
            }
            $ajax->image = json_encode($imgPth);
        }

        $ajax->name = $request->name;
        $ajax->email = $request->email;
        $ajax->phone = $request->phone;
        $ajax->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    //editCurd
    public function editCurd(Request $request)
    {
        // Find the record by ID
        $ajax = AjaxCurd::find($request->up_id);

        // Check if the record exists
        if (!$ajax) {
            return response()->json([
                'status' => 'error',
                'message' => 'Record not found'
            ], 404);
        }

        $imgPth = [];

        // Handle the image upload
        if ($request->hasFile('up_image')) {
            foreach ($request->file('up_image') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $imgPth[] = 'images/' . $filename;
            }
            File::delete(public_path($ajax->image));
            $ajax->image = json_encode($imgPth);
        }

        // Update other fields
        $ajax->name = $request->up_name;
        $ajax->email = $request->up_email;
        $ajax->phone = $request->up_phone;
        $ajax->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    // deleteCurd
    public function deleteCurd(Request $request)
    {
        AjaxCurd::findOrFail($request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    // pagination
    public function pagination(Request $request)
    {
        $ajax = AjaxCurd::latest()->paginate(4);
        return view('backend.ajaxCurd.paginate', compact('ajax'))->render();
    }
    // ajaxSearch
    public function ajaxSearch(Request $request)
    {
        $ajax = AjaxCurd::where('name', 'like', '%' . $request->search_id . '%')
            ->orWhere('email', 'like', '%' . $request->search_id . '%')
            ->orWhere('phone', 'like', '%' . $request->search_id . '%')
            ->orderBy('id', 'desc')
            ->paginate(4);
        if ($ajax->count() >= 1) {
            return view('backend.ajaxCurd.paginate', compact('ajax'))->render();
        } else {
            return response()->json([
                'status' => 'nothing found',
            ]);
        }
    }
}
