<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class UserController extends Controller
{
   public function index()
   {
   		return view('frontend/login');
   }

   public function userRegister()
   {
   		$inputData = Input::all();
   		if(!empty($inputData)){
            $rules = array(
                  'name'=>'required',
                  'email'=>'required|email',
                  'password'=>'required|confirmed',
               );
            $validator = Validator::make($inputData, $rules);

           if ($validator->fails()) {
               return redirect('User/userRegister')
                           ->withErrors($validator)
                           ->withInput();
           }else{
               $userData = new User();
               $userData->name = $inputData['name'];
               $userData->email = $inputData['email'];
               $userData->password = $inputData['password'];
               if($userData->save())
               {
                  return view('frontend/login');
               }else{
                  return view('frontend/userRegister');
               }
           }
   			print_r($inputData); exit;

   		}
   		return view('frontend/register');

   }
   public function userLogin()
   {

   }
}
