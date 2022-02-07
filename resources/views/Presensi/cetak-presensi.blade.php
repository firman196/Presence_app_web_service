
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title>Rekap Presensi</title>
    <style>
    html, body {
        background-color: #fff;
        color: #000;
        font-family: 'Times New Roman', Times, serif;
        font-weight: 100;
        font-size: 0.9em;
        height: 100vh;
        margin: 0;
    }
    table th,
    table td{
        text-align: left;
        font-family: 'Times New Roman', Times, serif;
        font-size:12px;
        font-weight: normal;
        color: #000;
    }
    table.layout{
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #000;
    }
      
    table.display th{
        border: 1px solid #000;
        padding: 0.2em 0.2em;
        font-family: 'Times New Roman', Times, serif;
        font-size:12px;
    }
    table.display td{
        border: 1px solid #000;
        padding: 0.2em 0.2em;
        font-family: 'Times New Roman', Times, serif;
        font-size:12px;
    }
​
    table.display th{ background: #D5E0CC; }
    table.display td{ background: #fff; }
​
    table.responsive-table{
        box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
    }
    h1{
        font-family: 'Times New Roman', Times, serif;
        font-size:40px;
    }
    h3{
        font-family: 'Times New Roman', Times, serif;
        font-size:22px;
        font-weight: bold;
    }
    h4{
        font-family: 'Times New Roman', Times, serif;
        font-size:20px;
    }
    h5{
        font-family: 'Times New Roman', Times, serif;
        font-size:15px;
    }
    p{
        font-family: 'Times New Roman', Times, serif;
        font-size:14px;
        font-weight: normal;
        color: #000;
        padding: 0;
        letter-spacing: 1px;
    }
    .full-height {
        height: 90vh;
    }
    .d-flex{
        display: flex;
        padding: 0em;
    }
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }
    .position-ref {
        position: relative;
    }
    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }
    .content {
        text-align: center;
    }
    .title {
        font-size: 84px;
    }
    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }
    .m-b-md {
        margin-bottom: 30px;
    }
    .heading{
        display: flex;
        align-items: center;
        justify-content: center;
       
    }
    .heading img{
        display: flex;
    }
    .heading h3{
        display: flex;
        text-align: left;
        margin-left: 4em;
        letter-spacing:0.1em;
    }
    .title-content{
        text-align: center;
    }
    </style>
</head>
<body style="margin: 0.5in 0.5in 0.5in 0.5in;">
    <header class="heading">
        <img src="{{public_path('assets/img/logo/logo.png')}}" width="40" height="40" alt="akakom logo">
        <h3>UTDI</h3>
    </header>

    <div style="margin-top: -6em">
        <div class="title-content">
            <h4>Presensi Mahasiswa</h4>                    
           
        </div>
        @if(empty($presensi))
            <div class="page">
                <div class="header" style="margin-bottom:2em">
                    {{-- <header class="heading">
                        <img src="{{ url('./images/akakomlogo.png') }}" width="24%" height="24%" alt="akakom logo" style="margin-left:2em">
                    </header> --}}
                </div>
                <div class="main">
                    <h2 style="text-align: center">MAAF DATA TIDAK TERSEDIA  !!</h2>
                </div>
                
            </div>
        @else
            <table>
                <tr>
                    <th>Matakuliah</th>
                    <td style="width: 2em;">:</td>
                    <td>{{$presensi->jadwal->matakuliah->kode_matakuliah}} - {{ $presensi->jadwal->matakuliah->nama_matakuliah }}</td>
                </tr>
                
                <tr>
                    <th>Hari, Tanggal Pertemuan</th>
                    <td>:</td>
                    <td>{{ $presensi->hari->nama_hari }}, {{ (isset($presensi->tanggal_pertemuan))?\App\Helpers\GeneralHelper::tgl_indo(date('Y-m-d',strtotime($presensi->tanggal_pertemuan))):'-' }}</td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>:</td>
                    <td>{{ $presensi->jadwal->kelas->nama_kelas }}</td>
                </tr>
                <tr>
                    <th>Pertemuan Ke</th>
                    <td>:</td>
                    <td>{{ $presensi->pertemuan_ke }}</td>
                </tr>
                
                <tr>
                    <th>Dosen</th>
                    <td>:</td>
                    <td>{{ $presensi->jadwal->dosens->gelar_depan }} {{ $presensi->jadwal->dosens->nama }}, {{ $presensi->jadwal->dosens->gelar_belakang }}</td>
                </tr>
            </table>
            
            <table rules="cols" class="layout display responsive-table" style="margin-top:1em;background-color:#dfdfdf !important">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 5%;">No</th>
                        <th style="text-align: center; width: 15%;">NIM</th>
                        <th style="text-align: center; width: 25%;">Nama Mahasiswa</th>
                        <th style="text-align: center; width: 5%;">Hadir</th>
                        <th style="text-align: center; width: 5%;">Izin</th>
                        <th style="text-align: center; width: 5%;">Alpha</th>
                        <th style="text-align: center; width: 25%;">Tanggal Presensi</th>
                        <th style="text-align: center; width: 15%;">Jam Presensi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kehadirans as $data)
                        <tr>
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td>{{ $data->mahasiswa->nim}}</td>
                            <td>{{ $data->mahasiswa->nama}}</td>
                            <td style="text-align: center">{{ ($data->kode_status_presensi == 'H')?'V':'-'}}</td>
                            <td style="text-align: center">{{ ($data->kode_status_presensi == 'I')?'V':'-'}}</td>
                            <td style="text-align: center">{{ ($data->kode_status_presensi == 'A')?'V':'-'}}</td>
                            <td style="text-align: center">{{\App\Helpers\GeneralHelper::tgl_indo(date('Y-m-d',strtotime($data->tanggal_presensi)))}}</td>
                            <td style="text-align: center">{{ \App\Helpers\GeneralHelper::format_time_2digit($data->jam_presensi) }} WIB</td>
                        </tr>
                    @endforeach
                </tbody>
               
            </table>  
            
        @endif
    </div>
</body>
</html>




