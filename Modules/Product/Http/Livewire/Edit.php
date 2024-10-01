<?php

namespace Modules\Product\Http\Livewire;

use Livewire\Component;
use Modules\Company\Entities\Company;
use Modules\Product\Entities\Product;
use Modules\ProductCompany\Entities\ProductCompany;
use Modules\User\Entities\User;

class Edit extends Component
{
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        $product = $this->product;
        $data['users'] = User::all();
        $data['companies'] = Company::all();
        $data['productcompany'] = ProductCompany::all();
        return view('product::livewire.edit', compact('data', 'product'));
    }
}
