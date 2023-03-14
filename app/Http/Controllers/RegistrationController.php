<?php

namespace App\Http\Controllers;

use App\User;


class RegistrationController extends Controller
{
       public function activation(int $userId, string $token)
       {
           $user = User::findOrFail($userId);
           if(md5($user->email) == $token){
               $user->markEmailAsVerified();
               return redirect('/activation?id='.$userId);
           } else {
               return redirect('/notActivation');
           }

       }
}
