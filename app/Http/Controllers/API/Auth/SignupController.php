<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Http\Requests\SignUpRequest;
use Illuminate\Http\Response;
use App\Services\UserService;

class SignupController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function signup(SignUpRequest $request)
    {        
        $user = $this->userService->create($request->validated());

        $auth_token = $user->createToken('auth-token')->plainTextToken;
        
        Mail::to($request->email)->send(new WelcomeMail('welcome to aour system'));
        
        return response()->json(compact('user','auth_token'),Response::HTTP_OK);
    }
}
