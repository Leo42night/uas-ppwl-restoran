<?php

namespace App\Http\Controllers;

use App\Models\CenterPoint;
use App\Models\Centre_Point;
use App\Models\Spot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            "countMenus" => DB::table('menus')->count(),
            "countUsers" => DB::table('users')->count()
        ]);
    }

    public function menu()
    {
        return view('menu.index');
    }
}
