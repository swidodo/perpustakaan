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
                        <a href="#" class="btn btn-primary" id="add-buku"><i class="bi bi-plus"></i>Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="tableListBuku">
                            <thead>
                                <th>No</th>
                                <th>Kode Buku</th>
                                <th>Jenis Buku</th>
                                <th>Judul Buku</th>
                                <th>Penerbit</th>
                                <th>No rak</th>
                                <th>Jumlah</th>
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
@include("includes.modal.modal_buku.add_buku_modal")
@include("includes.modal.modal_buku.edit_buku_modal")
@endsection
<link rel="stylesheet" href="{{asset('assets/css/pages/dataTables.bootstrap4.min.css')}}">
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.all.js') }}"></script>
<script>
    $(document).ready(function(){
         $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        var table = $('#tableListBuku').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "ajax": 'get_list_buku',
            "columns": [
                { data: 'no', name:'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'code', name: 'code' },
                { data: 'jenis_buku', name: 'jenis_buku' },
                { data: 'judul_buku', name: 'judul_buku' },
                { data: 'penerbit', name: 'penerbit'},
                { data: 'no_rak', name: 'no_rak'},
                { data: 'jumlah', name: 'jumlah' },
                { data: 'action', name: 'action' }
            ]
        });
        $('#add-buku').click(function(e){
            e.preventDefault();
            $('#addModalbuku').modal('show')
        })
        $('#formadd-buku').on('submit',function(e){
            e.preventDefault();
            var data = $('#formadd-buku').serialize();
            $.ajax({
                url : 'store-buku',
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
                        $('#formadd-buku')[0].reset();
                        table.ajax.reload();
                        $('#addModalbuku').modal('hide')
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