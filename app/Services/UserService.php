<?php

namespace App\Services;

use \Exception;
use \Bosnadev\Repositories\Eloquent\Repository;
use \Illuminate\Database\Eloquent\Model;
use App\Repositories\UserRepository;
use App\Traits\UploadFileTrait;

class UserService extends BaseService
{
    use UploadFileTrait;

    public function __construct(UserRepository $userRepository)
    {
        $this->setRepository($userRepository);
    }

    public function create(array $data){
        $data['image'] = $this->uploadFile($data['image'],'/doctors');
        return $this->repository->create($data);
    }
}