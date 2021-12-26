@extends('Master.master-dashboard')
@section('page-content')
 
 <!-- Header -->
  <div class="header bg-primary ">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ $url }}">{{ $breadcrumb }}</a></li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-6 col-5 text-right">
            <a href="#" id="tambah" class="btn btn-sm btn-neutral">Tambah</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt-4">
    <div class="row">
      <div class="col">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <h3 class="mb-0">{{ $title }}</h3>
          </div>
          <!-- Light table -->
          <div class="table-responsive">
            <table class="table table-flush" id="dataTable">
              <thead class="thead-light">
                <tr>
                  <th>N0</th>
                  <th>NIM</th>
                  <th>NAMA</th>
                  <th>ANGKATAN</th>
                  <th>PRODI</th>
                  <th>KELAS</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
           </div>
          <!-- Card footer -->
         
        </div>
      </div>
    </div>
    
    
    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal-label"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="form-data" action="#" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group row">
                  <div class="col-md-4 pl-auto pr-auto">
                    <div class="logoset">
                      <div class="logo">
                        <input type="hidden" name="oldfoto" id="icon-old" value="">
                        <input type="file" name="foto" id="iconUpload" style="display:none;" accept="image/x-png,image/jpeg,image/jpg,image/svg" >
                        <div class="title">Foto<span style="color: red">*</span> </div>
                        <img id="logo" src="{{ url('assets/img/icons/image.png') }}" />
                        <button type="button" class="btn btn-sm btn-secondary btn-block logouploadbtn" onclick="$('#iconUpload').trigger('click')"> Ganti</button>
                        <div class="progress progreslogo" style="display:none;">
                          <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                    <span><small class="text-danger foto-error" id="foto-error"></small></span>
                  </div>
                  <div class="col-md-8 pl-auto pr-auto">
                    <h5>Keterangan :</h5>
                    <div class="mt-2">
                      <p class="mt-0 mb-0"><small>1. Foto wajib di isi</small></p>
                      <p class="mt-0 mb-0"><small>2. Extensi yang disupport hanya jpg,png,jpeg dan svg</small></p>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6 col-sm-12">
                    <label for="nim">NIM <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="nim" id="nim" placeholder="isikan nim">
                    <span class="text-danger" id="nim-error"></span>
                  </div>
                
                </div>
                <div class="form-group row">
                  <div class="col-md-12 col-sm-12">
                    <label for="nama">Nama Mahasiswa <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="isikan nama">
                    <span class="text-danger" id="nama-error"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6 col-sm-12">
                    <label for="prodi">Prodi <span style="color: red">*</span></label>
                    <select name="kode_prodi" id="prodi" class="form-control">
                      @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger" id="prodi-error"></span>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label for="kelas">Kelas <span style="color: red">*</span></label>
                    <select name="kelas_id" id="kelas" class="form-control">
                      @foreach ($kelass as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger" id="kelas-error"></span>
                  </div>
                </div>
                <div class="form-group row">
                
                  <div class="col-md-6 col-sm-12">
                    <label for="semester">Semester <span style="color: red">*</span></label>
                    <select name="semester" id="semester" class="form-control">
                      @for ($i = 0 ; $i<=8 ; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                      @endfor
                    </select>
                    <span class="text-danger" id="semester-error"></span>
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <label for="telp">No. Telp / No. Hp</label>
                    <input type="text" class="form-control" name="telp" id="telp" placeholder="isikan nomor telepon">
                    <span class="text-danger" id="telp-error"></span>
                  </div>
                </div>
              
                <div class="form-group row">
                  <div class="col-md-6 col-sm-12">
                    <label for="email">Email <span style="color: red">*</span></label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="isikan email">
                    <span class="text-danger" id="email-error"></span>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label for="password">Password <span style="color: red">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="isikan password">
                    <span class="text-danger" id="password-error"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6 col-sm-12">
                    <label for="dosen">Dosen</label>
                    <select name="dosen" id="dosen" class="form-control">
                      @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->nik }}">{{ $dosen->nama }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger" id="dosen-error"></span>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" id="status">
                      <option value="0">Non Aktif</option>
                      <option value="1">Aktif</option>
                    </select>
                    <span class="text-danger" id="status-error"></span>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <div class="text-right">
                <a href="#"id="submit-data" class="submit-data btn btn-primary ">Simpan</a>
            </div>
            </div>
        </form>
        </div>
      </div>
    </div>
    @endsection

    @section('page-script')
    <script>
        $(document).ready(function(){
            toastr.options = {
              "debug": false,
              "positionClass": "toast-bottom-full-width",
              "onclick": null,
              "fadeIn": 300,
              "fadeOut": 1000,
              "timeOut": 5000,
              "extendedTimeOut": 1000
            }
            fetch_data();
           
            //fetch data method
            function fetch_data(){                    
                $('#dataTable').DataTable({
                    pageLength: 10,
                    lengthChange: true,
                    bFilter: true,
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    oLanguage: {
                        sZeroRecords: "Tidak Ada Data",
                        sSearch: "Pencarian _INPUT_",
                        sLengthMenu: "_MENU_",
                        sInfo: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        sInfoEmpty: "0 data",
                        oPaginate: {
                            sNext: "<i class='fa fa-angle-right'></i>",
                            sPrevious: "<i class='fa fa-angle-left'></i>"
                        }
                    },
                    ajax: {
                        url:"{{route('mahasiswa.datatable')}}",
                        type: "GET"
                    },
                                
                                columns: [
                                    { 
                                        data: 'DT_RowIndex',
                                        name: 'DT_Row_Index', 
                                        "className": "text-center" 
                                    },
                                    {
                                        data: 'nim',
                                        "className": "text-center"                                        
                                    },
                                    {
                                        data: 'nama',
                                        "className": "text-center"                                        
                                    },
                                    {
                                        data: 'kode_prodi',
                                        "className": "text-center"      
                                    },
                                    {
                                        data: 'kelas_id',
                                        "className": "text-center"      
                                    },
                                    {
                                        data: 'semester',
                                        "className": "text-center"      
                                    },
                                   
                                    {
                                        data: 'action2',
                                        "className": "text-center",
                                        orderable: false, 
                                        searchable: false    
                                    },
                                ]
                            });
                         
                        }


        })
                 
               </script>
            @endsection












