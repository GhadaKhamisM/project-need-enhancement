<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{

    public function model()
    {
        $this->model = new User;
    }
}