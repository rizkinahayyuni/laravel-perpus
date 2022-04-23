<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if(Auth::user()->level == 'user') {
            Alert::info('Maaf', 'Anda dilarang masuk halaman ini');
            return redirect()->to('/');
        }

        $datas = User::where([
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if (($keyword = $request->keyword)) {
                    $query->orWhere('name','LIKE','%'.$keyword.'%')
                    ->orWhere('username','LIKE','%'.$keyword.'%')
                    ->orWhere('email','LIKE','%'.$keyword.'%')
                    ->orWhere('level','LIKE','%'.$keyword.'%')->get();
                }
            }]
        ])
            ->orderBy("name", "desc")
            ->paginate(10);
        return view('auth.user', compact('datas'))
            ->with('i', (request()->input('page', 1)-1)*5); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->level == 'user') {
            Alert::info('Maaf', 'Anda dilarang masuk halaman ini');
            return redirect()->to('/');
        }
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = User::where('username',$request->input('username'))->count();

        if($count>0){
            alert()->info('Username sudah terpakai. Harap pilih Username yang lainnya.');
            return redirect()->to('user');
        }

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);


        if($request->file('gambar') == '') {
            $gambar = NULL;
        } else {
            $file = $request->file('gambar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('gambar')->move("images/user", $fileName);
            $gambar = $fileName;
        }

        

        User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt(($request->input('password'))),
            'gambar' => $gambar,
            'level' => $request->input('level')
            
            
        ]);

        alert()->success('Berhasil.','Data telah ditambahkan!');
        return redirect()->to('user');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if((Auth::user()->level == 'user') && (Auth::user()->id != $id)) {
                Alert::info('Maaf', 'Anda dilarang masuk halaman ini');
                return redirect()->to('/');
        }

        $data = User::findOrFail($id);

        return view('auth.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if((Auth::user()->level == 'user') && (Auth::user()->id != $id)) {
                Alert::info('Maaf', 'Anda dilarang masuk halaman ini');
                return redirect()->to('/');
        }

        $data = User::findOrFail($id);

        return view('auth.edit', compact('data'));
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
        if($request->file('gambar')){
            $file = $request->file('gambar');
            $dt = Carbon::now();
            $request->file('gambar')->move("images/user");
        }else{
            $cover = NULL;
        }

        User::find($id)->update([
            'name' => $request->get('name'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('penerbit')),
            'cover' => $request->get('gambar'),
            'level' => $request->get('level'),
        ]);

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->to('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->id != $id) {
            $user_data = User::find($id)->delete();

            alert()->success('Success', 'Data Anggota Berhasil Dihapus');

        } else {

            alert()->warning('Maaf', 'Anda tidak bisa menghapus akun anda sendiri');

        }
        return redirect()->to('user');


    }
}
