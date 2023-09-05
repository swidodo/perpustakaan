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
                        <table class="table table-bordered table-striped table-hover" id="tableListStock">
                            <thead>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Jenis Buku</th>
                                <th>Judul Buku</th>
                                <th>Penerbit</th>
                                <th>stock</h>
                                <th>dipinjam</th>
                                <th>Tersedia</th>
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
        $('#tableListStock').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "ajax": 'get_list_stock',
            "columns": [
                { data: 'no', name:'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'code', name: 'code' },
                { data: 'jenis_buku', name: 'jenis_buku' },
                { data: 'judul_buku', name: 'judul_buku' },
                { data: 'penerbit', name: 'penerbit'},
                { data: 'stock', name: 'stock'},
                { data: 'stock_out', name: 'stock_out' },
                { data: 'ready', name: 'ready' }
            ]
        });
        
    })
</script>