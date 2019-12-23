<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin')->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Users = \App\User::orderBy("created_at", "desc")->paginate(10);
        return view("dashboard.admin.user.list", [
            "title" => "List Users",
            "Users" => $Users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Roles = \App\Models\Role::all();
        return view("dashboard.admin.user.create", [
            "title" => "Create User",
            "Roles" => $Roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegistRequest $request)
    {
        //

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
        ]);

        return \redirect()->route('admin.user.index')->with(['success' => "Berhasil menambahkan user <strong>{$user->name}</strong> sebagai role <strong>{$user->role->role}</strong>"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dashboard.admin.user.edit', [
            "User" => User::findOrFail($id),
            "Roles" => \App\Models\Role::all(),
            "title" => "Edit User",
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRegistRequest $request, $id)
    {
        //
        $User = User::find($id);

        $User->email = $request->input('email');
        $User->password = Hash::make($request->input('password'));
        $User->role_id = $request->input('role');
        $User->save();
        return redirect()->route('admin.user.index')->with([
            "success" => "Berhasil mengubah user"
        ]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $User = User::find($id);
        $oldName = $User->email;
        $User->delete();
        
        return redirect()->route('admin.user.index')->with([
            "success" => "Berhasil menghapus user <strong>{$oldName}</strong>"
        ]);
    }
}
