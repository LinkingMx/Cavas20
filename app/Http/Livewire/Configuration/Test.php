<?php

namespace App\Http\Livewire\Configuration;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Test extends Component
{

    public function render()
    {

        //$total = DB::table('my_table')->sum('my_column');

        $test = Transaction::where('product_id', 4)->where('warehouse_id', 1)->sum('qty');
        

        return view('livewire.configuration.test', compact('test'));
    
        //dd($t);

    }
}
