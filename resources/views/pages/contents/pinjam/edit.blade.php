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
                    <form action="/update_trans_pinjam/{{$master->id}}" class="col-md-12" method="post"  id="editDataTransaction">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label>Nama Anggota</label>
                                    <select class="form-select form-control select" name="id_anggota" required>
                                        <option value="{{$master->id_anggota}}">{{ $master->nama_lengkap }}</option>
                                    </select>
                                     <input type="hidden" name="id_master" value="{{ $master->id }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select class="form-select form-control select" name="status" required>
                                        <option value="">--pilih--</option>
                                        <option value="dipinjam" {{ ($master->status == "dipinjam") ? 'selected' : ''}}>Dipinjam</option>
                                        <option value="perpanjang" {{ ($master->status == "perpanjang") ? 'selected' : ''}}>Perpanjang</option>
                                        <option value="dikembali" {{ ($master->status == "dikembali") ? 'selected' : ''}}>Dikembalikan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Tanggal Pinjam</label>
                                    <input type="date" name="tanggal_pinjam" value="{{ $master->tanggal_pinjam }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label>Tanggal Perpanjang</label>
                                    <input type="date" name="tanggal_perpanjang" value="{{ $master->tanggal_perpanjang }}"  class="form-control" required>  
                                </div>  
                                <div class="mb-3">
                                    <label>Tanggal Pengembalian</label>
                                    <input type="date" name="tanggal_kembali" value="{{ $master->tanggal_kembali }}"  class="form-control" required>  
                                </div> 
                            </div> 
                        </div> 
                        <div class="row">
                            <div class="table-responsive mt-4">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th>Kode Buku</th>
                                        <th>Jenis buku</th>
                                        <th>Judul buku</th>
                                        <th>Penerbit</th>
                                        <th>No Rak</th>
                                        <th>Jumlah</th>
                                    </thead>
                                    @foreach($detail as $lisdtl)
                                    <tr>
                                        <td>{{ $lisdtl->code }}</td>
                                        <td>{{ $lisdtl->jenis_buku }}</td>
                                        <td>{{ $lisdtl->judul_buku }}</td>
                                        <td>{{ $lisdtl->penerbit }}</td>
                                        <td>{{ $lisdtl->no_rak }}</td>
                                        <td>
                                            <input type="hidden" name="id[]" value="{{ $lisdtl->id }}">
                                            <input type="hidden" name="id_buku[]" value="{{ $lisdtl->id_buku }}">
                                            <input type="number" name="jumlah[]" value="{{ $lisdtl->jumlah}}" class="form-control jumlah" id_buku="{{ $lisdtl->id_buku }}" required>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div> <button type="submit" class="btn btn-primary me-2">Kirim</button><a href="/pinjam" class="btn btn-primary">Kembali</a></div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.all.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.all.js') }}"></script>
<script>
    $(document).ready(function(){
         $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
         $('#editPinjam').on('click',function(e){
            e.preventDefault()
            $('#editPinjam').modal('show');
         })
        $('#editDataTransaction').on('submit',function(e){
            e.preventDefault()
            var data = $('#editDataTransaction').serialize();
            $.ajax({
                url : "{{URL::to('/update_trans_pinjam')}}",
                type :'post',
                data : data,
                dataType : 'json',
                success : function(respon){
                    var status = (respon.status == true) ? 'success' : 'error';
                    swal.fire({
                        icon: status,
                        text: respon.message
                    })
                      window.location.href ="{{URL::to('/pinjam')}}";
                }
            })
        })
        $(document).on('change','.jumlah',function(){
            var id_buku = $(this).attr('id_buku');
            var jml     = $(this).val();
            $.ajax({
                url :"{{URL::to('/check-stock')}}",
                type :"post",
                data :{id_buku : id_buku,jumlah:jml},
                dataType : 'json',
                success : function(respon){
                    if (respon.status == false){
                        swal.fire({
                            icon : 'error',
                            text : 'stock yang tersedia '+respon.data.stock
                        })
                        $(this).val(respon.data.stock);
                    }
                    
                }
            })
        })
    })
</script>