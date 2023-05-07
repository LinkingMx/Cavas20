<?php

namespace App\Http\Livewire\Lists;

use App\Models\Building;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use WireUi\Traits\Actions;

class ShowBuildings extends Component
{
    use Actions;

    //Modasl properties
    public $openUpload = false;
    public $openNew = false;
    public $openEdit = false;

    //New adn edit modal properties
    public $name;
    public $prefix;
    public $building;

    //Search property
    public $search;

    //Rules for new record
    protected $rulesNew = [
        'name' => 'required',
        'prefix' => 'required'
    ];

    //Rules for edit record
    protected $rules = [
        'building.name' => 'required',
        'building.prefix' => 'required'
    ];

    public function render()
    {
        //query product all
        $buildings = Building::where('name', 'like', '%'.$this->search.'%')
        ->orderBy('name')
        ->paginate(7);
        return view('livewire.lists.show-buildings', compact('buildings'));
    }

    /**
     * Create new product form modal
     */
    public function save(){

        //Execute validation whit rules if you want to estabilsh another porperty not equal to rules $this->validate( $this->yourRules );
        $this->validate( $this->rulesNew);

        Building::create([
            "name" => $this->name,
            "prefix" => $this->prefix
        ]);

        //This method reset the properties of the Class and clean the modal
        $this->reset('openNew', 'name', 'prefix');

        //Emit a event to render de view of the secondary component livewire
        $this->emitTo('lists.show-buildings','render');

        // use a simple syntax: success | error | warning | info
        $this->notification()->success(
            $title = 'Sucursal guardada',
            $description = 'La sucursal ha sido guardada con éxito!'
        );
    }

    /**
     * Edit element by Modal
     * the parameter is an object of the Prpoduct
     */
    public function edit( Building $building ){

        $this->building = $building;
        $this->openEdit = true;
    }

    /**
     * Edit product form modal
     */
    public function update(){

        //Execute validation whit rules if you want to estabilsh another porperty not equal to rules $this->validate( $this->yourRules );
        $this->validate( $this->rules);

        //Salvamos el registro
        $this->building->save();

        //This method reset and close teh modal
        $this->reset('openEdit', 'building');

        //Emit a event to render de view of the secondary component livewire
        $this->emitTo('lists.show-buildings','render');

        // use a simple syntax: success | error | warning | info
        $this->notification()->success(
            $title = 'Sucursal editada',
            $description = 'La sucursal ha sido editada con éxito!'
        );
    }

    /**
     * Delete product from databse with softdelets
     */
    public function delete( Building $building ){
        //Delete de info
        Building::where( 'id', '=', $building['id'])->delete();

        //Emit a event to render de view of the secondary component livewire
        $this->emitTo('lists.show-buildings','render');

        // use a simple syntax: success | error | warning | info
        $this->notification()->error(
            $title = 'Registro eliminado',
            $description = 'Registro eliminado con exito!'
        );
    }
}
