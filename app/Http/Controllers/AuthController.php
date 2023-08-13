<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Utilities\AppMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // User details validate
        $fields = $request->validate([
            'name' => 'string|required',
            'username' => 'string|required|unique:users,username',
            'email' => 'string|required|unique:users,email',
            'password' => 'string|required|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'username' => $fields['username'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        return response([
            'message' => AppMessages::$AUTHORIZED,
            'status_code' => Response::HTTP_CREATED,
            'data' => $user
        ]);
    }

    public function authentication(Request $request)
    {
        $fields = $request->validate([
            'username' => 'string|required',
            'password' => 'string|required'
        ]);

        // check if user exists -> check through email or username

        $user = User::where('username', $fields['username'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => AppMessages::$UNAUTHORIZED,
                'status_code' => Response::HTTP_UNAUTHORIZED,
            ]);
        }

        // Token
        $token = $user->createToken('bearerToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response([
            'message' => AppMessages::$AUTHORIZED,
            'status_code' => Response::HTTP_OK,
            'data' => $response
        ]);
    }

    public function logout()
    {

        Auth::user()->tokens()->delete();

        return response([
            'message' => AppMessages::$EXIT,
            'status_code' => Response::HTTP_OK,
        ]);
    }

    public function removeUser(string $id)
    {

        $user = User::find($id);

        if (!is_null($user)) {
            $user->delete();

            return response([
                'message' => AppMessages::$USER_REMOVED,
                'status_code' => Response::HTTP_OK,
                'id' => $id
            ], 200);
        }
    }
}
