@extends('layoutbootstrap')

@section('konten')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create Barang</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>
        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12 col-sm-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-danger">Barang</h6>

                        <!-- Tombol Tambah Data -->
                        <a href="#" class="btn btn-danger btn-icon-split btn-sm">
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

                        <!-- Display Error jika ada error -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- Akhir Display Error -->

                        <!-- Awal Dari Input Form -->
                        <form action="{{ route('barang.store') }}" method="post">
                            @csrf

                            <div class="mb-1"><label for="idbaranglabel">Id Barang</label>
                                <input class="form-control form-control-solid" id_barang="id_barang" name="id_barang"
                                    type="text" placeholder="Contoh: 2311" value="{{ old('id_barang') }}">
                            </div>

                            <div class="mb-3"><label for="namabaranglabel">Nama Barang</label>
                                <input class="form-control form-control-solid" id_barang="nama_barang" name="nama_barang"
                                    type="text" placeholder="Contoh: Paku" value="{{ old('nama_barang') }}">
                            </div>

                            <div class="mb-3"><label for="jumlahlabel">Jumlah</label>
                                <input class="form-control form-control-solid" id_barang="jumlah" name="jumlah" type="text"
                                    placeholder="Contoh: 1" value="{{ old('jumlah') }}">
                            </div>

                            <div class="mb-0"><label for="stoklabel">Stok</label>
                                <input class="form-control form-control-solid" id_barang="stok" name="stok" type="text"
                                    placeholder="Contoh: 2" value="{{ old('stok') }}">
                            </div>
                            <div class="mb-0"><label for="hargabelilabel">Harga Beli</label>
                                <input class="form-control form-control-solid" id_barang="harga_beli" name="harga_beli" type="text"
                                    placeholder="Contoh: 12000" value="{{ old('harga_beli') }}">
                            </div>
                            <div class="mb-0"><label for="hargalabel">Harga</label>
                                <input class="form-control form-control-solid" id_barang="harga" name="harga" type="text"
                                    placeholder="Contoh: 20000" value="{{ old('harga') }}">
                            </div>
                            <br>
                            <!-- untuk tombol simpan -->

                            <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Simpan">

                            <!-- untuk tombol batal simpan -->
                            <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/barang') }}" role="button">Batal</a>

                        </form>
                        <!-- Akhir Dari Input Form -->
                    </div>
                </div>
            </div>


        </div>


        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
@endsection
