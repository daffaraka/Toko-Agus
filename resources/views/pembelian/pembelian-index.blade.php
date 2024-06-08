@extends('layoutbootstrap')
@section('konten')
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
                        <h6 class="m-0 font-weight-bold text-danger">Pembelian</h6>

                        <!-- Tombol Tambah Data -->
                        <a href="{{ route('pembelian.create') }}"
                            class="btn btn-danger btn-icon-split btn-sm tampilmodaltambah" data-toogle="modal"
                            data-target="#ubahModal">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah Data Pembelian</span>
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
                                        <th>#</th>
                                        <th>No Pembelian</th>
                                        <th>Supplier</th>
                                        <th>Barang - Qty - Harga Beli</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Total</th>
                                        <th>Sisa Pembayaran</th>

                                        {{-- <th style="text-align: center">Status</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembelian as $data)
                                        <tr>
                                            <td>{{ $data->tanggal_pembelian }}</td>
                                            <td>{{ $data->no_pembelian }}</td>
                                            <td>{{ $data->supplier->nama_supplier }}</td>
                                            <td>

                                                {{-- {{$data->pembelianBarang->barang}} --}}
                                                <ul>
                                                    @foreach ($data->pembelianBarang as $barang)
                                                        <li>{{ $barang->barang->nama_barang }} - <b>( {{ $barang->qty }} )</b> -
                                                            Rp.{{ number_format($barang->barang->harga_beli) }} </li>
                                                    @endforeach
                                                </ul>

                                            </td>

                                            <td>{{ $data->jenis_pembayaran }}</td>
                                            <td>Rp.{{ number_format($data->total_pembelian)  }}</td>
                                            <td>Rp.{{ number_format($data->sisa_pembayaran)  }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('pembelian.edit', $data->id) }}"
                                                        class="btn btn-primary mr-1">Edit</a>
                                                    <a href="{{ route('pembelian.delete', $data->id) }}"
                                                        class="btn btn-warning">Delete</a>
                                                </div>


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
    {{-- <script>
        function deleteConfirm(e) {
            var tomboldelete = document.getElementById('btn-delete')
            id = e.getAttribute('data-id');

            // const str = 'Hello' + id + 'World';
            var url3 = "";
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

        } --}}
    </script>
    <!-- Logout Delete Confirmation-->
    {{-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
    </div> --}}
    <!-- Akhir Modal Delete -->

    <!-- Ubah dan Tambah Data Menggunakan Modal -->
    {{-- <div class="modal fade" id="ubahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelmodalubah">Ubah Data Coa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Form untuk input -->
                    <form action="#" class="formubahcoa" method="post">
                        @csrf
                        <input type="hidden" id="idcoahidden" name="idcoahidden" value="">
                        <input type="hidden" id="tipeproses" name="tipeproses" value="">

                        <div class="mb-3 row">
                            <label for="nomerlabel" class="col-sm-4 col-form-label">Kode Coa</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="kode_akun" name="kode_akun"
                                    placeholder="Masukkan Kode Akun, cth: 111">
                                <div class="invalid-feedback errorkode_akun"></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="lantailabel" class="col-sm-4 col-form-label">Nama Akun</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_akun" name="nama_akun"
                                    placeholder="Masukkan Nama Akun, cth: Kas">
                                <div class="invalid-feedback errornama_akun"></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="hargalabel" class="col-sm-4 col-form-label">Header Akun</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="header_akun" name="header_akun"
                                    placeholder="Masukkan Header Akun, cth: 1">
                                <div class="invalid-feedback errorheader_akun"></div>
                            </div>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btnsimpan">Simpan</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Akhir Ubah dan Tambah Data Menggunakan Modal -->

    <!-- Jquery Proses Ubah / Tambah Data -->
    <!-- Modal Tambah Pop Up versi 2 -->

    <!-- Ketika tombol dengan elemen id tampilmodaltambah ditekan -->
    {{-- <script>
        $(function() {
            $('.tampilmodaltambah').on('click', function() {
                // merubah label menjadi Tambah Data Kamar
                $('#labelmodalubah').html('Tambah Data Coa');
                //   url = "{{ url('coa') }}";
                url = "{{ route('coa.store') }}";
                $('.formubahcoa').attr('action', url);

                // kosongkan isi dari input form
                $('#kode_akun').val('');
                $('#header_akun').val('');
                $('#nama_akun').val('');
                $('#idcoahidden').val('');
                $('#tipeproses').val('tambah'); //untuk identifikasi di controller apakah tambah atau update


                var data = {
                    'kode_akun': $('.kode_akun').val(),
                    'header_akun': $('.header_akun').val(),
                    'nama_akun': $('.nama_akun').val(),
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
                    // url: "{{ url('coa') }}",
                    url: "{{ route('coa.store') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.status == 400) {
                            if (response.errors.kode_akun) {
                                $('#kode_akun').removeClass('is-valid').addClass('is-invalid');
                                $('.errorkode_akun').html(response.errors.kode_akun);
                            } else {
                                $('#kode_akun').removeClass('is-invalid').addClass('is-valid');
                                $('.errorkode_akun').html();
                            }

                            if (response.errors.nama_akun) {
                                $('#nama_akun').removeClass('is-valid').addClass('is-invalid');
                                $('.errornama_akun').html(response.errors.nama_akun);
                            } else {
                                $('#nama_akun').removeClass('is-valid').removeClass(
                                    'is-invalid').addClass('is-valid');
                                $('.errornama_akun').html();
                            }

                            if (response.errors.header_akun) {
                                $('#header_akun').removeClass('is-valid').addClass(
                                'is-invalid');
                                $('.errorheader_akun').html(response.errors.header_akun);
                            } else {
                                $('#header_akun').removeClass('is-invalid').addClass(
                                'is-valid');
                                $('.errorheader_akun').html();
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
                            datacoa(); //refresh data coa
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

            $('#labelmodalubah').html('Ubah Data Coa');
            url = "{{ route('coa.store') }}";
            $('.formubahcoa').attr('action', url);
            $('#idcoahidden').val(id);
            $('#tipeproses').val('ubah');
            $('#ubahModal').modal('show');

            var url3 = "{{ url('coa/edit/') }}";
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
                        // console.log(response.coa.kode_akun);
                        $('#kode_akun').val(response.coa.kode_akun);
                        $('#header_akun').val(response.coa.header_akun);
                        $('#nama_akun').val(response.coa.nama_akun);
                        $('#idcoahidden').val(id)

                        // pastikan form is-invalid dikembalikan ke valid
                        $('#kode_akun').removeClass('is-invalid').addClass('is-valid');;
                        $('.errorkode_akun').html();
                        $('#nama_akun').removeClass('is-invalid').addClass('is-valid');;
                        $('.errornama_akun').html();
                        $('#header_akun').removeClass('is-invalid').addClass('is-valid');;
                        $('.errorheader_akun').html();
                    }
                }
            });
        }
    </script> --}}
    <!-- Akhir Ketika tombol dengan elemen class bernama  editbtn ditekan -->

    <!-- Proses mengisi data pada tabel -->
    {{-- <script>
        function datacoa() {
            $.ajax({
                type: "GET",
                url: "{{ url('coa/fetchcoa') }}",
                dataType: "json",
                success: function(response) {
                    // console.log(response);
                    $('tbody').html("");
                    $.each(response.coa, function(key, item) {
                        $('tbody').append('<tr>\
                                    <td>' + item.kode_akun + '</td>\
                                    <td>' + item.nama_akun + '</td>\
                                    <td style="text-align: center">' + item.header_akun +
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
            datacoa();
        });
    </script> --}}
    <!-- Akhir mengisi data pada tabel -->

    <!-- Ketika tombol submit di form ditekan -->
    <script>
        // definisikan tipe method yang berbeda
        // untuk update=>put (pembedanga adalah inner html pada labelmodalubah berisi Ubah Data Coa)
        // sedangkan untuk input=>post nilai inner html pada labelmodalubah berisi Tambah Data Coa


        $(document).ready(function() {
            $('.formubahcoa').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post", //isinya post untuk insert dan put untuk delete
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 400) {
                            if (response.errors.kode_akun) {
                                $('#kode_akun').removeClass('is-valid').addClass('is-invalid');
                                $('.errorkode_akun').html(response.errors.kode_akun);
                            } else {
                                $('#kode_akun').removeClass('is-invalid').addClass('is-valid');;
                                $('.errorkode_akun').html();
                            }

                            if (response.errors.nama_akun) {
                                $('#nama_akun').removeClass('is-valid').addClass('is-invalid');
                                $('.errornama_akun').html(response.errors.nama_akun);
                            } else {
                                $('#nama_akun').removeClass('is-invalid').addClass('is-valid');;
                                $('.errornama_akun').html();
                            }

                            if (response.errors.header_akun) {
                                $('#header_akun').removeClass('is-valid').addClass(
                                    'is-invalid');
                                $('.errorheader_akun').html(response.errors.header_akun);
                            } else {
                                $('#header_akun').removeClass('is-invalid').addClass(
                                    'is-valid');;
                                $('.errorheader_akun').html();
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
                            datacoa(); //refresh data coa

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
