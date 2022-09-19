<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $slider = Slider::all();
        return view('admin.slider.index', compact('slider'));
    }


    public function create()
    {
        return view('admin.slider.create');
    }


    public function store(SliderFormRequest $request)
    {
        $validateData = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;
            $file->move('upload/slider', $fileName);
            $validateData['image'] = "upload/slider/$fileName";
        }

        $validateData['status'] = $request->status == true ? '1' : '0';

        Slider::create([
            'title' => $validateData['title'],
            'description' => $validateData['description'],
            'image' => $validateData['image'],
            'status' => $validateData['status'],
        ]);
        return redirect('admin/slider')->with('message', 'Slider Added Successfully');
    }


    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(SliderFormRequest $request, Slider $slider)
    {
        $validateData = $request->validated();


        if ($request->hasFile('image')) {

            $destination=$slider->image;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;
            $file->move('upload/slider', $fileName);
            $validateData['image'] = "upload/slider/$fileName";
        }

        $validateData['status'] = $request->status == true ? '1' : '0';

        Slider::where('id',$slider->id)->update([
            'title' => $validateData['title'],
            'description' => $validateData['description'],
            'image' => $validateData['image'] ?? $slider->image,
            'status' => $validateData['status'],
        ]);
        return redirect('admin/slider')->with('message', 'Slider Updated Successfully');
    }

    public function destroy(Slider $slider)
    {
        if($slider->count() > 0){
            $destination=$slider->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $slider->delete();
            return redirect('admin/slider')->with('message','Slider Deleted Successfully');
        }
        return redirect('admin/slider')->with('message','Something Went Wrong');
    }
}
