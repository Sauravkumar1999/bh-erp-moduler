<?php

namespace Modules\User\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Modules\User\Entities\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\User\Http\Resources\UserResource;
use Laravel\Passport\Token;
use Modules\User\Events\UserLoggedOut;

class UserController extends Controller
{

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            event(new UserLoggedOut(auth()->user()));

            // Generate token for the authenticated user
            $token = $user->createToken('BusinessHub')->accessToken;

            // Define the user data to be returned in the response
            $userData = [
                'email'        => $user->email,
                'full_name'    => $user->full_name,
                'id'           => $user->id,
                // 'code'         => $user->code,
                'redirect_url' => route('sales.page', $user->code),
                'token'        => $token
            ];

            return response()->json(["data" => $userData]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }




    public function checkSession(Request $request)
    {
        // Check if the user is authenticated with a valid token
        if (Auth::guard('api')->check()) {
            // Retrieve the authenticated user
            $user = Auth::guard('api')->user();

            // Retrieve the user's token
            $token = Token::where('user_id', $user->id)->where('name', 'BusinessHub')->get();

            // Check if the user still has a valid token
            if ($token) {
                return response()->json([
                    'active_session' => true,
                    'message' => 'User has an active session.',
                ]);
            } else {
                return response()->json([
                    'active_session' => false,
                    'message' => 'User token has been revoked.',
                ]);
            }
        } else {
            return response()->json([
                'active_session' => false,
                'message' => 'User does not have an active session.'
            ]);
        }
    }




    public function show($id)
    {
        $user = User::find($id);
        return $user ? new UserResource($user) : response()->json(['error' => 'User not found !'], 400);
    }
}
