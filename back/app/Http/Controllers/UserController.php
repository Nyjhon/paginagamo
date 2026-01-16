<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $user = User::where('email',$request->email)->first();
                $token = $user->createToken('authToken')->plainTextToken;
                return response(['user' => $user, 'token' => $token]);
            } else {
                return response(['message' => 'Contraseña incorrecta'],500);
            }
        } else {
            return response(['message' => 'Usuario no encontrado'],500);
        }
    }

    public function me(Request $request)
    {
        $user=User::where('id',$request->user()->id)
            ->firstOrFail();
        return $user;
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response(['message' => 'Sesión cerrada']);
    }
    public function listausers(Request $request)
    {
        $hoy = Carbon::now()->toDateString(); 
        return User::with('unit')
            ->where('fechalimite', '>=', $hoy) 
            ->orderBy('id', 'asc')
            ->get();
    }
    public function crearusuario(Request $request){
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password= Hash::make($request->password) ;
        $user->unit_id=$request->unit_id;
        $user->fechalimite=$request->fechalimite;
        $user->carnet=$request->carnet;
        $user->unit_id=$request->unit_id;
        $user->tipo=$request->tipo;
        $user->save();
    }
    public function cambiopassword(Request $request,User $user){
        $user->update([
            'password'=>Hash::make($request->password)
        ]);
        return $user;
    }
    public function deleteduser(Request $request){
        $user = User::find($request->id);
        $user->delete();
    }
    public function editarusuario(Request $request){
        $user = User::find($request->id);
        $user->name=$request->name;
        $user->email=$request->email;
        if ($request->has('unit_id') && $request->unit_id !== null) {
            $user->unit_id = $request->unit_id;
        }        
        $user->fechalimite=$request->fechalimite;
        $user->carnet=$request->carnet;
        $user->tipo=$request->tipo;
        $user->save();
    }
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'passwordnew' => 'required|min:6',
        ]);
        $passwordnew=Hash::make($request['passwordnew']);

        $user = $request->user();

        $user->password = $passwordnew;
        $user->save();
    }
}
