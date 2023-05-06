<?php

namespace App\Http\Livewire\Operations;

use App\Models\Transaction;
use App\Models\Warehouse;
use Livewire\Component;
use WireUi\Traits\Actions;

class Sell extends Component
{
    //For notifications
    use Actions;

    public $code;
    public $warehouse;

    //properties for sell warehouse
    public $product_id;
    public $qty;
    public $ticket;

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
     * Set warehouse choosing by the select input
     */
    public function setWarehouse(){

        $this->reset( 'warehouse' );

        if ( $this->code ) {
            $this->warehouse = Warehouse::find( $this->code );
        }
    }

    /**
     * save transaction
     */
    public function save(){

        //Execute validation whit rules if you want to estabilsh another porperty not equal to rules $this->validate( $this->yourRules );
        $this->validate();

        Transaction::create([
            "product_id" => $this->product_id,
            "qty" => $this->qty,
            "warehouse_id" => $this->warehouse['id']
        ]);

        //Emit a event to render de view of the secondary component livewire
        $this->emitTo('operations.sell','render');

        //Clear product and qty
        $this->reset('product_id', 'qty');

        // use a simple syntax: success | error | warning | info
        $this->notification()->success(
            $title = 'Producto agregado',
            $description = 'el producto ha sido agregado a la cava con éxito!'
        );
    }
}
