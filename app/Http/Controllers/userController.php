<?php

namespace App\Http\Controllers;

use App\Models\kurikulum;
use App\Models\Pengguna;
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
            'kurikulum'=>'nullable',
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
    public function addKurikulum(User $pengguna)
    {
        return view('user.addKurikulum' , [
            'users' => $pengguna,
            'roles' => role::all(),
            'kurikulums' => kurikulum::all(),
        ]);
    }

    public function storeKurikulum(Request $request, User $pengguna)
    {
        $validateData = validator($request->all(), [
            'kurikulum'=>'required',
        ], [
            'kurikulum.required'=>'Kurikulum belum dimasukan'
        ])->validate();

        $pengguna->kurikulum = $validateData['kurikulum'];
        $pengguna->save();
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
            'kurikulums' => kurikulum::all(),
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
            'email'=>'required|string',
            'role'=>'required|string|max:40',
            'kurikulum'=>'nullable'
        ], [
            'name.required'=> 'Nama harus diisi',
            'name.unique'=> 'Nama sudah pernah didaftarkan',
            'email.required'=> 'Email harus diisi',
        ])-> validate();

        $pengguna->id = $validateData['id'];
        $pengguna->name = $validateData['name'];
        $pengguna->email = $validateData['email'];
        $pengguna->role = $validateData['role'];

        $roleCheck = DB::select('select nama_role from role where id = :id', ['id' => $request->role]);
        $hasil = $roleCheck[0]->nama_role;
        if($hasil != 'User'){
            $pengguna->kurikulum = Null;
        }
        elseif($hasil == 'User'){
            if($request->kurikulum == Null){
                return redirect()->back()->withErrors('Kurikulum harus diisi')->withInput();
            }
            else{
                $pengguna->kurikulum = $validateData['kurikulum'];
            }
        }

        $pengguna->save();
        return redirect(route('user-index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pengguna)
    {
        $pengguna->delete();
        return redirect(route('user-index'));
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }

//    public function namaRole($a){
//        $results = DB::select('select nama_role from role where id = :id', ['id' => $a]);
//        $periode = $results[0]->nama_role;
//        return $periode;
//    }
//
//    public function validationStore(Request $request){
//        $dataRole = $request->role;
//        if ($this->namaRole($dataRole) == 'Admin' and $request->kurikulum =='Admin'){
//            $this->store($request);
//        }
//        elseif ($this->namaRole($dataRole) != 'Admin' and $request->kurikulum !='Admin'){
//            $this->store($request);
//        }
//        else{
//            if ($this->namaRole($dataRole) == 'Admin' and $request->kurikulum !='Admin'){
//                return redirect()->back()->withErrors('Admin tidak boleh memiliki kurikulum')->withInput();
//            }elseif ($this->namaRole($dataRole) != 'Admin' and $request->kurikulum =='Admin'){
//                return redirect()->back()->withErrors('Kurikulum tidak sesuai')->withInput();
//            }
//        }
//
//    }

}
