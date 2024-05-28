@extends('layoutbootstrap')

@section('konten')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        @if (isset($status_hapus))
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Hapus Data Berhasil',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
            </script>
        @endif

        <!-- Alert success -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <!-- Akhir alert success -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12 col-sm-12">
                <div class="card shadow mb-4">

                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-danger">Barang</h6>

                        <!-- Tombol Tambah Data -->
                        <a href="{{ url('/barang/create') }}" class="btn btn-danger btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah Data</span>
                        </a>
                        <!-- Akghir Tombol Tambah Data -->

                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area" hidden>
                            <canvas id="myAreaChart"></canvas>
                        </div>
                        <!-- Awal Dari Tabel -->
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Stok</th>
                                        <th>Harga Beli</th>
                                        <th>Harga</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $p)
                                        <tr>
                                            <td>{{ $p->nama_barang }}</td>
                                            <td>{{ $p->jumlah }}</td>
                                            <td>{{ $p->stok }}</td>
                                            <td>{{ $p->harga_beli }}</td>
                                            <td>{{ $p->harga }}</td>
                                            <td style="text-align: center">
                                                <a href="{{ route('barang.edit', $p->id_barang) }}"
                                                    class="btn btn-success btn-circle">
                                                    <i class="fas fa-pen"></i>
                                                </a>

                                                <a onclick="deleteConfirm(this); return false;" href="#"
                                                    data-id_barang="{{ $p->id_barang }}" class="btn btn-danger btn-circle">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Akhir Dari Tabel -->
                    </div>
                </div>
            </div>


        </div>


        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    <!-- Modal Delete -->
    <script>
        function deleteConfirm(e) {
            var tomboldelete = document.getElementById('btn-delete')
            id_barang = e.getAttribute('data-id_barang');

            // const str = 'Hello' + id + 'World';
            var url3 = "{{ url('barang/destroy/') }}";
            var url4 = url3.concat("/", id_barang);
            // console.log(url4);

            // console.log(id);
            // var url = "{{ url('perusahaan/destroy/"+id+"') }}";

            // url = JSON.parse(rul.replace(/"/g,'"'));
            tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

            var pesan = "Data dengan ID Barang <b>"
            var pesan2 = " </b>akan dihapus"
            var res = id_barang;
            document.getElementByIdBarang("xid_barang").innerHTML = pesan.concat(res, pesan2);

            var myModal = new bootstrap.Modal(document.getElementByIdBarang('deleteModal'), {
                keyboard: false
            });

            myModal.show();

        }
    </script>
    <!-- Logout Delete Confirmation-->
    <div class="modal fade" id_barang="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id_barang="exampleModalLabel">Apakah anda yakin?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id_barang="xid"></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a id_barang="btn-delete" class="btn btn-danger" href="#">Hapus</a>

                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Delete -->
@endsection
