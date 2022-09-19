<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Exists;
use Livewire\Component;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    protected $listeners=['deleteConfirmed'=>'deleteCategory'];
    

    public $category_id;

    // public function deleteCategory($category_id)
    // {
    //     $this->category_id=$category_id;
    // }

    // public function destroyCategory()
    // {
    //     $category=Category::find($this->category_id);
    //     $path='upload/category/'.$category->image;
    //     if(File::exists($path)){
    //         File::delete($path);
    //     }
    //     $category->delete();
    //     session()->flash('message','Data Deleted!');
    //     $this->dispatchBrowserEvent('close-modal');
    // }

    public function deleteCategoryConfirmation($category_id)
    {
        $this->category_id=$category_id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteCategory()
    {
        $category=Category::where('id',$this->category_id)->first();
        $category->delete();
        $this->dispatchBrowserEvent('categoryDeleted');
    }

    public function render()
    {
        $category=Category::orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.category.index',['category'=>$category]);
    }
}
