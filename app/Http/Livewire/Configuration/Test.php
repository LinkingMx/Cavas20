<?php

namespace App\Http\Livewire\Configuration;

use App\Models\Warehouse;
use Livewire\Component;

class Test extends Component
{
    public function render()
    {

        $wa = Warehouse::where('code', 'like', "%%")
        ->OrWhere('comments', 'like', "%%")
        ->OrWhere('customer_name', 'like', "%%")
        ->whereIn('id', array(1, 2))
        ->get();

        dd($wa);

        //filter the collection by user permissions
        //return $wa->whereIn('building_id', array(1, 2))->all();

        //return view('livewire.configuration.test');
    }
}
