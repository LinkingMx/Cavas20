<?php

namespace App\Http\Livewire\Lists;

use App\Models\Building;
use App\Models\Warehouse;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use Stringable;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class ShowWarehouses extends Component
{
    use Actions;
    use WithPagination;

    //Modasl properties
    public $openUpload = false;
    public $openNew = false;
    public $openEdit = false;
    public $openDetails = false;

    //New adn edit modal properties
    public $code;
    public $building_id;
    public $customer_name;
    public $customer_email;
    public $customer_rfc;
    public $comments;
    public $warehouse;
    public $prefix;

    //Search property
    public $search;

    //Rules for new record
    protected $rulesNew = [
        'code' => 'required',
        'building_id' => 'required',
        'customer_name' => 'required',
        'comments' => 'required',
        'customer_email' => 'email',
        'customer_rfc' => 'min:13|max:14'
    ];

    //Rules for edit record
    protected $rules = [
        'warehouse.code' => 'required',
        'warehouse.building_id' => 'required',
        'warehouse.customer_name' => 'required',
        'warehouse.comments' => 'required',
        'warehouse.customer_email' => 'email',
        'warehouse.customer_rfc' => 'min:13|max:14'
    ];

    public function render()
    {
        //query product all
        $warehouses = Warehouse::where('code', 'like', '%'.$this->search.'%')
        ->orWhere('building_id', 'like', '%'.$this->search.'%')
        ->orWhere('customer_name', 'like', '%'.$this->search.'%')
        ->orWhere('comments', 'like', '%'.$this->search.'%')
        ->orderBy('code')
        ->paginate(7);

        //Buildings
        $buildings = Building::all();

        return view('livewire.lists.show-warehouses', compact(['warehouses', 'buildings']));
    }

    /**
     * Create new product form modal
     */
    public function save(){

        //Make the warehouse's code
        //Find the last warehouse with the correct prefix of the building
        $prefix = Building::find( $this->building_id );
        //dd($prefix->prefix);

        //Get the last warehouse
        $last_warehouse = Warehouse::where( 'code', 'like', '%'.$prefix->prefix.'%')
        ->orderBy('code', 'desc')
        ->limit(1)
        ->get();

        //Substring to the last warehouse
        $converted = Str::substr( $last_warehouse[0]['code'], -3);
        dd($converted);

        $next = $converted + 1;
        dd($next);
        
        
        //Execute validation whit rules if you want to estabilsh another porperty not equal to rules $this->validate( $this->yourRules );
        $this->validate( $this->rulesNew);

        Warehouse::create([
            "code" => $this->code,
            "building_id" => $this->building_id,
            "customer_name" => $this->customer_name,
            "customer_email" => $this->customer_email,
            "customer_rfc" => $this->customer_rfc,
            "comments" => $this->comments
        ]);

        //This method reset the properties of the Class and clean the modal
        $this->reset('openNew', 'code', 'building_id', 'customer_name', 'customer_email', 'customer_rfc', 'comments');

        //Emit a event to render de view of the secondary component livewire
        $this->emitTo('lists.show-warehouses','render');

        // use a simple syntax: success | error | warning | info
        $this->notification()->success(
            $title = 'Cava guardada',
            $description = 'La cava ha sido guardada con éxito!'
        );
    }

    /**
     * Edit element by Modal
     * the parameter is an object of the Prpoduct
     */
    public function edit( Warehouse $warehouse){

        $this->warehouse = $warehouse;
        $this->openEdit = true;
    }

    /**
     * Show more element by Modal
     * the parameter is an object of the Prpoduct
     */
    public function showMore( Warehouse $warehouse){

        $this->warehouse = $warehouse;
        $this->openDetails = true;
    }

    /**
     * Edit product form modal
     */
    public function update(){

        //Execute validation whit rules if you want to estabilsh another porperty not equal to rules $this->validate( $this->yourRules );
        $this->validate( $this->rules);

        //Salvamos el registro
        $this->warehouse->save();

        //This method reset and close teh modal
        $this->reset('openEdit', 'warehouse');

        //Emit a event to render de view of the secondary component livewire
        $this->emitTo('lists.show-warehouses','render');

        // use a simple syntax: success | error | warning | info
        $this->notification()->success(
            $title = 'Cava editada',
            $description = 'La cava ha sido editada con éxito!'
        );
    }

    /**
     * Delete product from databse
     */
    public function delete( Warehouse $warehouse ){
        //Delete de info
        Warehouse::where( 'id', '=', $warehouse['id'])->delete();

        //Emit a event to render de view of the secondary component livewire
        $this->emitTo('lists.show-warehouses','render');

        // use a simple syntax: success | error | warning | info
        $this->notification()->error(
            $title = 'Registro eliminado',
            $description = 'Registro eliminado con exito!'
        );
    }

    /**
     * Function Confirm Delete
     */
    public function confirmDelete( Warehouse $warehouse ){
        
        // use a simple syntax
        $this->notification()->confirm([
            'title'       => 'Estas seguro?',
            'description' => 'Estas a punto de eliminar esta cava: '.$warehouse->name,
            'icon'        => 'question',
            'acceptLabel' => 'Sí, eliminar',
            'method'      => 'delete',
            'params'      => $warehouse
        ]);
    }
}

