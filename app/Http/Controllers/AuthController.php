<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){

        $request->validate([
            "email" => "required",
            "password"=> "required"
        ]);

        $user = User::where("email", "=", $request->email)->first();

        
        if(isset($user->id_user)){
            if (Hash::check($request->password, $user->password)) {
                //create token
                $token = $user->createToken("auth_token")->plainTextToken;
                //Si todo ok
                $this->estructura_api->setResultado([
                    "user" => $user,
                    "access_token" => $token
                ]);
                $this->estructura_api->setEstado('SUC-001', 'success', 'Inicio sesión correctamente');
            }else{
                $this->estructura_api->setEstado('ERR-000', 'error', "Contraseña incorrecta");
                $this->estructura_api->setResultado([]);
            }
        }else{
            $this->estructura_api->setEstado('ERR-000', 'error', "Usuario no registrado");
            $this->estructura_api->setResultado([]);
        }

        return response()->json($this->estructura_api->toResponse(null));
    }


    public function logout(User $user){

        $user->tokens()->delete();

        $this->estructura_api->setEstado('ERR-000', 'success', "Cierre de sesión");
        $this->estructura_api->setResultado([]);

        return response()->json($this->estructura_api->toResponse(null));

    }
}
