@extends('layout')

@section('konten')
    <div>
        <h6 class="text text-center text-black mt-3"> Tambah Data Pelanggan</h6>
    </div>
    <form action="{{ route('perbaikan.store') }}" method="POST">
        @csrf
        <label for="">ID</label>
        <input type="text" name="id_plg" class="form-control mt-2">
        <label for="">Nama Pelanggan</label>
        <input type="text" name="nama_plg" class="form-control mt-2">
        <label for="">Alamat</label>
        <input type="text" name="alamat_plg" class="form-control mt-2">
        <label for="">No Telpon</label>
        <input type="text" name="no_telepon_plg" class="form-control mt-2">
        <label for="">Paket</label>
        <input type="text" name="paket_plg" class="form-control mt-2">
        <label for="">ODP</label>
        <input type="text" name="odp" class="form-control mt-2">
        <label for="">Maps</label>
        <input type="text" name="maps" class="form-control mt-2">

        <button class="btn btn-primary btn-sm">Simpan</button>
    </form>
@endsection
