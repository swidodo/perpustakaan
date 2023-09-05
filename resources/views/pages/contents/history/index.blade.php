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
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="tableListHistory">
                            <thead>
                                <th>No</th>
                                <th>No Pinjam</th>
                                <th>Nama Anggota</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Perpanjang</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Jenis buku</th>
                                <th>Judul buku</th>
                                <th>Penerbit</th>
                                <th>status</th>
                                <th>jumlah</th>
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
@endsection
<link rel="stylesheet" href="{{asset('assets/css/pages/dataTables.bootstrap4.min.css')}}">
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script>
    $(document).ready(function(){
         $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        $('#tableListHistory').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "ajax": 'get_list_history',
            "columns": [
                { data: 'no', name:'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'no_pinjam', name: 'no_pinjam' },
                { data: 'nama_lengkap', name: 'nama_lengkap' },
                { data: 'tanggal_pinjam', name: 'tanggal_pinjam' },
                { data: 'tanggal_perpanjang', name: 'tanggal_perpanjang'},
                { data: 'tanggal_kembali', name: 'tanggal_kembali'},
                { data: 'jenis_buku', name: 'jenis_buku' },
                { data: 'judul_buku', name: 'judul_buku' },
                { data: 'penerbit', name: 'penerbit' },
                { data: 'status', name: 'status' },
                { data: 'jumlah', name: 'jumlah' }
            ]
        });
        
    })
</script>