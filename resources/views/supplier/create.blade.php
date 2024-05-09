@extends('layoutbootstrap')

@section('konten')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create Supplier</h1>
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
                        <h6 class="m-0 font-weight-bold text-danger">Supplier</h6>

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
                        <form action="{{ route('supplier.store') }}" method="post">
                            @csrf

                            <div class="mb-3"><label for="idsupplierlabel">Id Supplier</label>
                                <input class="form-control form-control-solid" id="id_supplier" name="id_supplier"
                                    type="text" placeholder="Contoh: Della" value="{{ old('id_supplier') }}">
                            </div>

                            <div class="mb-3"><label for="namasupplierlabel">Nama Supplier</label>
                                <input class="form-control form-control-solid" id="nama_supplier" name="nama_supplier"
                                    type="text" placeholder="Contoh: Della" value="{{ old('nama_supplier') }}">
                            </div>

                            <div class="mb-3"><label for="notelplabel">No Telepon</label>
                                <input class="form-control form-control-solid" id="no_telp" name="no_telp" type="text"
                                    placeholder="Contoh: 085895421567" value="{{ old('no_telp') }}">
                            </div>

                            <div class="mb-0"><label for="alamatsupplierlabel">Alamat Supplier</label>
                                <input class="form-control form-control-solid" id="alamat_supplier" name="alamat_supplier" type="text"
                                    placeholder="Contoh: Bandung" value="{{ old('alamat_supplier') }}">
                            </div>
                            <br>
                            <!-- untuk tombol simpan -->

                            <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Simpan">

                            <!-- untuk tombol batal simpan -->
                            <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/supplier') }}" role="button">Batal</a>

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
