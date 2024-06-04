<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CenterPoint;
use App\Models\Menu;
use App\Models\Spot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DataController extends Controller
{
    public function menu() {
        $menu = Menu::latest()->get();
        return datatables()->of($menu)
        ->addColumn('action','menu.action')
        ->addColumn('gambar','menu.gambar')
        ->addIndexColumn()
        ->rawColumns(['gambar','action'])
        ->toJson();
    }

    public function user() {
        $users = User::latest()->get();
        $i = 0;
        foreach($users as $user){
            $users[$i]['role'] = $user->getRoleNames();
            $i++;
        }
        return datatables()->of($users)
        ->addColumn('action','users.action')
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }
}
