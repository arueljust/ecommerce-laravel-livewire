<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Category;
use GuzzleHttp\Psr7\Message;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{   
    use WithPagination;
    protected $paginationTheme='bootstrap';
    protected $listeners=['deleteConfirmed'=>'deleteBrand'];

    public $name,$slug,$status,$brand_id,$category_id;

    public function rules()
    {
        return[
            'name'=>'required|string',
            'slug'=>'required|string',
            'category_id'=>'required|integer',
            'status'=>'nullable'
        ];

    }

    public function resetInput()
    {
        $this->name=NULL;
        $this->slug=NULL;
        $this->status=NULL;
        $this->brand_id=NULL;
        $this->category_id=NULL;
    }

    public function storeBrand()
    {
        $validateData=$this->validate();
        Brand::create([
            'name'=>$this->name,
            'slug'=>Str::slug($this->slug),
            'status'=>$this->status == true ? '1':'0',
            'category_id'=>$this->category_id
        ]);
        // session()->flash('message','Brand Added Sucsessfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function addModal()
    {
        $this->dispatchBrowserEvent('success',['message'=>'Brand Success Added']);
    }  

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function editBrand(int $brand_id)
    {
        $this->brand_id=$brand_id;
        $brand=Brand::findOrFail($brand_id);
        $this->name=$brand->name;
        $this->slug=$brand->slug;
        $this->status=$brand->status;
        $this->category_id=$brand->category_id;
        
    }

    public function updateBrand()
    {
        $validateData=$this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'name'=>$this->name,
            'slug'=>Str::slug($this->slug),
            'status'=>$this->status == true ? '1':'0',
            'category_id'=>$this->category_id
        ]);
        session()->flash('message','Brand Update Sucsessfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    // public function deleteBrand($brand_id)
    // {
    //     $this->brand_id=$brand_id;
    // }

    // public function destroyBrand()
    // {
    //     Brand::findOrFail($this->brand_id)->delete();
    //     session()->flash('message','Brand Deleted');
    //     $this->dispatchBrowserEvent('close-modal');
    //     $this->resetInput();
    // }
  
    public function deleteConfirmation($brand_id)
    {
        $this->brand_id=$brand_id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteBrand()
    {
        $brand=Brand::where('id',$this->brand_id)->first();
        $brand->delete();
        $this->dispatchBrowserEvent('brandDeleted');
    }

    public function render()
    {
        $cetegory=Category::where('status','0')->get();
       $brand=Brand::orderBy('id','DESC')->paginate(10); 
        return view('livewire.admin.brand.index',['brand'=>$brand,'category'=>$cetegory])
                    ->extends('layouts.admin')
                    ->section('content');
    }
}
