<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Buku;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class BukuController extends Controller
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
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        } 

        $datas = Buku::where([
            ['judul', '!=', Null],
            [function ($query) use ($request) {
                if (($keyword = $request->keyword)) {
                    $query->orWhere('judul','LIKE','%'.$keyword.'%')
                    ->orWhere('isbn','LIKE','%'.$keyword.'%')
                    ->orWhere('penerbit','LIKE','%'.$keyword.'%')
                    ->orWhere('pengarang','LIKE','%'.$keyword.'%')
                    ->orWhere('tahun_terbit','LIKE','%'.$keyword.'%')
                    ->orWhere('lokasi','LIKE','%'.$keyword.'%')->get();
                }
            }]
        ])
            ->orderBy("judul", "desc")
            ->paginate(10);
        return view('buku.index', compact('datas'))
            ->with('i', (request()->input('page', 1)-1)*5);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->level == 'user'){
            Alert::info('Oppss..', 'Anda dilarang masuk ke halaman ini.');
            return redirect()->to('/');
        }

        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|string|max:255',
            'isbn' => 'required|string'
        ]);

        if($request->file('cover') == ''){
            $cover = NULL;
        }else{
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak;
            $request->file('cover')->move("images/buku", $fileName);
            $cover = $fileName;
        }
        
        Buku::create([
            'judul' => $request->get('judul'),
            'isbn' => $request->get('isbn'),
            'pengarang' => $request->get('pengarang'),
            'penerbit' => $request->get('penerbit'),
            'tahun_terbit' => $request->get('tahun_terbit'),
            'jumlah_buku' => $request->get('jumlah_buku'),
            'deskripsi' => $request->get('deskripsi'),
            'lokasi' => $request->get('lokasi'),
            'cover' => $cover
        ]);

        alert()->success('Berharil.','Data telah ditambahkan!');

        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        $data = Buku::findOrFail($id);

        return view('buku.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->level == 'user'){
            Alert::info('Ooppss..', 'Anda dilarang masuk ke halaman ini!');
            return redirect()->to('/');
        }

        $data = Buku::findOrFail($id);
        return view('buku.edit', compact('data'));
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
        if($request->file('cover')){
            $file = $request->file('cover');
            $dt = Carbon::now();
            $request->file('cover')->move("images/buku");
        }else{
            $cover = NULL;
        }

        Buku::find($id)->update([
            'judul' => $request->get('judul'),
            'isbn' => $request->get('isbn'),
            'pengarang' => $request->get('pengarang'),
            'penerbit' => $request->get('penerbit'),
            'tahun_terbit' => $request->get('tahun_terbit'),
            'jumlah_buku' => $request->get('jumlah_buku'),
            'deskripsi' => $request->get('deskripsi'),
            'lokasi' => $request->get('lokasi'),
            'cover' => $request->get('cover'),
        ]);

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Buku::find($id)->delete();
        return redirect()->route('buku.index')-> with('Success', 'Data Buku Berhasil Dihapus!');
    }
}
