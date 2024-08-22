@extends('layout')

@section('konten')
    <div>
        <h6 class="text text-center text-black mt-3"> Tambah Data Pelanggan</h6>
    </div>
    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf
        <label for="">ID</label>
        <input type="text" name="id_plg" class="form-control mt-2">
        <label for="">Nama Pelanggan</label>
        <input type="text" name="nama_plg" class="form-control mt-2">
        <label for="">Alamat</label>
        <input type="text" name="alamat_plg" class="form-control mt-2">
        <label for="">No Telpon</label>
        <input type="text" name="no_telepon_plg" class="form-control mt-2">
        <label for="">Aktivasi</label>
        <input type="date" name="aktivasi_plg" class="form-control mt-2">
        <label for="">Paket</label>
        <input type="text" name="paket_plg" class="form-control mt-2">
        <label for="">Harga Paket</label>
        <input type="text" name="harga_paket" class="form-control mt-2">
        <label for="">Tanggal Tagih</label>
        <input type="date" name="tgl_tagih_plg" class="form-control mt-2">
        <label for="">Status</label>
        <input type="text" name="status_plg" class="form-control mt-2">
        <label for="">ODP</label>
        <input type="text" name="odp" class="form-control mt-2">
        <label for="">Maps</label>
        <input type="text" name="maps" class="form-control mt-2">
        <label for="">Keterangan</label>
        <input type="text" name="keterangan_plg" class="form-control mt-2"> <br>

        <button class="btn btn-primary btn-sm">Simpan</button>
    </form>
@endsection
