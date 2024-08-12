<?php

namespace App\Http\Controllers;

use App\Models\Curd;
use Illuminate\Http\Request;
use File;

class CurdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title'=>'required'
        ]);
        $curd = new Curd();
        if ($request->hasFile('image')) {
            $imgPth = [];
            foreach ($request->file('image') as $value) {
                $request->validate([
                    'image'=>'required'
                ]);
                $fileName = time().'-'.$value->getClientOriginalName();
                $filePath = $value->storeAs('curd',$fileName);
                $imgPth[] = 'storage/'.$filePath;
            }
            $curd->image = json_encode($imgPth);
        }

        // $imgPth = [];
        // if($request->hasFile($key)) {
        //     foreach ($request->file($key) as $file) {
        //         $filename = time() . '_' . $file->getClientOriginalName();
        //         $file->move(public_path($path), $filename);
        //         $imgPth[] = $path . '/' . $filename;
        //     }
        // }
        // return $imgPth;

        $curd->title = $request->title;
        $curd->save();
        return response()->json(
            [
                'status'=>'success',
                'message'=>'Curd Create Successfully'
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title'=>'required'
        ]);
        $curd = Curd::find($id);
        if ($request->hasFile('image')) {
            $request->validate([
                'image'=>'required'
            ]);
          
            $fileName = time().'-'.$request->image->getClientOriginalName();
            $filePath = $request->image->storeAs('curd',$fileName);
            File::delete(public_path( $curd->image));
            $curd->image = 'storage/'.$filePath;
        }
        $curd->title = $request->title;
        $curd->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $curd = Curd::find($id);
        File::delete(public_path( $curd->image));
        $curd->delete();
        return back();
    }
}
