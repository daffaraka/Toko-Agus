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
                        <h6 class="m-0 font-weight-bold text-danger">Tambah Data Penjualan</h6>

                        <!-- Tombol Tambah Data -->

                        <!-- Akghir Tombol Tambah Data -->

                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="{{ route('penjualan.store') }}" method="POST">

                            @csrf

                            <div class="form-group">
                                <label for="">No Penjualan</label>
                                <input type="text" name="no_penjualan" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Pelanggan</label>
                                <select type="text" name="id_pelanggan" class="form-control" required>
                                    @foreach ($pelanggan as $select)
                                        <option value="{{ $select->id }}">{{ $select->nama_pelanggan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group">
                                <label for="">Jenis Pembayaran</label>
                                <input type="text" name="no_penjualan" class="form-control">
                            </div> --}}
                            <div class="form-group">
                                <label for="">Kasir</label>
                                <input type="text" name="kasir" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="">Jenis Pembayaran</label>
                                <select type="text" name="jenis_pembayaran" class="form-control" required>
                                    <option value="Lunas">Lunas</option>
                                    <option value="Cicil">Cicil</option>
                                </select>
                            </div>

                            <label for="">Barang</label>
                            <div id="inputFormRow">
                                <div class="input-group">
                                    <select type="text" name="id_barang[]" class="form-control" required>
                                        @foreach ($barang as $selectBarang)
                                            <option value="{{ $selectBarang->id_barang }}">
                                                {{ $selectBarang->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <input type="number" name="qty[]" id="qty" class="form-control m-input text-dark"
                                        placeholder="Qty barang" required autocomplete="off" required>
                                    <button type="button" class="btn btn-danger">--------</button>

                                </div>



                            </div>

                            <div id="newRow"></div>


                            <button id="addRow" type="button" class="btn btn-sm btn-secondary mb-4 mt-3">Tambah
                                Barang</button>


                            <div class="div">
                                <button class="btn btn-danger">Simpan </button>
                            </div>


                        </form>

                    </div>
                </div>
            </div>


        </div>


        <!-- /.container-fluid -->
    </div>

    </script>

    <script src="{{ asset('vendor/jquery/jquery.js') }}"></script>

    <script>

        $("#addRow").click(function() {

            // Get the JSON data as an array
            var barangArray = {!! $barang !!};

            // Create the options HTML using a loop
            var options = '';
            $.each(barangArray, function(key, barang) {
                options += '<option value="' + barang.id_barang + '">' + barang.nama_barang +
                    '</option>';
            });

            // Create the new row HTML

            var html = '';
            html += '<div id="inputFormRow" class="mt-3">';
            html += '<div class="input-group mb-3">';
            html +=
                '<select class="livesearch form-control" name="id_barang[]" ';
            html += '<option>Pilih Barang </option> ';
            html += options;
            html += '</select>';
            html +=
                ' <input type="number" name="qty[]" class="form-control m-input text-dark" placeholder="Qty barang" required autocomplete="off">';

            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Kurangi</button>';
            html += '</div>';
            html += '</div>';
            html += '</div>';

            // Append the new row to #newRow

            $('#newRow').append(html);
            // $('.livesearch').select2();
        });

        $(document).on('click', '#removeRow', function() {
            $(this).closest('#inputFormRow').remove();
        });

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
