<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\color;
use Validator;
use Exception;
class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allcolors = color::paginate(5);
        return view("admin.Colors.index",compact("allcolors"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.Colors.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'name' => "required",
        ]);

        if($validated->fails())

         return response()->json($validated->errors());


            $color = Color::create([
                'name' =>$request->name,
            ]);

            return redirect()->route("color.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $color = Color::find($id);

        return view("admin.Colors.edit",compact("color"));
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
        $color = Color::find($id);

        $validated = Validator::make($request->all(),[
            'name' => "required",
        ]);
        $color->name = $request->name;
        $color->update();
            return redirect()->route("color.index");
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
            $color = Color::find($id);
            $color->delete();
        }catch (Exception $exception) {
            return back()->withError( "sorry you Cant delete this color beacause product has this color ::(");
        }
        return redirect(route("color.index"));
    }
}
