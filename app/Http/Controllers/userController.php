<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isFalse;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pengguna::all();
        return view('user.index', [
            'users' => $data,
            'roles' => role::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create', [
            'roles' => role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = validator($request->all(),[
            'id'=>'required|string|max:10',
            'namaUser'=>'required|string|max:40|unique:user',
            'password'=>'required|string',
            'email'=>'required|string',
            'role_id'=>'required|string|max:40',
        ],[
            'namaUser.required'=> 'Nama harus diisi',
            'namaUser.unique'=> 'Nama sudah pernah didaftarkan',
            'password.required'=> 'Password harus diisi',
            'email.required'=> 'Email harus diisi',
        ])->validate();

        $user=new Pengguna($validateData);
        $user->save();
        return redirect(route('user-index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengguna $pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengguna $pengguna)
    {
        return view('user.edit' , [
            'users' => $pengguna,
            'roles' => role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengguna $pengguna)
    {
        $validateData = validator($request->all(), [
            'id'=>'required|string|max:10',
            'namaUser'=>['required', Rule::unique('user')->ignore($pengguna->id),],
            'email'=>'required|string',
            'role_id'=>'required|string|max:40',
        ], [
            'namaUser.required'=> 'Nama harus diisi',
            'namaUser.unique'=> 'Nama sudah pernah didaftarkan',
            'email.required'=> 'Email harus diisi',
        ])-> validate();

        $pengguna->id = $validateData['id'];
        $pengguna->namaUser = $validateData['namaUser'];
        $pengguna->email = $validateData['email'];
        $pengguna->role_id = $validateData['role_id'];
        $pengguna->save();
        return redirect(route('user-index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengguna $pengguna)
    {
        $pengguna->delete();
        return redirect(route('user-index'));
    }


}
