<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 *
 * @package Laravel\App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Retrieves the authenticated user.
     *
     * @param Request $request The request object.
     * @return mixed The authenticated user object.
     */
    public function show(Request $request)
    {
        return $request->user();
    }

    /**
     * Authenticates a user.
     *
     * @param Request $request The request object containing user data.
     * @return mixed The authentication result.
     * @throws \Exception If the user is not authenticated.
     */
    public function authenticate(Request $request)
    {
        return rescue(function() use ($request){

            // get only the email and the password
            $credentials = $request->only('email', 'password');

            // using the details to authenticate the user
            if (auth()->attempt($credentials)) {

                $user = auth()->user();

                $token = $user->createToken('authToken')->plainTextToken;

                return response()->json([
                    'token' => $token,
                    'user' => $user
                ]);

            }else{

                // create the user if the user does not exist
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);

                $token = $user->createToken('authToken')->plainTextToken;

                return response()->json([
                    'token' => $token,
                    'user' => $user
                ]);
            }

            // throw an exception if the user is not authenticated
            throw new \Exception('Invalid credentials');

        }, function($e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                '_time' => now()
            ], 401);
        });
    }
}
