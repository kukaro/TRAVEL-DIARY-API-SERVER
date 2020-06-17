<?php

namespace App\Http\Controllers\Admintool;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class AdmintoolController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = DB::select('select * from user');
        dump($users[0]->name);

        return view('test', ['name' => $users[0]->name]);
    }
}
