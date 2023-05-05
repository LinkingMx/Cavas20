<?php

namespace App\Http\Livewire\Lists;

use App\Models\Product;
use Livewire\Component;
use WireUi\Traits\Actions;

class ShowProducts extends Component
{
    use Actions;

    //Modasl properties
    public $openUploadProducts = false;
    public $openNewProduct = false;
    public $openEditProduct = false;

    //New adn edit modal properties
    public $sap;
    public $name;
    public $price;
    public $product;

    //Search property
    public $search;

    //Rules for new record
    protected $rulesNew = [
        'name' => 'required',
        'sap' => 'required'
    ];

    //Rules for edit record
    protected $rules = [
        'product.name' => 'required',
        'product.sap' => 'required',
        'product.price' => 'required'
    ];

    public function render()
    {
        //query product all
        $products = Product::where('name', 'like', '%'.$this->search.'%')
        ->orWhere('sap', 'like', '%'.$this->search.'%')
        ->orderBy('sap')
        ->paginate(7);
        return view('livewire.lists.show-products', compact('products'));
    }

    /**
     * Create new product form modal
     */
    public function save(){

        //Execute validation whit rules if you want to estabilsh another porperty not equal to rules $this->validate( $this->yourRules );
        $this->validate( $this->rulesNew);

        Product::create([
            "sap" => $this->sap,
            "name" => $this->name,
            "price" => $this->price
        ]);

        //This method reset the properties of the Class and clean the modal
        $this->reset('openNewProduct', 'sap', 'name', 'price');

        //Emit a event to render de view of the secondary component livewire
        $this->emitTo('lists.show-products','render');

        // use a simple syntax: success | error | warning | info
        $this->notification()->success(
            $title = 'Producto guardado',
            $description = 'EL producto ha sido guardado con éxito!'
        );
    }

    /**
     * Edit element by Modal
     * the parameter is an object of the Prpoduct
     */
    public function edit( Product $product){

        $this->product = $product;
        $this->openEditProduct = true;
    }

    /**
     * Edit product form modal
     */
    public function update(){

        //Execute validation whit rules if you want to estabilsh another porperty not equal to rules $this->validate( $this->yourRules );
        $this->validate( $this->rules);

        //Salvamos el registro
        $this->product->save();

        //This method reset and close teh modal
        $this->reset('openEditProduct', 'product');

        //Emit a event to render de view of the secondary component livewire
        $this->emitTo('lists.show-products','render');

        // use a simple syntax: success | error | warning | info
        $this->notification()->success(
            $title = 'Producto editado',
            $description = 'EL producto ha sido editado con éxito!'
        );
    }

    /**
     * Delete product from databse
     */
    public function delete(){
        
    }
}
