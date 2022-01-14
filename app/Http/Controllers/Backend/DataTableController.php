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
use App\Models\Admin;
use App\Models\presensi;
use App\Models\RekapKehadiran;

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
            $datas = Jadwal::with(['matakuliah','ruangan','kelas','dosens','hari'])->get();
           
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('jam',function($row){
                    $jam = \App\Helpers\GeneralHelper::format_time_2digit($row->jam_mulai).' - '.\App\Helpers\GeneralHelper::format_time_2digit($row->jam_selesai).' WIB';
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
                ->addColumn('hari',function($row){
                    $hari    = (isset($row->hari->nama_hari))?$row->hari->nama_hari:'';
                    return $hari;
                })
                ->addColumn('kelas',function($row){
                    $kelas   = (isset($row->kelas->nama_kelas))?$row->kelas->nama_kelas:'';
                    return $kelas;
                })
                ->addColumn('sks',function($row){
                    $sks   = (isset($row->matakuliah->sks))?$row->matakuliah->sks:'';
                    return $sks;
                })
                ->addColumn('dosen',function($row){
                    $nama       = (isset($row->dosens->nama))?$row->dosens->nama:'';
                    $depan      = (isset($row->dosens->gelar_depan))?$row->dosens->gelar_depan:'';
                    $belakang   = (isset($row->dosens->gelar_belakang))?$row->dosens->gelar_belakang:'';
                    $dosen      = $depan.$nama.$belakang;
                    return $dosen;
                })
               
              /*->addColumn('jam_presensi_dibuka',function($row){
                    $jam_presensi_dibuka   = (isset($row->jam_presensi_dibuka))?\App\Helpers\GeneralHelper::format_time_2digit($row->jam_presensi_dibuka).' WIB':'<span class="badge badge-pill badge-warning">Belum Disetting</span>';
                    return $jam_presensi_dibuka;
                })
                ->addColumn('jam_presensi_ditutup',function($row){
                    $jam_presensi_ditutup   = (isset($row->jam_presensi_ditutup))?\App\Helpers\GeneralHelper::format_time_2digit($row->jam_presensi_ditutup).' WIB':'<span class="badge badge-pill badge-warning">Belum Disetting</span>';
                    return $jam_presensi_ditutup;
                })
                ->addColumn('toleransi',function($row){
                    $toleransi   = (isset($row->toleransi))?$row->toleransi:'<span class="badge badge-pill badge-warning">Belum Disetting</span>';
                    return $toleransi;
                })*/
                ->addColumn('action', function($row){
                    $ids = \Crypt::encrypt($row->kode_jadwal);
                    $btn = '<button type="button" class="edit btn btn-sm btn-default" data-id="'.$ids.'" data-kode_jadwal="'.$row->kode_jadwal.'" data-kode_matakuliah="'.$row->kode_matakuliah.'" data-hari_id="'.$row->hari_id.'" data-jam_mulai="'.$row->jam_mulai.'" data-jam_selesai="'.$row->jam_selesai.'" data-kode_ruang="'.$row->kode_ruang.'" data-kelas_id="'.$row->kelas_id.'" data-dosen="'.$row->dosen.'"> <i class="fas fa-edit"></i> Edit</button>
                            <button type="button" class="hapus btn btn-sm btn-danger" data-id="'.$ids.'"> <i class="fas fa-trash"></i> Hapus</button>';
                    return $btn;
                })
                ->addColumn('action2', function($row){
                    $ids = \Crypt::encrypt($row->kode_jadwal);
                    if($row->status == 'nonaktif'){
                        $btn = ' <button id="generate-pertemuan" class="generate-pertemuan btn btn-sm btn-icon btn-primary" data-id="'.$ids.'" data-kode_jadwal="'.$row->kode_jadwal.'" data-hari_id="'.$row->hari_id.'" data-jam_mulai="'.$row->jam_mulai.'" type="button">
                                    <span class="btn-inner--icon"><i class="fas fa-sync-alt"></i></span>
                                    <span class="btn-inner--text">Generate pertemuan</span>
                                </button>';
                           /*     <button type="button" class="edit btn btn-sm btn-default" data-id="'.$ids.'" data-kode_jadwal="'.$row->kode_jadwal.'" data-kode_matakuliah="'.$row->kode_matakuliah.'" data-matakuliah="'.$row->matakuliah->nama_matakuliah.'" data-hari="'.$row->hari->nama_hari.'" data-jam_mulai="'. \App\Helpers\GeneralHelper::format_time_2digit($row->jam_mulai).'" data-jam_selesai="'.\App\Helpers\GeneralHelper::format_time_2digit($row->jam_selesai).'" data-ruangan="'.$row->ruangan->nama_ruang.'" data-kelas="'.$row->kelas->nama_kelas.'" data-dosen="'.$row->dosens->nama.'"> <i class="ni ni-settings"></i> Setting </button>
                                <a href="presensi/'.$ids.'" class="btn btn-sm btn-success"> <i class="fas fa-eye"></i> Lihat Presensi</a>*/
                    }else{
                        $btn = '<a href="presensi/'.$ids.'" class="btn btn-sm btn-success"> <i class="fas fa-eye"></i> Lihat Presensi</a>';
                    }
                   
                    return $btn;
                })
                ->addColumn('action3', function($row){
                    $ids = \Crypt::encrypt($row->kode_jadwal);
                    if($row->status == 'nonaktif'){
                        $btn = '<a href="#" class="btn btn-sm btn-success" disabled> <i class="fas fa-eye"></i> Lihat Berita Acara</a>';
                    }else{
                        $btn = '<a href="beritaacara/'.$ids.'" class="btn btn-sm btn-success"> <i class="fas fa-eye"></i> Lihat Berita Acara</a>';
                    }
                   
                    return $btn;
                })
                ->rawColumns(['action','action2','action3'])
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
                ->addColumn('hari',function($row){
                    $hari = (isset($row->jadwal->hari->nama_hari))?$row->jadwal->hari->nama_hari:'';
                    return $hari;
                })
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
                    $nama       = (isset($row->jadwal->dosens->nama))?$row->jadwal->dosens->nama:'';
                    $depan      = (isset($row->jadwal->dosens->gelar_depan))?$row->jadwal->dosens->gelar_depan:'';
                    $belakang   = (isset($row->jadwal->dosens->gelar_belakang))?$row->jadwal->dosens->gelar_belakang:'';
                    $dosen      = $depan.$nama.$belakang;
                    return $dosen;
                })
                ->addColumn('action', function($row){
                    $ids = \Crypt::encrypt($row->id);
                    $btn = '<button type="button" class="hapus btn btn-sm btn-danger" data-id="'.$ids.'"> <i class="fas fa-trash"></i> Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->escapeColumns()
                ->toJson();
        }
    }


     /**
     * Datatable admin
     *
     * @return \Illuminate\Http\Response
     */
    public function admin(Request $request)
    {
        if ($request->ajax()) {
            $datas = Admin::all();
           
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
                ->addColumn('status',function($row){
                    if($row->status == 0){
                        $status = '<span class="badge badge-danger">Non Aktif</span>';
                    }elseif($row->status == 1){
                        $status = '<span class="badge badge-success">Aktif</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $ids = \Crypt::encrypt($row->nik);
                    $btn = '<button type="button" class="edit btn btn-sm btn-default" data-id="'.$ids.'" data-nik="'.$row->nik.'" data-nip="'.$row->nip.'" data-nama="'.$row->nama.'" data-foto="'.$row->foto.'" data-email="'.$row->email.'" data-status="'.$row->status.'" data-url="'.config('services.image.baseUrl').config('services.image.path').'/'.$row->foto.'"> <i class="fas fa-edit"></i> Edit</button>
                            <button type="button" class="hapus btn btn-sm btn-danger" data-id="'.$ids.'"> <i class="fas fa-trash"></i> Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action','gambar','status'])
                ->escapeColumns()
                ->toJson();
        }
    }



     /**
     * Datatable Presesnsi by kode jadwal
     *
     * @return \Illuminate\Http\Response
     */
    public function presensi(Request $request)
    {
        if ($request->ajax()) {
            $ids   = \Crypt::decrypt($request->presensi_id);
            $datas = RekapKehadiran::with(['mahasiswa'])->where('presensi_id',$ids)->get();
           
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('nim',function($row){
                    $nim = (isset($row->mahasiswa->nim))?$row->mahasiswa->nim:'';
                    return $nim;
                })
                ->addColumn('nama',function($row){
                    $nama = (isset($row->mahasiswa->nama))?$row->mahasiswa->nama:'';
                    return $nama;
                })
                ->addColumn('hadir',function($row){
                    $hadir = $row->kode_status_presensi=='H'?'V':'-';
                    return $hadir;
                })
                ->addColumn('izin',function($row){
                    $izin = $row->kode_status_presensi=='I'?'V':'-';
                    return $izin;
                })
                ->addColumn('alfa',function($row){
                    $alfa = $row->kode_status_presensi=='A'?'V':'-';
                    return $alfa;
                })
                ->addColumn('tanggal_presensi',function($row){
                    if(isset($row->tanggal_presensi)){
                        $tanggal_presensi = \App\Helpers\GeneralHelper::tgl_indo(date('Y-m-d',strtotime($row->tanggal_presensi)));
                    }else{
                        $tanggal_presensi = '-';
                    }
                   
                    return $tanggal_presensi;
                })
                ->addColumn('jam_presensi',function($row){
                    if(isset($row->jam_presensi)){
                        $jam_presensi = \App\Helpers\GeneralHelper::format_time_2digit($row->jam_presensi);
                    }else{
                        $jam_presensi = '-';
                    }
                    return $jam_presensi;
                })
                ->addColumn('action', function($row){
                    $ids = \Crypt::encrypt($row->id);
                    $btn = '<button type="button" class="hapus btn btn-sm btn-danger" data-id="'.$ids.'"> <i class="fas fa-trash"></i> Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->escapeColumns()
                ->toJson();
        }
    }



}
