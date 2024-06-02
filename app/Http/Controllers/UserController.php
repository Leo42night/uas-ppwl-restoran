<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-user|edit-user|delete-user', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
        $this->middleware('permission:create-user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('users.index', [
            'users' => User::latest('id')->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create', [
            'roles' => Role::pluck('name')->all()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $user = User::create($input);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $uploadFile = $file->hashName();
            $file->move('upload/user/', $uploadFile);
            $user->gambar = $uploadFile;
        }

        $user->assignRole($request->roles);
        return redirect()->route('users.index')
            ->withSuccess('New user is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return redirect()->route('users.edit', $user)->withSuccess('User is Updated.');
        // return view('users.edit', [
        //     'user' => $user
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        // Check Only Super Admin can update his own Profile
        if ($user->hasRole('Super Admin')) {
            if ($user->id != auth()->user()->id) {
                abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
            }
        }
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::pluck('name')->all(),
            'userRole' => $user->roles->pluck('name')[0]
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $input = $request->all();
        if (!empty($request->password)) {
            $input['password'] = Hash::make($request->password);
        } else {
            $input = $request->except('password');
        }

        if ($request->hasFile('gambar')) {
            //     /**
            //      * Hapus file image pada folder public/upload/user
            //      */
            if (File::exists($user->gambar)) {
                File::delete($user->gambar);
            }

            $fileName = time() . $request->file('gambar')->getClientOriginalName();
            $path = $request->file('gambar')->storeAs('users', $fileName, 'public');
            $input['gambar'] = 'storage/' . $path;

            //     /**
            //      * Proses upload file image ke folder public/upload/spots
            //      */
            //     // $file = $request->file('gambar');
            //     // $uploadFile = $file->hashName();
            //     // $file->move('upload/user/', $uploadFile);
            //     // $user->gambar = $uploadFile;

            //     /**
            //      * Proses hapus & upload file image ke folder public/upload/spots
            //      */
            //     // Storage::disk('local')->delete('public/ImageSpots/' . ($spot->image));
            //     // $file = $request->file('image');
            //     // $file->storeAs('public/ImageSpots', $file->hashName());
            //     // $spot->image = $file->hashName();
        }
        $user->update($input);
        $user->syncRoles($request->roles);
        return redirect()->route('users.index')
            ->withSuccess('User is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($user->hasRole('Super Admin') || $user->id == auth()->user()->id) {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
        }
        $user->syncRoles([]);
        $user->delete();
        return redirect()->route('users.index')
            ->withSuccess('User is deleted successfully.');

    }
}
