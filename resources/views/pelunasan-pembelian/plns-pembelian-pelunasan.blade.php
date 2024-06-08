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
            <div class="col-xl-6 col-lg-6 col-sm-6">
                <div class="card shadow mb-4">

                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-danger">Edit Data Pembelian</h6>

                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label for="">Pembelian (Yang belum lunas) </label>
                            <input type="text" class="form-control" value="{{ $plnPembelian->supplier->nama_supplier }}"
                                readonly>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Barang</label>
                            <div class="card">
                                <div class="card-body">
                                    <ul>
                                     @foreach ($plnPembelian->pembelianBarang as $barang)
                                            <li>{{ $barang->barang->nama_barang }} - ( {{ $barang->qty }} ) -
                                                Rp.{{ number_format($barang->barang->harga) }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="">Jenis Pembayaran</label>
                            <input type="text" name="jenis_pembayaran" class="form-control" required
                                value="{{ $plnPembelian->jenis_pembayaran }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Total Pembelian</label>
                            <input type="number" name="total_pembelian" class="form-control" required
                                value="{{ $plnPembelian->total_pembelian }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Sisa Pembayaran</label>
                            <input type="number" name="total_pembelian" class="form-control" required
                                value="{{ $plnPembelian->sisa_pembayaran }}" readonly>
                        </div>


                    </div>

                    <div class="card-body">
                        <form action="{{ route('pelunasanPembelian.update', $plnPembelian->id) }}" method="POST">

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-sm-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-danger">Tambah Data Pelunasan Pembelian</h6>
                    </div>
                    @if ($plnPembelian->sisa_pembayaran == 0)
                        <div class="card-body">
                            <h3>Cicilan sudah lunas</h3>
                        </div>
                    @else

                        <div class="card-body">
                            <form action="{{ route('pelunasanPembelian.store') }}" method="POST">

                                @csrf
                                <input type="hidden" name="pembelian_id" value="{{ $plnPembelian->id }}">
                                <div class="form-group">
                                    <label for="my-input">Nominal Pembayaran</label>
                                    <input id="my-input" class="form-control" type="number" name="nominal_pembayaran">
                                </div>

                                <button class="btn btn-danger">Tambahkan </button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>


            <div class="col-xl-12 col-lg-12 col-sm-12">
                <div class="table-responsive">
                    <!-- Untuk tempat menaruh tabel -->
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Nominal Pembayaran</th>
                                <th>Waktu Pembayaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataPelunasan as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>Rp.{{ number_format($data->nominal_pembayaran) }}</td>
                                    <td>{{ $data->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                                    <td>


                                    </td>


                                </tr>
                            @empty
                                Belum ada data pelunasan
                            @endforelse

                        </tbody>
                    </table>
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
