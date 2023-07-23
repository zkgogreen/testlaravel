<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Layermap;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('IsSuper');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = User::select(
            'id',
            'email',
            'name',
            'roles',
            'created_at'
        )->paginate(10);
        // $lmaps = Layermap::select('filename', 'layername', 'table_link')
        //     ->where('status', '=', 'Active')
        //     ->get();
        return view('pages.backend.pengguna.index', [
            'items' => $items,
            // 'lmaps' => $lmaps,
        ]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'roles' => $data['roles'],
    //     ]);
    // }

    public function create(Request $request)
    {
        // $details = [
        //     'title' => 'Tes Coba Email simasi',
        //     'body' => 'This is for testing email using smtp',
        // ];

        try {
            $validator = $this->validate($request, [
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required',
                'roles' => 'required',
            ]);

            // if($validator->fails()){
            //     return $this->sendError('Validation Error.', $validator->errors());
            // }

            $password = $request->password;
            $email = $request->email;

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($password);
            $user->roles = $request->roles;
            $user->save();

            // \Mail::to($email)->send(
            //     new \App\Mail\MailAccounting($details)
            // );

            return redirect()
                ->route('pengguna')
                ->with([
                    'success' =>
                        'BERHASIL! Pengguna Baru telah ditambahkan ke database.',
                ]);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    //     $data = $request->all();
    //     $data = Hash::make($request['password']); // save $hashed value
    //     User::create($data);
    //     // Session::flash('success','Paket Berhasil Ditambahkan');
    //     return redirect()->route('pengguna');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = User::all()->FindOrFail($id);
        $lmaps = Layermap::select('filename', 'layername', 'table_link')
            ->where('status', '=', 'Active')
            ->get();
        return view('pages.pengguna.detail', [
            'item' => $item,
            'lmaps' => $lmaps,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = User::FindOrFail($id);
        $lmaps = Layermap::select('filename', 'layername', 'table_link')
            ->where('status', '=', 'Active')
            ->get();
        return view('pages.pengguna.edit', [
            'item' => $item,
            'lmaps' => $lmaps,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->all();
        $item = User::FindOrFail($id);
        $item->update($data);
        // Session::flash('success','Paket Berhasil Diedit');
        return redirect()
            ->route('pengguna')
            ->with(['success' => 'BERHASIL! Data Pengguna Telah di Update.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::find($id);
        $item->delete();
        return redirect()
            ->route('pengguna')
            ->with([
                'deleted' => 'BERHASIL! Pengguna telah dihapus dari database.',
            ]);
        // return $this->sendResponse([], 'Data deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $packages = PbMap::FindOrFail($id);
    //     $packages->delete();
    //     return redirect()->route('pengguna.PbTable');
    // }
}
