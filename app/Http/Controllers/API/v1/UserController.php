<?php

namespace App\Http\Controllers\API\v1;

use Carbon\Carbon;
use App\Models\User;
use App\Facades\AppResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return AppResponse::sendValidationError($validator->errors());
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];

        User::create($data);
        return AppResponse::sendSuccess($data);
    }

    /**
     * Display the specified resource.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return AppResponse::sendValidationError($validator->errors());
        }

        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            return AppResponse::sendInvalid();
        }

        if (!Hash::check($request->password, $user->password)) {
            return AppResponse::sendInvalid();
        }


        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        // if remember me exist
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        //  token save
        $token->save();

        // payload data
        $payload = [
            'access_token' => $tokenResult->accessToken,
            'data' => $user->only('id', 'name', 'email'),
            'token_validity' => $token->expires_at
        ];
        return AppResponse::sendSuccess($payload, 'Successfully logged in');
    }

    public function logout(Request $request)
    {

        //return AppResponse::sendInvalid();
        if ($request->user()->token()->revoke()) {
            $payload = [
                'message' => 'Successfully logout'
            ];
            return AppResponse::sendSuccess($payload, 'Successfully logout');
        }
    }
}
