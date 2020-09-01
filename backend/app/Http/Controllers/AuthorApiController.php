<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

class AuthorApiController extends Controller
{
   public function register(Request $request){

    $this->validate($request, [
      'email' => 'required|unique',
      'password' => 'required|min:8',  
  ],
  [
   'email.required' => 'email name is required and must be unique',
   'password.required'  => 'Password required minimum 8 digit',
   
]
);
    $email=$request->input('email');
    $count = User::where('email',$email)->count();

    if($count!=1){
        $name=$request->input('name');
        $email=$request->input('email');
        $password=bcrypt($request->input('password'));
      $add=User::insert(['name'=>$name,'email'=>$email,'password'=>$password]);

      if($add){
        $http = new Client;

        $response = $http->post('http://localhost/ecommerce/backend/public/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'sQrtx9VYh08PVnJbYGGPXHBw9ohiscKSp09TZ9uf',
                'username' =>$email,
                'password' =>$request->input('password'),
                'scope' =>'',
            ],
        ]);
        
        return json_decode((string) $response->getBody(), true);
      }else{
        return response()->json(['Something went wrong']);
      }
    }else{
      return response()->json(['Email exists.Please try with another email']);
    }

    }
/////login here------------------------------------
    public function login(Request $request){
      $request->validate([
        'email'=>'required',
        'password'=>'required',
    ]);
         $email=$request->input('email');
          $password=$request->input('password');
          $user = User::where('email',$email)->first();
        if(!$user){
            return 0;
        }
  
        if(Hash::check($request->password,$user->password)){
          $http = new Client;
  
          $response = $http->post(url('oauth/token'), [
              'form_params' => [
                  'grant_type' => 'password',
                  'client_id' => '2',
                  'client_secret' => 'sQrtx9VYh08PVnJbYGGPXHBw9ohiscKSp09TZ9uf',
                  'username' =>$email,
                  'password' =>$request->input('password'),
                  'scope' =>'',
              ],
          ]);
          
          return json_decode((string) $response->getBody(), true);
        }else{
          return 0;
        }
      
  
    }
}
