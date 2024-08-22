@extends('layout')

@section('konten')

<form action="{{route('perbaikan.update', $perbaikan->id)}}" method="POST">
    @csrf
    <label for="">ID</label>
    <input type="text" name="id_plg" value="{{$perbaikan -> id_plg}}" class="form-control mt-2">
    <label for="">Nama Pelanggan</label>
    <input type="text" name="nama_plg" value="{{$perbaikan -> nama_plg}}"  class="form-control mt-2">
    <label for="">Alamat</label>
    <input type="text" name="alamat_plg" value="{{$perbaikan -> alamat_plg}}" class="form-control mt-2">
    <label for="">No Telpon</label>
    <input type="text" name="no_telepon_plg" value="{{$perbaikan -> no_telepon_plg}}" class="form-control mt-2">
    <label for="">Paket</label>
    <input type="text" name="paket_plg" value="{{$perbaikan -> paket_plg}}" class="form-control mt-2">
    <label for="">ODP</label>
    <input type="text" name="odp" value="{{$perbaikan -> no_telepon_plg}}" class="form-control mt-2">
    <label for="">Maps</label>
    <input type="text" name="maps" value="{{$perbaikan -> paket_plg}}" class="form-control mt-2">
    <button class="btn btn-primary btn-sm">Simpan</button>
</form>

@endsection

