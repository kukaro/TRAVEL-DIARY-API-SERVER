<?php

namespace App\Http\Controllers\Admintool;

use App\Model\Picture;
use App\Model\User;
use Illuminate\Routing\Controller as BaseController;

class AdmintoolController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $users = DB::select('select * from user');
        // dump($users[0]);
        $users = User::all();
        dump($users);
        $pictures = Picture::all();
        dump($pictures);

        return view('test', ['name' => $users[0]->name]);
    }

    public function create()
    {
        $users = User::create([
            'email' => 'dorami@dorami.do',
            'name' => '도라미',
            'age' => 19,
            'birth_date' => '2020-11-11 12:12:12',
            'password' => 'abcdefghijklmn'
        ]);
        dump(User::all());
        $users->save();
        return view('test');
    }
}
