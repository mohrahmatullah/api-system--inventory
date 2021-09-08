<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){  
    	// return 'test';
    	try {    
    		$request->validate([      
    			'email' => 'email|required',      
    			'password' => 'required'    
    		]);    

    		$credentials = request(['email', 'password']);  

    		if (!Auth::attempt($credentials)) {      
    			return response()->json([        
    				'status_code' => 500,       
    				'message' => 'Unauthorized'      
    			]);    
    		}    

			$user = User::where('email', request('email'))->first();    
			// return $user;
			if (!Hash::check($request->password, $user->password, [])) {      
			 throw new \Exception('Error in Login');    
			}    

			$tokenResult = $user->createToken('authToken')->plainTextToken;    
			return response()->json([      
				'status_code' => 200,      
				'access_token' => $tokenResult,      
				'token_type' => 'Bearer',    
			]);  
    			
		} 
		catch (Exception $error) {    
			return response()->json([      
				'status_code' => 500,      
				'message' => 'Error in Login',      
				'error' => $error,    
			]); 
		}

    }

}
