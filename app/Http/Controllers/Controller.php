<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    
    public function __construct()
    {
        $this->middleware('auth')->except('registration_view');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.index', ['users' => $users]);
    }
    public function invite_view()
    {
        return view('admin.invite');
    }

}
