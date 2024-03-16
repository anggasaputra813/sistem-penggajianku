<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $list_admin = User::where([
            ['role', 'admin'],
            ['id', '<>', $request->user()->id],
        ])->get();

        return view('admin.index', [
            'list_admin' => $list_admin
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['string', 'required'],
            'email' => ['string', 'required', 'email', 'unique:'.User::class],
            'password' => ['string', 'required', 'confirmed']
        ]);

        $user = new User();
        $user->nama = $validated['nama'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->role = 'admin';
        $user->save();

        return redirect(route('admin.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect(route('admin.index'));
    }
}
