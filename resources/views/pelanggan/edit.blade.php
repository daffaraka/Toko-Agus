@extends('layoutbootstrap')

@section('konten')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
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
                        <h6 class="m-0 font-weight-bold text-danger">Pelanggan</h6>

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
                        <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3"><label for="namapelangganlabel">Nama Pelanggan</label><input
                                    class="form-control form-control-solid" id="nama_pelanggan" name="nama_pelanggan"
                                    type="text" placeholder="Contoh: Della" value="{{ $pelanggan->nama_pelanggan }}">
                            </div>

                            <div class="mb-3"><label for="notelplabel">No Telepon</label>
                                <input class="form-control form-control-solid" id="no_telp" name="no_telp"
                                    type="text" placeholder="Contoh: 085895476321"
                                    value="{{ $pelanggan->no_telp }}">
                            </div>

                            <div class="mb-0"><label for="alamatpelangganlabel">Alamat Pelanggan</label>
                                <input class="form-control form-control-solid" id="alamat_pelanggan" name="alamat_pelanggan"
                                    type="text" placeholder="Contoh: Bandung"
                                    value="{{ $pelanggan->alamat_pelanggan }}">
                            </div>
                            <br>
                            <!-- untuk tombol simpan -->

                            <input class="col-sm-1 btn btn-info btn-sm" type="submit" value="Ubah">

                            <!-- untuk tombol batal simpan -->
                            <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/pelanggan') }}"
                                role="button">Batal</a>
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
