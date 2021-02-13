<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function motdePasseOublie(Request $request)
    {
        //dd($request);
        $token=$request['_token']; 
       // dd($token);
      // dump('here pawd oublie');
       $to_email= $request['email'];
       $url="fermemaya.ngrok.io/password/reset/".$token;
       //dd($url);
      $mail= new MailController;
      $subject="Réinitialisation de mot de passe";
      $content="Bonjour vous avez demandé à réinitialiser votre mot de passe, merci de cliquer sur ce lien suivant 
      <a href=".$url."> <b>mot de passe oublie</b></a>";

     $mail->sendEmailPwd($to_email,$subject,$content);
     
      
     echo "<font face='verdana' color='green'> vous allez un recevoir un mail vous indiquant la conduite à suivre pour réinitialiser votre mot de passe,merci.</font>";

     //return view('auth.passwords.pwdoublie')->with('success','vous allez un recevoir un mail vous indiquant la conduite à suivre pour réinitialiser votre mot de passe,merci.');
    } 

}
