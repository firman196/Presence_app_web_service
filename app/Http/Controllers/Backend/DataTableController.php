<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Beacon;
use App\Models\Dosen;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\JenisIzin;
use App\Models\Mahasiswa;
use App\Models\Ruangan;
use App\Models\Krs;

class DataTableController extends Controller
{
    /**
     * DATATABLE HARI
     *
     * @return \Illuminate\Http\Response
     */
    public function hari(Request $request)
    {
        if ($request->ajax()) {
            $datas = Hari::all();

            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $ids = \Crypt::encrypt($row->id);
                    $btn = '<button type="button" class="edit btn btn-sm btn-default" data-id="'.$ids.'" data-nama="'.$row->nama_hari.'"> <i class="fas fa-edit"></i> Edit</button>
                            <button type="button" class="hapus btn btn-sm btn-danger" data-id="'.$ids.'"> <i class="fas fa-trash"></i> Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->escapeColumns()
                ->toJson();
        }
    }

    
    /**
     * DATATABLE MAHASISWA
     *
     * @return \Illuminate\Http\Response
     */
    public function dataTableMahasiswa(Request $request)
    {
        if ($request->ajax()) {
            $datas = Mahasiswa::all();

            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('gambar', function($row){
                    $url = config('services.image.baseUrl').config('services.image.path').'/'.$row->foto;
                    if(isset($row->foto)){
                        $img = '<img style="max-height:70px;max-width:120px;" src="'.$url.'"></img>';
                    }else{
                        $img = '<img style="max-height:70px;max-width:120px;" src="'.url('assets/img/icons/precence_app/add-product.png').'"></img>';
                    }
                    return $img;
                })
               
                ->addColumn('action', function($row){
                    $btn = '<a class="btn btn-sm btn-outline-primary" href="#"> <i class="fas fa-eye"></i> view</a> 
                            <button type="button" class="edit btn btn-sm btn-default" data-id="'.\Crypt::encrypt($row->nim).'" data-nim="'.$row->nim.'" data-nama="'.$row->nama.'" data-foto="'.$row->foto.'" data-kode_prodi="'.$row->kode_prodi.'" data-kelas_id="'.$row->kelas_id.'" data-semester="'.$row->semester.'" data-telp="'.$row->telp.'" data-email="'.$row->email.'" data-dosen="'.$row->dosen.'" data-foto="'.$row->foto.'" data-status="'.$row->status.'" data-url="'.config('services.image.baseUrl').config('services.image.path').'/'.$row->foto.'"> <i class="fas fa-edit"></i> Edit</button>
                            <button type="button" class="hapus btn btn-sm btn-danger" data-id="'.\Crypt::encrypt($row->nim).'"> <i class="fas fa-trash"></i> Hapus</button>';
                    return $btn;
                })
                ->addColumn('action2', function($row){
                    $ids = \Crypt::encrypt($row->nim);
                    $btn = '<a href="/krs/'.$ids.'" class="hapus btn btn-sm btn-success"> <i class="fas fa-eye"></i> Tambah Krs</a>';
                    return $btn;
                })
                ->rawColumns(['action','action2','gambar'])
                ->escapeColumns()
                ->toJson(); 
        }
        
    }

     /**
     * DATATABLE DOSEN
     *
     * @return \Illuminate\Http\Response
     */
    public function dataTableDosen(Request $request)
    {
        if ($request->ajax()) {
            $datas = Dosen::all();

            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('gambar', function($row){
                    $url = config('services.image.baseUrl').config('services.image.path').'/'.$row->foto;
                    if(isset($row->foto)){
                        $img = '<img style="max-height:70px;max-width:120px;" src="'.$url.'"></img>';
                    }else{
                        $img = '<img style="max-height:70px;max-width:120px;" src="'.url('assets/img/icons/precence_app/add-product.png').'"></img>';
                    }
                    
                    return $img;
                })
                ->addColumn('prodi',function($row){
                    $prodi = $row->prodi->nama_prodi;
                    return $prodi;
                })
                ->addColumn('action', function($row){
                    $ids = \Crypt::encrypt($row->nik);
                    $btn = '<button type="button" class="edit btn btn-sm btn-default" data-id="'.$ids.'" data-nik="'.$row->nik.'" data-nip="'.$row->nip.'" data-nama="'.$row->nama.'" data-pendidikan="'.$row->jenjang_pendidikan.'" data-kode_prodi="'.$row->kode_prodi.'" data-gelar_depan="'.$row->gelar_depan.'" data-gelar_belakang="'.$row->gelar_belakang.'" data-foto="'.$row->foto.'" data-telp="'.$row->telp.'" data-email="'.$row->email.'" data-status="'.$row->status.'" data-url="'.config('services.image.baseUrl').config('services.image.path').'/'.$row->foto.'"> <i class="fas fa-edit"></i> Edit</button>
                            <button type="button" class="hapus btn btn-sm btn-danger" data-id="'.$ids.'"> <i class="fas fa-trash"></i> Hapus</button>';
                    return $btn;
                })
                ->addColumn('nama_dosen',function($row){
                    $name = $row->gelar_depan.$row->nama.$row->gelar_belakang;
                    return $name;
                })
                ->rawColumns(['action','gambar'])
                ->escapeColumns()
                ->toJson();
        }
    }

    /**
     * DATATABLE JENIS IZIN
     *
     * @return \Illuminate\Http\Response
     */
    public function jenisIzin(Request $request)
    {
        if ($request->ajax()) {
            $datas = JenisIzin::orderBy('kode','asc')->get();

            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = \Crypt::encrypt($row->kode);
                    $btn = '<button type="button" class="edit btn btn-sm btn-default" data-id="'.$id.'" data-kode="'.$row->kode.'" data-keterangan="'.$row->keterangan.'"> <i class="fas fa-edit"></i> Edit</button>
                            <button type="button" class="hapus btn btn-sm btn-danger" data-id="'.$id.'"> <i class="fas fa-trash"></i> Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->escapeColumns()
                ->toJson(); 
        }
    }


    /**
     * DATATABLE RUANGAN
     *
     * @return \Illuminate\Http\Response
     */
    public function ruangan(Request $request)
    {
        if ($request->ajax()) {
            $datas = Ruangan::with(['prodi','beacon'])->get();
           
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('prodi',function($row){
                    $prodi = (isset($row->prodi->nama_prodi))?$row->prodi->nama_prodi:'';
                    return $prodi;
                })
                ->addColumn('jumlah_beacon',function($row){
                    $beacon = (isset($row->beacon))?$row->beacon->count():0;
                    return $beacon;
                })
                ->addColumn('action', function($row){
                    $ids = \Crypt::encrypt($row->kode_ruang);
                    $btn = '<button type="button" class="edit btn btn-sm btn-default" data-id="'.$ids.'" data-kode="'.$row->kode_ruang.'" data-nama_ruang="'.$row->nama_ruang.'" data-kapasitas_ruang_kuliah="'.$row->kapasitas_ruang_kuliah.'" data-kapasitas_ruang_ujian="'.$row->kapasitas_ruang_ujian.'" data-kode_prodi="'.$row->kode_prodi.'" data-nama_gedung="'.$row->nama_gedung.'"> <i class="fas fa-edit"></i> Edit</button>
                            <button type="button" class="hapus btn btn-sm btn-danger" data-id="'.$ids.'"> <i class="fas fa-trash"></i> Hapus</button>';
                    return $btn;
                })
                ->addColumn('action2', function($row){
                    $ids = \Crypt::encrypt($row->kode_ruang);
                    $btn = '<a href="/beacon/show/'.$ids.'" class="hapus btn btn-sm btn-success"> <i class="fas fa-eye"></i> Detail Beacon</a>';
                    return $btn;
                })
                ->rawColumns(['action','action2'])
                ->escapeColumns()
                ->toJson(); 
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prodi(Request $request)
    {
        if ($request->ajax()) {
            $datas = $this->prodi->getWithDosen();
           
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('kaprodi',function($row){
                    $dosen = (isset($row->dosen->nama))?$row->dosen->nama:'';
                    return $dosen;
                })
                ->addColumn('action', function($row){
                    $btn = '<button type="button" class="edit btn btn-sm btn-default" data-id="'.$row->kode_prodi.'" data-nama_prodi="'.$row->nama_prodi.'" data-jenjang="'.$row->jenjang.'" data-kaprodi="'.$row->kaprodi.'"> <i class="fas fa-edit"></i> Edit</button>
                            <button type="button" class="hapus btn btn-sm btn-danger" data-id="'.$row->kode_prodi.'"> <i class="fas fa-trash"></i> Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->escapeColumns()
                ->toJson(); 
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kelas(Request $request)
    {
        if ($request->ajax()) {
            $datas = $this->kelas->getAll();

            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<button type="button" class="edit btn btn-sm btn-default" data-id="'.$row->id.'" data-nama="'.$row->nama_kelas.'"> <i class="fas fa-edit"></i> Edit</button>
                            <button type="button" class="hapus btn btn-sm btn-danger" data-id="'.$row->id.'"> <i class="fas fa-trash"></i> Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->escapeColumns()
                ->toJson();
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function matakuliah(Request $request)
    {
        if ($request->ajax()) {
            $datas = $this->matakuliah->getWithProdi();
           
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('prodi',function($row){
                    $prodi = (isset($row->prodi->nama_prodi))?$row->prodi->nama_prodi:'';
                    return $prodi;
                })
                ->addColumn('action', function($row){
                    $id  = \Crypt::encrypt($row->kode_matakuliah);
                    $btn = '<button type="button" class="edit btn btn-sm btn-default" data-id="'.$id.'" data-kode="'.$row->kode_matakuliah.'" data-nama_matakuliah="'.$row->nama_matakuliah.'" data-sifat_matakuliah="'.$row->sifat_matakuliah.'" data-jenis_matakuliah="'.$row->jenis_matakuliah.'" data-sks="'.$row->sks.'" data-kode_prodi="'.$row->kode_prodi.'" data-semester="'.$row->semester.'"> <i class="fas fa-edit"></i> Edit</button>
                            <button type="button" class="hapus btn btn-sm btn-danger" data-id="'.$id.'"> <i class="fas fa-trash"></i> Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action','prodi'])
                ->escapeColumns()
                ->toJson();
        }
    }


     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jadwal(Request $request)
    {
        if ($request->ajax()) {
            $datas = Jadwal::all();
           
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('jam',function($row){
                    $jam = $row->jam_mulai.' - '.$row->jam_selesai;
                    return $jam;
                })
                ->addColumn('matakuliah',function($row){
                    $matakuliah = (isset($row->matakuliah->nama_matakuliah))?$row->matakuliah->nama_matakuliah:'';
                    return $matakuliah;
                })
                ->addColumn('ruang',function($row){
                    $ruangan    = (isset($row->ruangan->nama_ruang))?$row->ruangan->nama_ruang:'';
                    return $ruangan;
                })
                ->addColumn('kelas',function($row){
                    $kelas   = (isset($row->kelas->nama_kelas))?$row->kelas->nama_kelas:'';
                    return $kelas;
                })
                ->addColumn('dosen',function($row){
                    $nama       = (isset($row->dosen->nama))?$row->dosen->nama:'';
                    $depan      = (isset($row->dosen->gelar_depan))?$row->dosen->gelar_depan:'';
                    $belakang   = (isset($row->dosen->gelar_belakang))?$row->dosen->gelar_belakang:'';
                    $dosen      = $depan.$nama.$belakang;
                    return $dosen;
                })
                ->addColumn('action', function($row){
                    $ids = \Crypt::encrypt($row->kode_jadwal);
                    $btn = '<button type="button" class="edit btn btn-sm btn-default" data-id="'.$ids.'" data-kode_jadwal="'.$row->kode_jadwal.'" data-kode_matakuliah="'.$row->kode_matakuliah.'" data-hari_id="'.$row->hari_id.'" data-jam_mulai="'.$row->jam_mulai.'" data-jam_selesai="'.$row->jam_selesai.'" data-kode_ruang="'.$row->kode_ruang.'" data-kelas_id="'.$row->kelas_id.'" data-dosen="'.$row->dosen.'"> <i class="fas fa-edit"></i> Edit</button>
                            <button type="button" class="hapus btn btn-sm btn-danger" data-id="'.$ids.'"> <i class="fas fa-trash"></i> Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->escapeColumns()
                ->toJson();
        }
    }


     /**
     * Datatable beacon by kode ruang
     *
     * @return \Illuminate\Http\Response
     */
    public function beacon(Request $request,$id)
    {
        if ($request->ajax()) {
            $datas   = Beacon::where('kode_ruang',$id)->get();
           
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $ids = \Crypt::encrypt($row->kode_beacon);
                   
                    $btn = '<button type="button" class="edit btn btn-sm btn-default" data-id="'.$ids.'" data-kode_beacon="'.$row->kode_beacon.'" data-uuid="'.$row->uuid.'" data-major="'.$row->major.'" data-minor="'.$row->minor.'" > <i class="fas fa-edit"></i> Edit</button>
                            <button type="button" class="hapus btn btn-sm btn-danger" data-id="'.$ids.'"> <i class="fas fa-trash"></i> Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->escapeColumns()
                ->toJson(); 
        }
    }


     /**
     * Datatable Krs Mahasiswa By Nim
     *
     * @return \Illuminate\Http\Response
     */
    public function krs(Request $request)
    {
        if ($request->ajax()) {
            $ids   = \Crypt::decrypt($request->nim);
            $datas = Krs::with(['jadwal.matakuliah','jadwal.ruangan','jadwal.kelas','jadwal.dosens','jadwal.hari'])->where('nim',$ids)->get();
           
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('jam',function($row){
                    $jam = $row->jadwal->jam_mulai.' - '.$row->jadwal->jam_selesai;
                    return $jam;
                })
                ->addColumn('matakuliah',function($row){
                    $matakuliah = (isset($row->jadwal->matakuliah->nama_matakuliah))?$row->jadwal->matakuliah->nama_matakuliah:'';
                    return $matakuliah;
                })
                ->addColumn('ruang',function($row){
                    $ruangan    = (isset($row->jadwal->ruangan->nama_ruang))?$row->jadwal->ruangan->nama_ruang:'';
                    return $ruangan;
                })
                ->addColumn('kelas',function($row){
                    $kelas   = (isset($row->jadwal->kelas->nama_kelas))?$row->jadwal->kelas->nama_kelas:'';
                    return $kelas;
                })
                ->addColumn('dosen',function($row){
                    $nama       = (isset($row->jadwal->dosen->nama))?$row->jadwal->dosen->nama:'';
                    $depan      = (isset($row->jadwal->dosen->gelar_depan))?$row->jadwal->dosen->gelar_depan:'';
                    $belakang   = (isset($row->jadwal->dosen->gelar_belakang))?$row->jadwal->dosen->gelar_belakang:'';
                    $dosen      = $depan.$nama.$belakang;
                    return $dosen;
                })
                ->addColumn('action', function($row){
                    $btn = '<button type="button" class="tambah-matakuliah btn btn-sm btn-default" > <i class="fas fa-edit"></i> Edit</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->escapeColumns()
                ->toJson();
        }
    }


}
