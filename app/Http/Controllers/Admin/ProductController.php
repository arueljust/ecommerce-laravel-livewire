<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFromRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;
use App\Models\Color;

class ProductController extends Controller
{
    

    public function index()
    {
        $product=Product::all();
        return view('admin.product.index',compact('product'));
    }

    public function create()
    {
        $category=Category::all();
        $brand=Brand::all();
        $color=Color::where('status','0')->get();
        return view('admin.product.create',compact('category','brand','color'));
    }

    public function store(ProductFromRequest $request)
    {
        $validateData=$request->validated();

        $category=Category::findOrFail($validateData['category_id']);
        
       $product = $category->product()->create([
            'category_id'=>$validateData['category_id'],
            'name'=>$validateData['name'],
            'slug'=>Str::slug($validateData['slug']),
            'brand'=>$validateData['brand'],
            'small_description'=>$validateData['small_description'],
            'description'=>$validateData['description'],
            'original_price'=>$validateData['original_price'],
            'selling_price'=>$validateData['selling_price'],
            'quantity'=>$validateData['quantity'],
            'trending'=>$request->trending == true ? '1':'0',
            'featured'=>$request->featured == true ? '1':'0',
            'status'=>$request->status == true ? '1':'0',
            'meta_title'=>$validateData['meta_title'],
            'meta_keyword'=>$validateData['meta_keyword'],
            'meta_description'=>$validateData['meta_description'],
        ]);

        if($request->hasFile('image')){
            $uploadPath='upload/product/';

           $i=1;
        foreach($request->file('image') as $imageFile)
        {
            $extension=$imageFile->getClientOriginalExtension();
            $filename=time().$i++.'.'.$extension;
            $imageFile->move($uploadPath,$filename);
            $finalImagePathName=$uploadPath.$filename;

            $product->productImage()->create([
                'product_id'=>$product->id,
                'image'=>$finalImagePathName,
            ]);
        }
       }

       if($request->color){
            foreach($request->color as $key=>$color){
                $product->productColor()->create([
                    'product_id'=>$product->id,
                    'color_id'=>$color,
                    'quantity'=>$request->colorquantity[$key]??0,
                ]);
            }
       }
       return redirect('/admin/product')->with('message','Product Added Successfully!');
    }

    public function edit(int $product_id)
    {
        $category=Category::all();
        $brand=Brand::all();
        $product=Product::findOrFail($product_id);

        $product_color=$product->productColor->pluck('color_id')->toArray();
        $color=Color::whereNotIn('id',$product_color)->get();
        
        return view('admin.product.edit',compact('product','brand','category','color'));
    }

    public function update(ProductFromRequest $request,int $product_id)
    {
        $validateData=$request->validated();
        $product=Category::findOrFail($validateData['category_id'])
                        ->product()->where('id',$product_id)->first();
        
        if($product)
        {
            $product->update([
                'category_id'=>$validateData['category_id'],
                'name'=>$validateData['name'],
                'slug'=>Str::slug($validateData['slug']),
                'brand'=>$validateData['brand'],
                'small_description'=>$validateData['small_description'],
                'description'=>$validateData['description'],
                'original_price'=>$validateData['original_price'],
                'selling_price'=>$validateData['selling_price'],
                'quantity'=>$validateData['quantity'],
                'trending'=>$request->trending == true ? '1':'0',
                'featured'=>$request->featured == true ? '1':'0',
                'status'=>$request->status == true ? '1':'0',
                'meta_title'=>$validateData['meta_title'],
                'meta_keyword'=>$validateData['meta_keyword'],
                'meta_description'=>$validateData['meta_description'],
            ]);

            if($request->hasFile('image')){
                $uploadPath='upload/product/';
    
               $i=1;
            foreach($request->file('image') as $imageFile)
            {
                $extension=$imageFile->getClientOriginalExtension();
                $filename=time().$i++.'.'.$extension;
                $imageFile->move($uploadPath,$filename);
                $finalImagePathName=$uploadPath.$filename;
    
                $product->productImage()->create([
                    'product_id'=>$product->id,
                    'image'=>$finalImagePathName,
                ]);
            }
           }
           return redirect('/admin/product')->with('message','Product Update Successfully!');
        }
        else
        {
            return redirect('admin/product')->with('message','No Such Product Id Found');
        }
    }

    public function destroyImage(int $product_image_id)
    {
        $productImage=ProductImage::findOrFail($product_image_id);
        if(File::exists($productImage->image)){
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message','Product Image Deleted!');
    }

    public function destroy(int $product_id)
    {
        $product=Product::findOrFail($product_id);
        if($product->ProductImage){
            foreach($product->ProductImage as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('message','Product And Image Deleted!');
    }


    public function updateProdColorQty(Request $request,$prod_color_id)
    {
        $productColorData=Product::findOrFail($request->product_id)
                                ->productColor()->where('id',$prod_color_id)->first();
        $productColorData->update([
            'quantity'=>$request->qty
        ]);
        return response()->json(['message'=>'Product Quantity Updated']);
    }

   
}
