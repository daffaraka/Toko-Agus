@extends('layoutbootstrap')

@section('konten')
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
                        <h6 class="m-0 font-weight-bold text-danger">Edit Data Penjualan</h6>

                        <!-- Tombol Tambah Data -->

                        <!-- Akghir Tombol Tambah Data -->

                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="{{ route('penjualan.update',$penjualan->id) }}" method="POST">

                            @csrf

                            <div class="form-group">
                                <label for="">No Penjualan</label>
                                <input type="text" name="no_penjualan" class="form-control" value="{{$penjualan->no_penjualan}}">
                            </div>
                            <div class="form-group">
                                <label for="">Pelanggan</label>
                                <select type="text" name="id_pelanggan" class="form-control">
                                    @foreach ($pelanggan as $select)
                                        <option value="{{$select->id}}">{{$select->nama_pelanggan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group">
                                <label for="">Jenis Pembayaran</label>
                                <input type="text" name="no_penjualan" class="form-control">
                            </div> --}}
                            <div class="form-group">
                                <label for="">Kasir</label>
                                <input type="text" name="kasir" class="form-control" value={{$penjualan->kasir}}>
                            </div>
                            <div class="form-group">
                                <label for="">Barang</label>
                                <select type="text" name="id_barang" class="form-control" required>
                                    @foreach ($barang as $selectBarang)
                                        <option value="{{ $selectBarang->id_barang }}">{{ $selectBarang->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Penjualan</label>
                                <input type="text" name="tanggal_penjualan" class="form-control" value="{{$penjualan->tanggal_penjualan}}">
                            </div>
                            <div class="form-group">
                                <label for="">Qty</label>
                                <input type="text" name="qty" class="form-control" value="{{$penjualan->qty_brg}}">
                            </div>

                            <button class="btn btn-danger">Tambahkan </button>
                        </form>

                    </div>
                </div>
            </div>


        </div>


        <!-- /.container-fluid -->
    </div>

    </script>

    <script>
        $(document).ready(function() {
            $('.formubahcoa').submit(function(e) {
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
