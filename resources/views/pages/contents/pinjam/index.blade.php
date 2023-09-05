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
                    <div class="col-md-2 mb-4">
                        <a href="{{ route('create-transaction')}}" class="btn btn-primary"> Tambah </a>
                    </div>
                    <div class="table-responsive">  
                        <table class="table table-bordered table-striped table-hover" id="tableListTrans">
                            <thead>
                                <th>No</th>
                                <th>No Pinjam</th>
                                <th>Nama Anggota</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Perpanjang</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status</th>
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
@include("includes.modal.modal_pinjam.view_trans_modal")
@endsection
<link rel="stylesheet" href="{{asset('assets/css/pages/dataTables.bootstrap4.min.css')}}">
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script>
    $(document).ready(function(){
         $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        $('#tableListTrans').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "ajax": 'get_transaction',
            "columns": [
                { data: 'no', name:'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'no_pinjam', name: 'no_pinjam' },
                { data: 'nama_lengkap', name: 'nama_lengkap' },
                { data: 'tanggal_pinjam', name: 'tanggal_pinjam' },
                { data: 'tanggal_perpanjang', name: 'tanggal_perpanjang'},
                { data: 'tanggal_kembali', name: 'tanggal_kembali'},
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' }
            ]
        });
        $(document).on('click','.view-pinjaman',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                url : 'view_trans',
                type :'post',
                data : {id : id},
                dataType : 'json',
                success : function(respon){
                    $('#nm_anggota').html(respon.master.nama_lengkap)
                    $('#tgl_pinjam').html(respon.master.tanggal_pinjam)
                    $('#tgl_perpanjang').html(respon.master.tanggal_perpanjang)
                    $('#tgl_kembali').html(respon.master.tanggal_kembali)
                    $('#status').html(respon.master.status)
                    var html='';
                    var no = 1;
                    $.each(respon.detail, function(key,val){
                        html +=`<tr>
                        <td>`+no+`</td>
                        <td>`+val.code+`</td>
                        <td>`+val.jenis_buku+`</td>
                        <td>`+val.judul_buku+`</td>
                        <td>`+val.penerbit+`</td>
                        <td>`+val.no_rak+`</td>
                        <td>`+val.jumlah+`</td>
                        </tr>`;
                        no++;
                    })

                    $('#listView').html(html)
                }
            })
            $('#modalviewTrans').modal('show');
        })
    })
</script>