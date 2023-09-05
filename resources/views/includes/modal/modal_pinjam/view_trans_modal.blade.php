<!-- Modal -->
<div class="modal fade" id="modalviewTrans" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Data Peminjaman Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table>
                <tbody>
                    <tr>
                        <td>Nama Anggota</td>
                        <td>:</td>
                        <td id="nm_anggota"></td>
                    </tr>
                    <tr>
                        <td>Tanggal Pinjam</td>
                        <td>:</td>
                        <td id="tgl_pinjam"></td>
                    </tr>
                    <tr>
                        <td>Tanggal Perpanjaangan</td>
                        <td>:</td>
                        <td id="tgl_perpanjang"></td>
                    </tr>
                    <tr>
                        <td>Tanggal Pengembalian</td>
                        <td>:</td>
                        <td id="tgl_kembali"></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td id="status"></td>
                    </tr>
                </tbody>
                </table>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="tableDataBuku">
                        <thead>
                            <th>No</th>
                            <th>Kode buku</th>
                            <th>Jenis Buku</th>
                            <th>Judul Buku</th>
                            <th>Penerit</th>
                            <th>No Rak</th>
                            <th>Jumlah</th>
                        </thead>
                        <tbody id="listView">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>