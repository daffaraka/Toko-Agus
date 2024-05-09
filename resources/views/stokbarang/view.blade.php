@extends('layoutbootstrap')

@section('konten')
    <!-- Begin Page Content -->

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

    <div class="container-fluid">
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
                        <h6 class="m-0 font-weight-bold text-danger">Stok Barang</h6>

                        <!-- Tombol Tambah Data -->
                        <a href="#" class="btn btn-danger btn-icon-split btn-sm tampilmodaltambah" data-toogle="modal"
                            data-target="#ubahModal">
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
                            <!-- Untuk tempat menaruh tabel -->
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Harga Beli</th>
                                        <th style="text-align: center">Jumlah</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

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
            id = e.getAttribute('data-id');

            // const str = 'Hello' + id + 'World';
            var url3 = "{{ url('stokbarang/destroy/') }}";
            var url4 = url3.concat("/", id);
            // console.log(url4);

            // console.log(id);
            tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

            var pesan = "Data dengan ID <b>"
            var pesan2 = " </b>akan dihapus"
            var res = id;
            document.getElementById("xid").innerHTML = pesan.concat(res, pesan2);

            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
                keyboard: false
            });

            myModal.show();

        }
    </script>
    <!-- Logout Delete Confirmation-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="xid"></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>

                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Delete -->

    <!-- Ubah dan Tambah Data Menggunakan Modal -->
    <div class="modal fade" id="ubahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelmodalubah">Ubah Data Stok Barang</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Form untuk input -->
                    <form action="#" class="formubahstokbarang" method="post">
                        @csrf
                        <input type="hidden" id="idstokbaranghidden" name="idstokbaranghidden" value="">
                        <input type="hidden" id="tipeproses" name="tipeproses" value="">

                        <div class="mb-3 row">
                            <label for="nomerlabel" class="col-sm-4 col-form-label">Nama Barang</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                    placeholder="Masukkan Nama Barang, cth: 111">
                                <div class="invalid-feedback errornama_barang"></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="lantailabel" class="col-sm-4 col-form-label">Harga Beli</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="harga_beli" name="harga_beli"
                                    placeholder="Masukkan Harga Beli, cth: Kas">
                                <div class="invalid-feedback errorharga_beli"></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="hargalabel" class="col-sm-4 col-form-label">Jumlah</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="jumlah" name="jumlah"
                                    placeholder="Masukkan Jumlah, cth: 1">
                                <div class="invalid-feedback errorjumlah"></div>
                            </div>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Ubah dan Tambah Data Menggunakan Modal -->

    <!-- Jquery Proses Ubah / Tambah Data -->
    <!-- Modal Tambah Pop Up versi 2 -->

    <!-- Ketika tombol dengan elemen id tampilmodaltambah ditekan -->
    <script>
        $(function() {
            $('.tampilmodaltambah').on('click', function() {
                // merubah label menjadi Tambah Data Kamar
                $('#labelmodalubah').html('Tambah Data Stok Barang');
                //   url = "{{ url('stokbarang') }}";
                url = "{{ route('stokbarang.store') }}";
                $('.formubahstokbarang').attr('action', url);

                // kosongkan isi dari input form
                $('#nama_barang').val('');
                $('#harga_beli').val('');
                $('#jumlah').val('');
                $('#idstokbaranghidden').val('');
                $('#tipeproses').val('tambah'); //untuk identifikasi di controller apakah tambah atau update


                var data = {
                    'nama_barang': $('.nama_barang').val(),
                    'harga_beli': $('.harga_beli').val(),
                    'jumlah': $('.jumlah').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#ubahModal').modal('show');

                //   const id = $(this).data('id');
                $.ajax({

                    type: "post", //isinya put untuk update dan post untuk insert
                    // url: "{{ url('stokbarang') }}",
                    url: "{{ route('stokbarang.store') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.status == 400) {
                            if (response.errors.nama_barang) {
                                $('#nama_barang').removeClass('is-valid').addClass('is-invalid');
                                $('.errornama_barang').html(response.errors.nama_barang);
                            } else {
                                $('#nama_barang').removeClass('is-invalid').addClass('is-valid');
                                $('.errornama_barang').html();
                            }

                            if (response.errors.harga_beli) {
                                $('#harga_beli').removeClass('is-valid').addClass('is-invalid');
                                $('.errorharga_beli').html(response.errors.harga_beli);
                            } else {
                                $('#harga_beli').removeClass('is-valid').removeClass(
                                    'is-invalid').addClass('is-valid');
                                $('.errorharga_beli').html();
                            }

                            if (response.errors.jumlah) {
                                $('#jumlah').removeClass('is-valid').addClass(
                                'is-invalid');
                                $('.errorjumlah').html(response.errors.jumlah);
                            } else {
                                $('#jumlah').removeClass('is-invalid').addClass(
                                'is-valid');
                                $('.errorjumlah').html();
                            }


                        } else {

                            // munculkan pesan sukses
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.sukses,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            });

                            // kosongkan form
                            $('#ubahModal').modal('hide');
                            datastokbarang(); //refresh data coa
                        }
                    }

                });

            });
        });
    </script>
    <!-- Akhir Jquery Proses Ubah / Tambah Data -->

    <!-- Ketika tombol dengan elemen class bernama  editbtn ditekan -->
    <script>
        function updateConfirm(e) {
            id = e.getAttribute('data-id');

            $('#labelmodalubah').html('Ubah Data Stok Barang');
            url = "{{ route('stokbarang.store') }}";
            $('.formubahstokbarang').attr('action', url);
            $('#idstokbaranghidden').val(id);
            $('#tipeproses').val('ubah');
            $('#ubahModal').modal('show');

            var url3 = "{{ url('stokbarang/edit/') }}";
            var url4 = url3.concat("/", id);

            $.ajax({
                type: "GET",
                url: url4,
                success: function(response) {
                    if (response.status == 404) {
                        // beri alert kalau gagal
                        Swal.fire({
                            title: 'Gagal!',
                            text: response.message,
                            icon: 'warning',
                            confirmButtonText: 'Ok'
                        });

                        $('#ubahModal').modal('hide');
                    } else {
                        // console.log(response.stokbarang.nama_barang);
                        $('#nama_barang').val(response.stokbarang.nama_barang);
                        $('#harga_beli').val(response.stokbarang.harga_beli);
                        $('#jumlah').val(response.stokbarang.jumlah);
                        $('#idstokbaranghidden').val(id)

                        // pastikan form is-invalid dikembalikan ke valid
                        $('#nama_barang').removeClass('is-invalid').addClass('is-valid');;
                        $('.errornama_barang').html();
                        $('#jumlah').removeClass('is-invalid').addClass('is-valid');;
                        $('.errorjumlah').html();
                        $('#harga_beli').removeClass('is-invalid').addClass('is-valid');;
                        $('.errorharga_beli').html();
                    }
                }
            });
        }
    </script>
    <!-- Akhir Ketika tombol dengan elemen class bernama  editbtn ditekan -->

    <!-- Proses mengisi data pada tabel -->
    <script>
        function datastokbarang() {
            $.ajax({
                type: "GET",
                url: "{{ url('stokbarang/fetchstokbarang') }}",
                dataType: "json",
                success: function(response) {
                    // console.log(response);
                    $('tbody').html("");
                    $.each(response.stokbarang, function(key, item) {
                        $('tbody').append('<tr>\
                                    <td>' + item.nama_barang + '</td>\
                                    <td>' + item.harga_beli + '</td>\
                                    <td style="text-align: center">' + item.jumlah +
                            '</td>\
                                    <td style="text-align: center"><a onclick="updateConfirm(this); return false;" href="#" value="' + item.id + '" data-id="' +
                            item.id + '" class="btn btn-success btn-circle editbtn"><i class="fas fa-pen"></i></a>\
                                    <a onclick="deleteConfirm(this); return false;" href="#" value="' + item.id +
                            '" data-id="' + item.id + '" class="btn btn-danger btn-circle deletebtn"><i class="fas fa-trash"></i></button></td>\
                                \</tr>');
                    });
                }
            })
        }
    </script>
    <script>
        $(document).ready(function() {
            datastokbarang();
        });
    </script>
    <!-- Akhir mengisi data pada tabel -->

    <!-- Ketika tombol submit di form ditekan -->
    <script>
        // definisikan tipe method yang berbeda 
        // untuk update=>put (pembedanga adalah inner html pada labelmodalubah berisi Ubah Data stokbarang)
        // sedangkan untuk input=>post nilai inner html pada labelmodalubah berisi Tambah Data stokbarang


        $(document).ready(function() {
            $('.formubahstokbarang').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post", //isinya post untuk insert dan put untuk delete
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {
                        // console.log('kssss');
                        // jika responsenya adalah error
                        if (response.status == 400) {
                            if (response.errors.nama_barang) {
                                $('#nama_barang').removeClass('is-valid').addClass('is-invalid');
                                $('.errornama_barang').html(response.errors.nama_barang);
                            } else {
                                $('#nama_barang').removeClass('is-invalid').addClass('is-valid');;
                                $('.errornama_barang').html();
                            }

                            if (response.errors.jumlah) {
                                $('#jumlah').removeClass('is-valid').addClass('is-invalid');
                                $('.errorjumlah').html(response.errors.jumlah);
                            } else {
                                $('#jumlah').removeClass('is-invalid').addClass('is-valid');;
                                $('.errorjumlah').html();
                            }

                            if (response.errors.harga_beli) {
                                $('#harga_beli').removeClass('is-valid').addClass(
                                'is-invalid');
                                $('.errorharga_beli').html(response.errors.harga_beli);
                            } else {
                                $('#harga_beli').removeClass('is-invalid').addClass(
                                'is-valid');;
                                $('.errorharga_beli').html();
                            }

                        } else {
                            // munculkan pesan sukses
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.sukses,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            });

                            // kosongkan form
                            $('#ubahModal').modal('hide');
                            datastokbarang(); //refresh data stokbarang

                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
                return false;
            });
        });
    </script>
    <!-- Akhir ketika tombol submit di form ditekan -->
@endsection
