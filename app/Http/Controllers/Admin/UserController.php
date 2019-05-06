<?php

namespace App\Http\Controllers\Admin;

use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Uzzal\Crud\AppController;

class UserController extends AppController
{
    public function __construct(UserRepository $repo)
    {
        parent::__construct($repo, 'Admin\User');
    }
}
