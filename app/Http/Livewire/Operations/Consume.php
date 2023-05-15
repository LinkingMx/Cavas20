<?php

namespace App\Http\Livewire\Operations;

use App\Models\Transaction;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use WireUi\Traits\Actions;

class Consume extends Component
{
    //This usae Actions allow to use the notification by wireui
    use Actions;

    public $code;
    public $warehouse;

    //properties for sell warehouse
    public $product_id, $qty, $inventory;

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
     * Set warehouse choosing by the select input and products array
     * void only set warehouse property
     */
    public function setWarehouse(){

        // Reset the property warehouse 
        $this->reset( 'warehouse', 'products' );

        //If to validate we are sending a warehouse
        if ( $this->code ) {

            //Fill the ware house object
            $this->warehouse = Warehouse::find( $this->code );

            //fill the inventory for the warehouse
            $this->inventory = self::setInventory( $this->warehouse->id );

            //Eloquent Collection result for fill the products in the warehouse
            $prods = Transaction::where('warehouse_id', '=', $this->code )->get();

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
     * void
     */
    public function save()
    {
        //Get the sum of the product on the warehouse
        $qty = self::productInventory($this->warehouse->id, $this->product_id );

        if ( $qty < $this->qty ) {
            // use a simple syntax: success | error | warning | info
            $this->notification()->error(
                $title = 'Error de calculo',
                $description = "El valor final de producto no puede ser mayor a la existencia actual: $qty!"
                
            ); 

            //Fill the inventory property for the invnetory table
            $this->inventory = self::setInventory( $this->warehouse->id );

        } else {
            //Execute validation whit rules if you want to estabilsh another porperty not equal to rules $this->validate( $this->yourRules );
            $this->validate();

            Transaction::create([
                "product_id" => $this->product_id,
                "qty" => ($qty - $this->qty)*-1,
                "warehouse_id" => $this->warehouse['id']
            ]);

            //Fill the inventory property for the invnetory table
            $this->inventory = self::setInventory( $this->warehouse->id );
            
            //Log
            $userid = Auth::user()->id;
            Log::alert("User id:{ $userid } transaction comsume warehouse at product:id: { $this->product_id } qty: { $this->qty }");

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
