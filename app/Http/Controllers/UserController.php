<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $user = User::all(); 
        return response()->json([
            'data' => $user, 
        ]);
    } 

    public function store(UserRequest $request){ 
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->status = $request->status;
        $user->type = $request->type;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'data' => $user, 
            'success'=>'Usuario cadastrado com sucesso'
        ]);
    }
    
    public function show($id){
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json('Usuario não existe', 404); 
        }
        return response()->json([
            'data' => $user,  
        ]);
    }

    public function update(UserRequest $request,$id){
        $user = User::find($id); 
        $user->email = $request->email;
        $user->name = $request->name;
        $user->status = $request->status;
        $user->type = $request->type;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'data' => $user, 
            'success'=>'Usuario atualizado com sucesso'
        ]);
    }

    public function destroy($id){
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json('Usuario não existe', 404); 
        }
        $user->delete();
        return response()->json([
            'data' => $user, 
            'success'=>'Usuario deletado com sucesso'
        ]);
    }
}
