<?php

namespace App\Services;

use \Exception;
use \Bosnadev\Repositories\Eloquent\Repository;
use \Illuminate\Database\Eloquent\Model;
use App\Repositories\UserRepository;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    use UploadFileTrait;

    public function __construct(UserRepository $userRepository)
    {
        $this->setRepository($userRepository);
    }

    public function create(array $data){
        $data['image'] = $this->uploadFile($data['image'],'/doctors');
        $user = $this->repository->create($data);

        $auth_token = $user->createToken('auth-token')->plainTextToken;
        
        Mail::to($user->email)->send(new WelcomeMail('welcome to aour system'));
        
        return response()->json(compact('user','auth_token'),Response::HTTP_OK);
    }

    public function login(Array $data)
    {
        $user =  $this->repository->findBy('email', $data['email']);
        $this->checkPassword($user, $data['password']);

        return response()->json([
            'auth_token' =>  $user->createToken('auth-token')->plainTextToken
        ]);
    }

    public function checkPassword($user, $password)
    {
        if (! $user || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'message' => __('lang.invalid_credientials'),
            ]);
        }
    }
}