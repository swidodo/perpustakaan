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
                    <form class="col-md-12" id="form-create-pinjam">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label>Nama Anggota</label>
                                    <select class="form-select form-control select" name="id_anggota" required>
                                        <option value="">--pilih--</option>
                                        @foreach($anggota as $ang)
                                        <option value="{{ $ang->id }}">{{ $ang->nama_lengkap }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Tanggal Pinjam</label>
                                    <input type="date" name="tanggal_pinjam" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label>Tanggal Pengembalian</label>
                                    <input type="date" id="tgl" name="tanggal_kembali" class="form-control" required>  
                                </div>  
                                <div class="mb-3">
                                    <label>Status</label>
                                    <input type="text" name="status" class="form-control" value="dipinjam" readonly required>  
                                </div> 
                            </div> 
                        </div> 
                        <div class="row">
                            <div class="table-responsive mt-5">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th>Kode buku</th>
                                        <th>Jenis buku</th>
                                        <th>Judul buku</th>
                                        <th>Penerbit</th>
                                        <th>No rak</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody id="data-dtl">
                                        
                                    </tbody>
                                </table>
                            <div>
                                <button id="add-list" type="button" class="btn btn-sm btn-success">List Buku</button>
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@include("includes.modal.modal_pinjam.list_buku_modal")
@endsection
<link rel="stylesheet" href="{{asset('assets/css/pages/dataTables.bootstrap4.min.css')}}"> 
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.all.js') }}"></script>
<script>
    $(document).ready(function(){
         $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        $('#add-list').on('click',function(e){
            e.preventDefault();
            $('#modalListBuku').modal('show')
            $('#tableDataBuku').DataTable({
                "processing": true,
                "serverSide": true,
                "destroy": true,
                "ajax": 'listbuku',
                "columns": [
                    { data: 'no', name:'id', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    { data: 'code', name: 'code' },
                    { data: 'jenis_buku', name: 'jenis_buku' },
                    { data: 'judul_buku', name: 'judul_buku' },
                    { data: 'penerbit', name: 'penerbit'},
                    { data: 'no_rak', name: 'no_rak' },
                    { data: 'action', name: 'action' }
                ]
            });
        })
        $(document).on('click','.add-list', function(){
            $('#data-dtl').append(`
                <tr id=`+$(this).attr('data-id')+`>
                <td>`+ $(this).attr('data-code')+`</td>
                <td>`+ $(this).attr('data-jenis_buku')+`</td>
                <td>`+ $(this).attr('data-judul_buku')+`</td>
                <td>`+ $(this).attr('data-penerbit')+`</td>
                <td>`+ $(this).attr('data-rak')+`</td>
                <td> 
                    <input type="number" name="jumlah[]" class="form-control jumlah" id_buku="`+$(this).attr('data-id')+`" required>
                    <input type="hidden" name="id_buku[]" value="`+$(this).attr('data-id')+`">
                </td>
                <td> <button class="btn btn-sm btn-danger remove-list" data-id=`+$(this).attr('data-id')+`><i class="bi bi-x-lg"></i></button></td>
                </tr>`)
            $('#modalListBuku').modal('hide')
        })
        $(document).on('click','.remove-list',function(){
            var id = $(this).attr('data-id');
            $('#'+id).remove();
        })
        $('#form-create-pinjam').on('submit',function(e){
            e.preventDefault()
            var data = $('#form-create-pinjam').serialize();
            $.ajax({
                url : 'store-transaction',
                type : 'post',
                data : data,
                dataType : 'json',
                success : function(respon){
                    
                    var status = (respon.status == true) ? 'success' : 'error';
                    swal.fire({
                        icon: status,
                        text: respon.message
                    })
                    if(respon.status == true){
                        $('#form-create-pinjam')[0].reset();
                        window.location.href ="{{URL::to('/pinjam')}}";
                    }
                }
            })
        })
        $(document).on('change','.jumlah',function(){
            var id_buku = $(this).attr('id_buku');
            var jml     = $(this).val();
            $.ajax({
                url :"check-stock",
                type :"post",
                data :{id_buku : id_buku,jumlah:jml},
                dataType : 'json',
                success : function(respon){
                    if (respon.status == false){
                        swal.fire({
                            icon : 'error',
                            text : 'stock buku yang tersedia '+respon.data.stock
                        })
                    }
                    
                }
            })
        })
   })
</script>
