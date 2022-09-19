<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function index()
    {
        $color=Color::all();
        return view('admin.color.index',compact('color'));
    }
    
    
    public function create()
    {
        return view('admin.color.create');
    }


    public function store(ColorFormRequest $request)
    {
        $validateData=$request->validated();
        $validateData['status']=$request->status==true ? '1':'0';
        Color::create($validateData);

        return redirect('admin/color')->with('message','Color Added Successfully');
    }

    public function edit(Color $color)
    {
        return view('admin.color.edit',compact('color'));
    }
   
   
    public function update(ColorFormRequest $request,$color_id)
    {
        $validateData=$request->validated();
        $validateData['status']=$request->status==true ? '1':'0';
        Color::find($color_id)->update($validateData);

        return redirect('admin/color')->with('message','Color Update Successfully');
    }

    public function destroy($color_id)
    {
        $color=Color::findOrFail($color_id);
        $color->delete($color_id);

        return redirect('admin/color')->with('message','Color Deleted');
    }
}
