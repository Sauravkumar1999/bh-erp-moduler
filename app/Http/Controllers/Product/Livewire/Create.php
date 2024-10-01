<?php

namespace App\Http\Controllers\Product\Livewire;

use Livewire\Component;
use Modules\Company\Entities\Company;
use Modules\ProductCompany\Entities\ProductCompany;
use App\Models\User;

class Create extends Component
{
    public function render()
    {
        $data['users'] = User::query()->get();
        $data['companies'] = Company::query()->get();
        $data['productcompany'] = ProductCompany::query()->get();
        return view('product::livewire.create',compact('data'));
    }
}
