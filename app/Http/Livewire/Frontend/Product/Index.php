<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use App\Models\Product;

class Index extends Component
{
    public $product,$category,$brandInput=[],$priceInput=[]; 

    protected $queryString = [
        'brandInput'=> ['except' => '', 'as' => 'brand'],
        'priceInput'=> ['except' => '', 'as' => 'brand'],
    ];

    public function mount($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $this->product = Product::where('category_id', $this->category->id)
                                ->when($this->brandInput,function($query){
                                    $query->whereIn('brand',$this->brandInput);
                                })
                                ->when($this->priceInput,function($query){

                                    $query->when($this->priceInput=='high-to-low',function($query2){
                                        $query2->orderBy('selling_price','DESC');
                                    })
                                    ->when($this->priceInput=='low-to-high',function($query2){
                                        $query2->orderBy('selling_price','ASC');
                                    });
                                })
                                ->where('status', '0')
                                ->get();
        return view('livewire.frontend.product.index', [
            'product' => $this->product,
            'category' => $this->category,
        ]);
    }
}
