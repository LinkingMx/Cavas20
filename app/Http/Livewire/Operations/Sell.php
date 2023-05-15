<?php

namespace App\Http\Livewire\Operations;

use App\Models\Transaction;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use WireUi\Traits\Actions;

class Sell extends Component
{
    //For notifications by wireui
    use Actions;

    public $code;
    public $warehouse;

    //properties for sell warehouse
    public $product_id, $qty, $ticket, $inventory;

    //Rules for new record
    protected $rules = [
        'product_id' => 'required',
        'qty' => 'required',
        'ticket' => 'required',
        'warehouse' => 'required'
    ];

    /**
     * Render main
     */
    public function render()
    {
        
        return view('livewire.operations.sell');
    }

    /**
     * Set the inventory for the warehouse variable 
     * @warehouse_id int
     * return Eloquent Collection
     */
    public function setInventory( $warehouse_id ){

        //Fill the products available in the warehouse
        $res = Transaction::select('product_id', DB::raw('sum(qty) as qty'))
        ->where('warehouse_id', $warehouse_id )
        ->groupBy('product_id')
        ->get();
        
        return $res;   
    }

    /**
     * Check the qty in the warehouse for a product 
     * @warehouse_id int
     * @product_id int
     * return Eloquent Collection $item->qty store the value 
     */
    public function productInventory( $warehouse_id, $product_id ){

        //Fill the products available in the warehouse
        $res = Transaction::where('product_id', $product_id)
        ->where('warehouse_id', $warehouse_id)
        ->sum('qty');
        
        return $res;   
    }

    /**
     * Set warehouse choosing by the select input
     * void set warehouse property
     */
    public function setWarehouse(){

        // Reset the property warehouse 
        $this->reset( 'warehouse' );

        //If to validate we are sending a warehouse
        if ( $this->code ) {

            //Fill the ware house object
            $this->warehouse = Warehouse::find( $this->code );

            //fill the inventory for the warehouse
            $this->inventory = self::setInventory( $this->warehouse->id );
        }
    }

    /**
     * save transaction
     */
    public function save(){

        //Execute validation whit rules if you want to estabilsh another porperty not equal to rules $this->validate( $this->yourRules );
        $v = $this->validate();
        dd($v);
        /*
        //If the properties are actyually validated
        
            Transaction::create([
                "product_id" => $this->product_id,
                "qty" => ($this->qty),
                "warehouse_id" => $this->warehouse['id']
            ]);
    
            //Fill the inventory property for the invnetory table
            $this->inventory = self::setInventory( $this->warehouse->id );
            
            //Log
            $userid = Auth::user()->id;
            Log::alert("User id:{ $userid } transaction comsume warehouse at product:id: { $this->product_id } qty: { $this->qty }");
    
            //Emit a event to render de view of the secondary component livewire
            $this->emitTo('operations.sell','render');
    
            //Clear product and qty
            $this->reset('product_id', 'qty');
    
            // use a simple syntax: success | error | warning | info
            $this->notification()->success(
                $title = 'Producto agregado',
                $description = 'el producto ha sido agregado a la cava con éxito!'
            );
        */
    }
}
