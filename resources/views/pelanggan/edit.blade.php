@extends('layout')

@section('konten')

<form action="{{route('pelanggan.update', $pelanggan->id)}}" method="POST">
    @csrf
    <label for="">ID</label>
    <input type="text" name="id_plg" value="{{$pelanggan -> id_plg}}" class="form-control mt-2">
    <label for="">Nama Pelanggan</label>
    <input type="text" name="nama_plg" value="{{$pelanggan -> nama_plg}}"  class="form-control mt-2">
    <label for="">Alamat</label>
    <input type="text" name="alamat_plg" value="{{$pelanggan -> alamat_plg}}" class="form-control mt-2">
    <label for="">No Telpon</label>
    <input type="text" name="no_telepon_plg" value="{{$pelanggan -> no_telepon_plg}}" class="form-control mt-2">
    <label for="">Aktivasi</label>
    <input type="text" name="aktivasi_plg" value="{{$pelanggan -> aktivasi_plg}}" class="form-control mt-2">
    <label for="">Paket</label>
    <input type="text" name="paket_plg" value="{{$pelanggan -> paket_plg}}" class="form-control mt-2">
    <label for="">Harga Paket</label>
    <input type="text" name="harga_paket" value="{{$pelanggan -> harga_paket}}" class="form-control mt-2">
    <label for="">Tanggal Tagih</label>
    <input type="text" name="tgl_tagih_plg" value="{{$pelanggan -> tgl_tagih_plg}}" class="form-control mt-2">
    <label for="">Status</label>
    <input type="text" name="status_plg" value="{{$pelanggan -> status_plg}}" class="form-control mt-2">
    <label for="">Keterangan</label>
    <input type="text" name="keterangan_plg" value="{{$pelanggan -> keterangan_plg}}" class="form-control mt-2">

    <button class="btn btn-primary btn-sm">Simpan</button>
</form>

@endsection

