<?php

namespace App\Http\Controllers;

use App\Models\kurikulum;
use App\Models\Pengguna;
use App\Models\PollingDetail;
use App\Models\role;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isFalse;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return view('user.index', [
            'users' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create', [
            'roles' => role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request);
        $validateData = validator($request->all(),[
            'name'=>'required|string|max:40|unique:users',
            'password'=>'required|string',
            'email'=>'required|string',
            'role'=>'required|string|max:40',
        ],[
            'name.required'=> 'Nama harus diisi',
            'name.unique'=> 'Nama sudah pernah didaftarkan',
            'password.required'=> 'Password harus diisi',
            'email.required'=> 'Email harus diisi',
        ])->validate();

        $id = IdGenerator::generate(['table' => 'users', 'length' => 10, 'prefix' =>'PGN-']);

        $user=new User($validateData);
        $user->id=$id;
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
    public function edit(User $pengguna)
    {
//        dd($pengguna);
        return view('user.edit' , [
            'users' => $pengguna,
            'roles' => role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $pengguna)
    {
        $validateData = validator($request->all(), [
            'id'=>'required|string|max:10',
            'name'=>['required', Rule::unique('users')->ignore($pengguna->id),],
            'password'=>'required|string',
            'email'=>'required|string',
            'role'=>'required|string|max:40',
        ], [
            'name.required'=> 'Nama harus diisi',
            'name.unique'=> 'Nama sudah pernah didaftarkan',
            'email.required'=> 'Email harus diisi',
            'password.required'=> 'Email harus diisi',
        ])-> validate();

        $pengguna->id = $validateData['id'];
        $pengguna->name = $validateData['name'];
        $pengguna->email = $validateData['email'];
        $pengguna->password = $validateData['password'];
        $pengguna->role = $validateData['role'];
        $pengguna->save();
        return redirect(route('user-index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pengguna)
    {
        $checkMatKul = PollingDetail::where('user_id', $pengguna->id)->first();
        if(Auth::user()->id != $pengguna->id){
            if ($checkMatKul) {
                return redirect()->back()->withErrors('User sedang terpakai')->withInput();
            }
            else {
                $pengguna->delete();
                return redirect(route('user-index'));
            }
        }else{
            return redirect()->back()->withErrors('Akun sedang terpakai')->withInput();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }

}
