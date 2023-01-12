<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class usersController extends Controller
{
    public function index() {

        $users = User::get();

        if (count($users) > 0) {
            $this->estructura_api->setEstado('SUC-001', 'success', 'Usuarios encontrados');
            $this->estructura_api->setResultado($users);
        } else {
            $this->estructura_api->setEstado('ERR-000', 'error', 'No existen usuarios registrados');
        }
        return response()->json($this->estructura_api->toResponse(null));


    }

    public function store(Request $request) {

        $validations = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone_number' => 'required',

        ]);
   
   
           if(!$validations->fails()){

               $user= new User;
               $user->name  = $request ->name;
               $user->lastname  = $request ->lastname;
               $user->email  = $request ->email;
               $user->password  = $request ->password;
               $user->phone_number  = $request ->phone_number;

            
               $user->save();
   
               $this->estructura_api->setResultado($user);
               $this->estructura_api->setEstado('SUC-001', 'success', 'Usuario Guardado Correctamente');
   
           }else{
               $this->estructura_api->setEstado('ERR-000', 'error', "Error al registrar por validaciones");
               $this->estructura_api->setResultado([]);
           }
           return response()->json($this->estructura_api->toResponse(null));
   
    }

    public function show($id_user) {
        $user = User::where('id_user', $id_user)->first();
        if(isset($user)){

            $this->estructura_api->setResultado($user);
        }else{

            $this->estructura_api->setEstado('INF-001', 'INF', 'No se encontro el usuario');
            $this->estructura_api->setResultado(null);

        }
        return response()->json($this->estructura_api->toResponse(null));
   
    }

    public function update(Request $request, $id_user) {

        $validations = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone_number' => 'required',
        ]);

        if (!$validations->fails()) {
           $user = User::find($id_user);

           if (isset($user)) {

            $user->name  = $request ->name;
            $user->lastname  = $request ->lastname;
            $user->email  = $request ->email;
            $user->password  = $request ->password;
            $user->phone_number  = $request ->phone_number;

            $user->save();


               $this->estructura_api->setResultado([$user]);
               $this->estructura_api->setEstado('SUC-001', 'success', 'Usuario Actualizado correctamente');
           } else {
               $this->estructura_api->setEstado('ERR-000', 'error', 'no existe este Usuario');
           }
        } else {
            $this->estructura_api->setEstado('ERR-000', 'error', $validations->errors());
        }
        return response()->json($this->estructura_api->toResponse(null));

    }

    public function destroy($id_user) {

        $user = User::find($id_user);
   
            if(isset($user)){
                $user->delete();
    
                $this->estructura_api->setEstado('SUC-001', 'success', 'Usuario eliminado Correctamente');
            }else{
                $this->estructura_api->setEstado('ERR-000', 'error', 'Usuario no Encontrado');
                $this->estructura_api->setResultado(null);
            }

        return response()->json($this->estructura_api->toResponse(null));
      
    }
}
