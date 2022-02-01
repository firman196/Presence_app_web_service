@extends('Master.master-dashboard')
@section('page-content')
 
 <!-- Header -->
  <div class="header bg-default ">
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
                  <th>SEMESTER</th>
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
          <form id="form-mahasiswa" action="#" method="post">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group row">
                  <div class="col-md-6 col-sm-12">
                    <label for="nim">NIM <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="nim" id="nim" placeholder="isikan nim">
                    <span class="text-danger" id="nim-error"></span>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label for="nik">NIK <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="nik" id="nik" placeholder="isikan nik">
                    <span class="text-danger" id="nik-error"></span>
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
                    <label for="angkatan">Angkatan <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="angkatan" id="angkatan" placeholder="isikan angkatan">
                    <span class="text-danger" id="angkatan-error"></span>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label for="semester">Semester <span style="color: red">*</span></label>
                    <select name="semester" id="semester" class="form-control">
                      @for ($i = 0 ; $i<=8 ; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                      @endfor
                    </select>
                    <span class="text-danger" id="semester-error"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12 col-sm-12">
                    <label for="alamat">Alamat <span style="color: red">*</span></label>
                    <textarea class="form-control" name="alamat"  id="alamat" aria-label="With textarea"></textarea>
                    <span class="text-danger" id="alamat-error"></span>
                  </div>
                </div>
              
                <div class="form-group row">
                  <div class="col-md-6 col-sm-12">
                    <label for="agama">Agama <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="agama" id="agama" placeholder="isikan agama">
                    <span class="text-danger" id="agama-error"></span>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label for="jenis_kelamin">Jenis Kelamin <span style="color: red">*</span></label>
                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                      <option value="L">Laki-Laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                    <span class="text-danger" id="jenis-kelamin-error"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6 col-sm-12">
                    <label for="kode_pos">Kode Pos</label>
                    <input type="text" class="form-control" name="kode_pos" id="kode_pos" placeholder="isikan kode pos">
                    <span class="text-danger" id="kode-pos-error"></span>
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
              <button type="button" id="submit-mahasiswa" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
      </div>
    </div>
    @endsection

    @section('page-script')
                <script>
                      $(document).ready(function(){
                      //get data table
                      fetch_data();

                      $('#tambah').on('click',function(e){
                          $('#Modal').modal();
                          $('#modal-label').html('Tambah Data Mahasiswa');
                          reset_model_value()
                          $('#submit-mahasiswa').on('click',function(e){
                            reset_error()
                                $.ajax({
                                    url:"{{ route('mahasiswa.store') }}",
                                    data:$("#form-mahasiswa").serialize(),
                                    type:"POST",
                                    success : function(data){
                                      
                                        //validasi modal
                                        if(data.errors) {
                                              error_message(JSON.parse(data.errors));
                                        }
                                        if(data.success){
                                            window.location = data.url;
                                        }
                                    },
                                    error:function(XMLHttpRequest){
                                        console.log(XMLHttpRequest.responseText);
                                    }
                                });
                             })
                      });

                      $('#dataTable tbody').on('click', '.edit', function () {
                          $('#Modal').modal();
                          $('#modal-label').html('Edit Data Mahasiswa');
                          $('#submit-user').html('Update Mahasiswa');
                          reset_model_value()
                         
                          var nim             = $(this).data('id');
                          var nik             = $(this).data('nik');
                          var nama            = $(this).data('nama');
                          var angkatan        = $(this).data('angkatan');
                          var kode_prodi      = $(this).data('kode_prodi');
                          var kelas_id        = $(this).data('kelas_id');
                          var alamat          = $(this).data('alamat');
                          var kode_pos        = $(this).data('kode_pos');
                          var agama           = $(this).data('agama');
                          var jenis_kelamin   = $(this).data('jenis_kelamin');
                          var semester        = $(this).data('semester');
                          var telp            = $(this).data('telp');
                          var email           = $(this).data('email');
                          var dosen           = $(this).data('dosen');
                          var foto            = $(this).data('foto');
                          var status          = $(this).data('status');

                          
                          $('#nim').val(nim);
                          $('#nik').val(nik);
                          $('#nama').val(nama);
                          $('#angkatan').val(angkatan);
                          $('#prodi  option[value="'+kode_prodi+'"]').prop("selected", true);
                          $('#kelas  option[value="'+kelas_id+'"]').prop("selected", true);
                          $('#alamat').val(alamat);
                          $('#agama').val(agama);
                          $('#jenis_kelamin').val(jenis_kelamin);
                          $('#kode_pos').val(kode_pos);
                          $('#telp').val(telp);
                          $('#email').val(email);
                         // $('#password').val(password);
                          $('#dosen  option[value="'+dosen+'"]').prop("selected", true);
                          $('#status  option[value="'+status+'"]').prop("selected", true);

                          $('#submit-mahasiswa').on('click',function(e){
                            reset_error()
                                $.ajax({
                                    url:"{{ url('mahasiswa/update') }}/"+nim,
                                    data:$("#form-mahasiswa").serialize(),
                                    type:"PUT",
                                    success : function(data){
                                    
                                        //validasi modal
                                        if(data.errors) {
                                          error_message(JSON.parse(data.errors));    
                                        }
                                        if(data.success == 'true'){
                                            window.location = data.url;
                                        }

                                        if(data.success == 'false'){
                                            window.location = data.url;
                                        }
                                    },
                                    error:function(XMLHttpRequest){
                                        console.log(XMLHttpRequest.responseText);
                                    }
                                });
                             })

                          $('#submit-user').on('click',function(e){
                                reset_error()
                                $.ajax({
                                    url:"{{ url('admin/user/update') }}/"+id,
                                    data:$("#form-user").serialize(),
                                    type:"POST",
                                    success : function(data){
                                   
                                        //validasi modal
                                        if(datas) {
                                            if(datas.name){
                                                $( '.name-error' ).html( datas.name[0] );
                                            }
                                            if(datas.username){
                                                $( '.username-error' ).html( datas.username[0] );
                                            }
                                            if(datas.email){
                                                $( '.email-error' ).html( datas.email[0] );
                                            }
                                            if(datas.password){
                                             
                                                $( '.password-error' ).html( datas.password[0] );
                                            }
                                        }
                                        if(data.success){
                                            window.location = data.url;
                                        }
                                    },
                                    error:function(XMLHttpRequest){
                                      toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                                    }
                                });
                             })
                      });
                      $('#dataTable tbody').on('click', '.hapus', function () {
                          var id          = $(this).data('id');
                          $.ajax({
                                    url:"{{ url('mahasiswa/delete') }}/"+id,
                                    data:{
                                      "_token": "{{ csrf_token() }}"
                                    },
                                    type:"DELETE",
                                    success : function(data){
                                        if(data.success){
                                            window.location = data.url;
                                        }
                                    },
                                    error:function(XMLHttpRequest){
                                      toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                                    }
                                });
                      });


                     
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
                                /*    data:{ 
                                        prodi           :prod,
                                        angkatan_mulai  :angkatan_awal,
                                        angkatan_selesai:angkatan_akhir,
                                        nim_mulai       :nim_awal,
                                        nim_selesai     :nim_akhir,
                                        nama            :nama
                                    
                                    }*/
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
                                        data: 'angkatan',
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
                                        data: 'action',
                                        "className": "text-center",
                                        orderable: false, 
                                        searchable: false    
                                    },
                                ]
                            });
                         
                        }



                    function reset_error(){
                        $( '#nim-error' ).html('');
                        $( '#nik-error' ).html('');
                        $( '#nama-error' ).html('');
                        $( '#prodi-error' ).html('');
                        $( '#kelas-error' ).html('');
                        $( '#angkatan-error' ).html('');
                        $( '#semester-error' ).html('');
                        $( '#alamat-error' ).html('');
                        $( '#agama-error' ).html('');
                        $( '#jenis-kelamin-error' ).html('')
                      }

                    function reset_model_value(){
                        $('#nim').val('');
                        $('#nik').val('');
                        $('#nama').val('');
                        $('#angkatan').val('');
                        $('#alamat').val('');
                        $('#agama').val('');
                        $('#jenis_kelamin').val('');
                        $('#kode_pos').val('');
                        $('#telp').val('');
                        $('#email').val('');
                      }
                     

                    function error_message($datas){
                        if($datas.nim){
                            $( '#nim-error' ).html( $datas.nim[0] );
                        }
                        if($datas.nik){
                            $( '#nik-error' ).html( $datas.nik[0] );
                        }
                        if($datas.nama){
                            $( '#nama-error' ).html( $datas.nama[0] );
                        }
                        if($datas.kode_prodi){
                            $( '#prodi-error' ).html( $datas.kode_prodi[0] );
                        }
                        if($datas.kelas_id){
                            $( '#kelas-error' ).html( $datas.kelas_id[0] );
                        }
                        if($datas.angkatan){
                            $( '#angkatan-error' ).html( $datas.angkatan[0] );
                        }
                        if($datas.semester){
                            $( '#semester-error' ).html( $datas.semester[0] );
                        }
                        if($datas.alamat){
                            $( '#alamat-error' ).html( $datas.alamat[0] );
                        }
                        if($datas.agama){
                            $( '#agama-error' ).html( $datas.agama[0] );
                        }     
                        if($datas.jenis_kelamin){
                            $( '#jenis-kelamin-error' ).html( $datas.jenis_kelamin[0] );
                        }                       
                     }  
                     });


                 
               </script>
            @endsection












