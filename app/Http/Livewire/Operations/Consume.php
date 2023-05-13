<?php

namespace App\Http\Livewire\Operations;

use App\Models\Transaction;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class Consume extends Component
{
    use Actions;

    public $code;
    public $warehouse;

    //properties for sell warehouse
    public $product_id;
    public $qty;

    //This property is for the array to fill the select 
    public $products;

    //Rules for new record
    protected $rules = [

        'product_id' => 'required',
        'qty' => 'required',
        'warehouse' => 'required'
    ];

    /**
     * Render main function
     */
    public function render()
    {
        return view('livewire.operations.consume');
    }

    /**
     * Set warehouse choosing by the select input and products array
     */
    public function setWarehouse(){

        $this->reset( 'warehouse', 'products' );

        if ( $this->code ) {

            //Fill the ware house object
            $this->warehouse = Warehouse::find( $this->code );

            //
            $prods = Transaction::where('warehouse_id', '=', $this->code )
            ->get();

            //Validate if isEmpty the collection return a null to view for the if 
            if ( $prods->isEmpty() ) {
                $this->products = NULL;
            }else{
                $this->products = $prods->unique('product_id');
            }  
        }
    } 

    /**
     * Save the redord
     */
    public function save()
    {
        //Get the sum of the product on the warehouse
        $qty =  Transaction::where('warehouse_id', '=', $this->warehouse['id'])->sum('qty');

        if ( $qty < $this->qty ) {
            // use a simple syntax: success | error | warning | info
            $this->notification()->error(
                $title = 'Error de calculo',
                $description = 'El valor final de producto no puede ser mayor a la existencia actual!'
            ); 
        } else {
            //Execute validation whit rules if you want to estabilsh another porperty not equal to rules $this->validate( $this->yourRules );
            $this->validate();

            Transaction::create([
                "product_id" => $this->product_id,
                "qty" => ($qty - $this->qty)*-1,
                "warehouse_id" => $this->warehouse['id']
            ]);

            //Emit a event to render de view of the secondary component livewire
            $this->emitTo('operations.consume','render');

            //Clear product and qty
            $this->reset('product_id', 'qty');

            // use a simple syntax: success | error | warning | info
            $this->notification()->success(
                $title = 'Producto consumido',
                $description = 'el producto ha sido consumido a la cava con éxito!'
            );  
        }
    }
}
