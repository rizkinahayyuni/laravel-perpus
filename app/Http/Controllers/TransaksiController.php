<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
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

    public function index()
    {
        if(Auth::user()->level == 'anggota')
        {
            $datas = Transaksi::where('anggota_id', Auth::user()->anggota->id)
                                ->get();
        } else {
            $datas = Transaksi::get();
        }
        return view('transaksi.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getRow = Transaksi::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "TR00001";
        
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $kode = "TR0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $kode = "TR000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $kode = "TR00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $kode = "TR0".''.($lastId->id + 1);
            } else {
                    $kode = "TR".''.($lastId->id + 1);
            }
        }

        $bukus = Buku::where('jumlah_buku', '>', 0)->get();
        $anggotas = Anggota::get();
        return view('transaksi.create', compact('bukus', 'kode', 'anggotas'));
    }

    /**
     *  TRANSAKSI HILANG
     */
    
    public function indexhilang()
    {
        if(Auth::user()->level == 'anggota')
        {
            $datas = Transaksi::where('anggota_id', Auth::user()->anggota->id)
                                ->get();
        } else {
            $datas = Transaksi::where('status','hilang')->get();
        }
        return view('transaksihilang.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createNewBook(Request $request, $id)
    {
        if(Auth::user()->level == 'user'){
            Alert::info('Oppss..', 'Anda dilarang masuk ke halaman ini.');
            return redirect()->to('/');
        }
        $data = Transaksi::findOrFail($id);
        return view('transaksihilang.createbaru', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeNewBook(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|string|max:255',
            'isbn' => 'required|string'
        ]);

        if($request->file('cover')){
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak;
            $request->file('cover')->move("images/buku", $fileName);
            $cover = $fileName;
        }else{
            $cover = NULL;
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

        alert()->success('Berhasil.','Data telah ditambahkan!');

        return redirect()->route('transaksihilang');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updategantibuku(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);

        $transaksi->update([
                'status' => 'kembali'
                ]);

        $transaksi->buku->where('id', $transaksi->buku->id)
                        ->update([
                            'jumlah_buku' => ($transaksi->buku->jumlah_buku),
                            ]);

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('transaksihilang');
    }

    /**
     *  END TRANSAKSI HILANG
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_transaksi' => 'required|string|max:255',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
            'buku_id' => 'required',
            'anggota_id' => 'required',

        ]);

        $transaksi = Transaksi::create([
                'kode_transaksi' => $request->get('kode_transaksi'),
                'tgl_pinjam' => $request->get('tgl_pinjam'),
                'tgl_kembali' => $request->get('tgl_kembali'),
                'buku_id' => $request->get('buku_id'),
                'anggota_id' => $request->get('anggota_id'),
                'ket' => $request->get('ket'),
                'status' => 'pinjam'
            ]);

        $transaksi->buku->where('id', $transaksi->buku_id)
                        ->update([
                            'jumlah_buku' => ($transaksi->buku->jumlah_buku - 1),
                            ]);

        alert()->success('Berhasil.','Data telah ditambahkan!');
        return redirect()->route('transaksi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Transaksi::findOrFail($id);

        if((Auth::user()->level == 'user') && (Auth::user()->anggota->id != $data->anggota_id)) {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }

        return view('transaksi.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Transaksi::findOrFail($id);

        if((Auth::user()->level == 'user') && (Auth::user()->anggota->id != $data->anggota_id)) {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }

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
        $transaksi = Transaksi::find($id);

        $transaksi->update([
                'status' => 'kembali'
                ]);

        $transaksi->buku->where('id', $transaksi->buku->id)
                        ->update([
                            'jumlah_buku' => ($transaksi->buku->jumlah_buku + 1),
                            ]);

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('transaksi.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatehilang(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);

        $transaksi->update([
                'status' => 'hilang'
                ]);

        $transaksi->buku->where('id', $transaksi->buku->id)
                        ->update([
                            'jumlah_buku' => ($transaksi->buku->jumlah_buku),
                            ]);

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('transaksi.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateterlambat(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);

        $transaksi->update([
                'status' => 'terlambat'
                ]);

        $transaksi->buku->where('id', $transaksi->buku->id)
                        ->update([
                            'jumlah_buku' => ($transaksi->buku->jumlah_buku),
                            ]);

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('transaksi.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaksi::find($id)->delete();
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('transaksi.index');
    }
}
