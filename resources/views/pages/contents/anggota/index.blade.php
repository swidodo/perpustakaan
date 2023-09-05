@extends('layouts.main')
@section('pages-content')

<div id="main" class="bg-scondary">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
            
    <div class="page-heading">
        <h3>{{ $page }}</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-body">
                     <div class="mb-4">
                        <a href="#" class="btn btn-primary" id="add-anggota"><i class="bi bi-plus"></i>Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="tableListAnggota">
                            <thead>
                                <th>No</th>
                                <th>Kode Anggota</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>No Hp</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@include("includes.modal.modal_anggota.add_modal_anggota")
@endsection
<link rel="stylesheet" href="{{asset('assets/css/pages/dataTables.bootstrap4.min.css')}}">
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.all.js') }}"></script>
<script>
    $(document).ready(function(){
         $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        var table = $('#tableListAnggota').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "ajax": 'get_list_anggota',
            "columns": [
                { data: 'no', name:'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'code_anggota', name: 'code_anggota' },
                { data: 'nama_lengkap', name: 'nama_lengkap' },
                { data: 'jenis_kelamin', name: 'jenis_kelamin' },
                { data: 'no_hp', name: 'no_hp'},
                { data: 'email', name: 'email'},
                { data: 'alamat', name: 'alamat' },
                { data: 'action', name: 'action' }
            ]
        });
        $('#add-anggota').click(function(e){
            e.preventDefault();
            $('#addModalAnggota').modal('show')
        })
        $('#formadd-anggota').on('submit',function(e){
            e.preventDefault();
            var data = $('#formadd-anggota').serialize();
            $.ajax({
                url : 'store_anggota',
                type : 'post',
                data : data,
                dataType :'json',
                success : function(respon){
                    var status = (respon.status == true) ? 'success' :'error';
                    swal.fire({
                        icon : status,
                        text : respon.message
                    })
                    if (respon.status == true){
                        $('#formadd-anggota')[0].reset();
                        table.ajax.reload();
                        $('#addModalAnggota').modal('hide')
                    }
                }
            })
        })
        $(document).on('click','.edit-buku',function(e){
            e.preventDefault();
            $('#editModalbuku').modal('show')
        })
    })
</script>