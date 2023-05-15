<?php

namespace App\Http\Livewire\Configuration;

use App\Models\Building;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use WireUi\Traits\Actions;

class  Users extends Component
{
    use Actions;

    //Modasl properties
    public $openUpload = false;
    public $openNew = false;
    public $openEdit = false;

    //New adn edit modal properties
    public $name;
    public $email;
    public $password;

    //Search property
    public $search;
    public $user;
    public $new_password;

    //Rules for new record
    protected $rulesNew = [
        'name' => 'required',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|min:6'
    ];

    //Rules for edit record
    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required|string|email'
    ];

    public function render()
    {
        //query product all
        $users = User::where('name', 'like', '%'.$this->search.'%')
        ->orderBy('name')
        ->paginate(7);
        return view('livewire.configuration.users', compact('users'));
    }

    /**
     * Create new product form modal
     */
    public function save(){

        //Execute validation whit rules if you want to estabilsh another porperty not equal to rules $this->validate( $this->yourRules );
        $this->validate( $this->rulesNew);

        User::create([
            "name" => $this->name,
            "email" => $this->email,
            "password" => Hash::make($this->password)
        ]);

        //This method reset the properties of the Class and clean the modal
        $this->reset('openNew', 'name', 'email', 'password');

        //Emit a event to render de view of the secondary component livewire
        $this->emitTo('configuration.users','render');

        // use a simple syntax: success | error | warning | info
        $this->notification()->success(
            $title = 'Usuario guarcreadodada',
            $description = 'El usuario ha sido creado con éxito!'
        );
    }

    /**
     * Edit element by Modal
     * the parameter is an object of the Prpoduct
     */
    public function edit( User $user ){

        $this->user = $user;
        $this->openEdit = true;
    }

    /**
     * Edit product form modal
     */
    public function update(){

        //Execute validation whit rules if you want to estabilsh another porperty not equal to rules $this->validate( $this->yourRules );
        $this->validate( $this->rules);

        $this->user->password = Hash::make($this->new_password);

        //Salvamos el registro
        $this->user->save();

        //This method reset and close teh modal
        $this->reset('openEdit', 'user');

        //Emit a event to render de view of the secondary component livewire
        $this->emitTo('configuration.users','render');

        // use a simple syntax: success | error | warning | info
        $this->notification()->success(
            $title = 'usuario editado',
            $description = 'El usuario ha sido editado con éxito!'
        );
    }

    /**
     * Delete product from databse with softdelets
     */
    public function delete( User $user ){
        //Delete de info
        User::where( 'id', '=', $user['id'])->delete();

        //Emit a event to render de view of the secondary component livewire
        $this->emitTo('configuration.users','render');

        // use a simple syntax: success | error | warning | info
        $this->notification()->error(
            $title = 'Registro eliminado',
            $description = 'Registro eliminado con exito!'
        );
    }
}
