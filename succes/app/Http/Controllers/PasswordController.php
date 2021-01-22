<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use  DB;
use App\User;
use Illuminate\Support\Facades\Validator;
class PasswordController extends Controller
{
    /**
     * 
     */
     public function getFormModifierPassword()
     {
         return view('auth.passwords.modif_password');	
     }

    /**
     * 
     */
     public function modifier_password(Request $request)
     {
     	$data=array('email' => $request->email, 'password'=>$request->password);
     	
     	//dump($request->oldpasswd);
        $user = User::find(auth()->user()->id);
        //dd($user);


     	$email=$request->email;
     	$oldpassword=$request->oldpasswd;
     	$password=$request->password;
     	$confirm=$request->confirm;

     	//$hash=Hash::make($request->oldpasswd);
     	//dd($hash);
     	
     	//$getpwdoldhash=DB::table('users')->whereEmail($email)->get('password');
     	//$values = $getpwdoldhash->toArray();
     	//dd($values[0]->password);
     	
      if(!Hash::check($oldpassword, $user->password)){
      	

           return back()->with('success', 'password non conforme echec.');

          }else{

          	if ($request->password==$request->confirm && $email==$user->email) {

             $this->validator($data);
             $hashed = Hash::make($request->password);
             //dd($hashed);
             $user->update([
            'password'=>$hashed
             ]);

             return back()->with('success', 'password mis à jour avec  Success.');
          		
          	}else{

                return back()->with('success', ' nouveau password  et confirmpassord ne sont pas identiques.');
          	}

          


      

        }
 
      

    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    } 

}
