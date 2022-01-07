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
        <div class="card bg-gradient-default">
          <div class="card-body">
            <div class="row">
              <div class="col-md-2 col-sm-11 col-xs-11">
                <h5 class="card-title text-white">Nama Mahasiswa</h5>
              </div>
             
              <div class="col-md-9 col-sm-12 col-xs-12">
                <h5 class="card-title text-white">{{ $mahasiswa->nama }}</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-11 col-xs-11">
                <h5 class="card-title text-white">Nim</h5>
              </div>
            
              <div class="col-md-9 col-sm-12 col-xs-12">
                <h5 class="card-title text-white">{{ $mahasiswa->nim }}</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-10">
                <h5 class="card-title text-white">Prodi</h5>
              </div>
              <div class="col-md-9 col-sm-12">
                <h5 class="card-title text-white">{{ $mahasiswa->prodi->nama_prodi }}</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-10">
                <h5 class="card-title text-white">Dosen Pembimbing</h5>
              </div>
             
              <div class="col-md-9 col-sm-12">
                <h5 class="card-title text-white">{{ (isset($mahasiswa->dosen->nama))?$mahasiswa->dosen->nama:'-' }}</h5>
              </div>
            </div>
                   
          </div>
        </div>
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <h3 class="mb-0">{{ $title }}</h3>
          </div>
          <!-- Light table -->
          <div class="table-responsive">
            <input type="hidden" name="nim" id="nim" value="{{ \Crypt::encrypt($mahasiswa->nim) }}">
            <input type="hidden" name="kode_prodi" id="kode_prodi" value="{{ \Crypt::encrypt($mahasiswa->kode_prodi) }}">

            <table class="table table-flush" id="dataTable">
              <thead class="thead-light">
                <tr>
                  <th>N0</th>
                  <th>MATAKULIAH</th>
                  <th>HARI</th>
                  <th>JAM</th>
                  <th>KELAS</th>
                  <th>RUANGAN</th>
                  <th>DOSEN</th>
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
    


    
    <!-- modal -->
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal-label"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <form id="form-data" action="#" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="nim" id="nim_mahasiswa" value="{{ $mahasiswa->nim }}">
            <div class="modal-body">
              <div class="table-responsive">
                <table class="table table-flush" id="dataTableJadwalByProdi">
                  <thead class="thead-light">
                    <tr>
                       <th><div class="custom-control custom-checkbox"><input type="checkbox" id="checkall" class="checkall" name="checkall"></div></th>
                        <th>Matakuliah</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Kelas</th>
                        <th>SKS</th>
                        <th>Dosen</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                 
                </table>
               </div>
               <div class="text-right mt-4">
                    <a href="#"id="submit-data" class="submit-data btn btn-primary">Simpan</a>
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

            //event tambah matakuliah
            $('#tambah').on('click', function () {
              $('#Modal').modal();
              $('#modal-label').html('Pilih Jadwal Kuliah Mahasiswa');
              $('#submit-data').html('Simpan');

              var kode_prodi = $('#kode_prodi').val();
              fetch_data_matakuliah(kode_prodi);

               

              $('#submit-data').on('click',function(e){
                  //reset_error()
                  $.ajax({
                      type: 'POST',
                      data: $("#form-data").serialize(),
                      url: "{{ route('krs.store') }}",
                      success : function(data){
                        console.log(data)
                          if(JSON.parse(data.meta.code) == 200){
                              $('#Modal').modal('hide');
                                  swal.fire("Selesai","Kelas berhasil diupdate","success").then((val)=>{
                                    location.reload();
                                  });
                              }
                                        
                          },
                          error: function(xhr, status, err) {
                              var response = JSON.parse(xhr.responseText)
                              if(response.meta.code == 401){
                                  error_message(response.data.error);
                              }
                              if(response.meta.code == 500){
                                  toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                              }
                          }
                  });          
              })

            })

            $('#dataTable tbody').on('click', '.hapus', function () {
                  var id          = $(this).data('id');     
                  $.ajax({
                        url:"{{ url('krs') }}/"+id,
                        data:{
                            "_token": "{{ csrf_token() }}"
                        },
                        type:"DELETE",
                        success : function(data){
                            if(JSON.parse(data.meta.code) == 200){
                                $('#Modal').modal('hide');
                                swal.fire("Selesai","Krs berhasil dihapus","success").then((val)=>{
                                    location.reload();
                                });
                            }
                        },
                        error:function(XMLHttpRequest){
                            toastr.error('Maaf terjadi kesalahan pada sistem. Coba Ulangi lagi !');
                        }
                  });
            });

            //EVENT CHECKALL CHECKBOX
            $(".checkall").click(function() {
                var isChecked = $(this).prop('checked');
                $(".data-check").prop('checked', isChecked);
                
            });

            
           
           
            //fetch data method
            function fetch_data(){  
                var nim = $('#nim').val();                  
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
                        url:"{{route('data.krs')}}",
                        data: {
                          'nim': nim
                        },
                        type: "GET"
                    },
                                
                                columns: [
                                  { 
                                        data: 'DT_RowIndex',
                                        name: 'DT_Row_Index', 
                                        "className": "text-center" 
                                    },
                                    {
                                        data: 'matakuliah',
                                        "className": "text-center"                                        
                                    },     
                                    {
                                        data: 'hari',
                                        "className": "text-center"                                        
                                    },    
                                    {
                                        data: 'jam',
                                        "className": "text-center"                                        
                                    },   
                                    {
                                        data: 'kelas',
                                        "className": "text-center"                                        
                                    }, 
                                    {
                                        data: 'ruang',
                                        "className": "text-center"                                        
                                    },   
                                    {
                                        data: 'dosen',
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


                        //FETCH DATA JADWAL MATAKULIAH BY PRODI
                        function fetch_data_matakuliah(kode_prodi){            
                            $('#dataTableJadwalByProdi').DataTable({
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
                                    url:"{{route('data.jadwal')}}",
                                    data: {
                                      'kode_prodi': kode_prodi
                                    },
                                    type: "GET"
                                },
                                
                                columns: [
                                  { 
                                    data: null,  width:'5%',
                                      render: function ( data, type, row ) {
                                          return '<div class="custom-control custom-checkbox"><input type="checkbox" class="data-check"  name="id_jadwal[]" value="'+row['kode_jadwal']+'" id="id_jadwal"></div>';
                                      } 
                                    },
                                    {
                                        data: 'matakuliah',
                                        "className": "text-center"                                        
                                    },     
                                    {
                                        data: 'hari_id',
                                        "className": "text-center"                                        
                                    },    
                                    {
                                        data: 'jam',
                                        "className": "text-center"                                        
                                    },   
                                    {
                                        data: 'kelas',
                                        "className": "text-center"                                        
                                    }, 
                                    {
                                        data: 'sks',
                                        "className": "text-center"                                        
                                    },   
                                    {
                                        data: 'dosen',
                                        "className": "text-center"                                        
                                    }, 
                                                                    
                                    
                                ]
                            });
                         
                        }
                })
                 
               </script>
            @endsection












