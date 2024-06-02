<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-menu|edit-menu|delete-menu', ['only' => ['index', 'create', 'store', 'show',  'edit', 'update','destroy']]);
        $this->middleware('permission:create-menu', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-menu', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-menu', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('menu.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required',
            'gambar' => 'file|image|mimes:png,jpg,jpeg',
            'harga' => 'required'
        ]);

        $menu = new Menu;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $uploadFile = $file->hashName();
            $file->move('upload/menu/', $uploadFile);
            $menu->gambar = $uploadFile;
        }

        $menu->nama = $request->input('nama');
        $menu->harga = $request->input('harga');
        $menu->save();

        if ($menu) {
            return to_route('menu.index')->with('success','Data berhasil disimpan');
        } else {
            return to_route('menu.index')->with('error','Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return redirect()->route('menu.edit', $menu);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $menu = Menu::findOrFail($menu->id);
        return view('menu.edit',['menu' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $this->validate($request, [
            'nama' => 'required',
            'gambar' => 'file|image|mimes:png,jpg,jpeg',
            'harga' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            /**
             * Hapus file image pada folder public/upload/spots
             */
            if (File::exists($menu->gambar)) {
                File::delete($menu->gambar);
            }

            $fileName = time().$request->file('gambar')->getClientOriginalName();
            $path = $request->file('gambar')->storeAs('menus', $fileName, 'public');
            $menu->gambar = 'storage/' . $path;

            // $file = $request->file('gambar');
            // $uploadFile = $file->hashName();
            // $file->move('upload/spots/', $uploadFile);
            // $menu->menu = $uploadFile;
        }

        $menu->nama = $request->input('nama');
        $menu->harga = $request->input('harga');
        $menu->update();

        if ($menu) {
            return to_route('menu.index')->with('success','Data berhasil diupdate');
        } else {
            return to_route('menu.index')->with('error','Data gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);
        if (File::exists($menu->gambar)) {
            File::delete($menu->gambar);
        }

        $menu->delete();
        return redirect()->back();
    }

    public function pesanan(){
        $menus = Menu::latest()->get();
        return view('pesanan.index',['menus' => $menus]);
    }
}
