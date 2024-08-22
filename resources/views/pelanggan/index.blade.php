@extends('layout')

@section('konten')
    <div>
        <h6 class="text text-center mt-3">Manajemen Pelanggan</h6>
    </div>
    <div class="mb-4">
        <!-- Form Filter dan Pencarian -->
        <form action="{{ route('pelanggan.index') }}" method="GET" class="form-inline mb-4 justify-content-end">
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}"
                    placeholder="Pencarian">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>

        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary btn-sm mb-2">Pelanggan Baru</a>

        <table class="table table-striped">
            <thead class="table table-primary">
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telpon</th>
                    <th>Aktivasi</th>
                    <th>Paket</th>
                    <th>Harga Paket</th>
                    <th>Tanggal Tagih</th>
                    <th>Status </th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                    <th>Perbaikan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pelanggan as $no => $item)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $item->id_plg }}</td>
                        <td>{{ $item->nama_plg }}</td>
                        <td>{{ $item->alamat_plg }}</td>
                        <td>{{ $item->no_telepon_plg }}</td>
                        <td>{{ $item->aktivasi_plg }}</td>
                        <td>{{ $item->paket_plg }}</td>
                        <td>{{ $item->harga_paket }}</td>
                        <td>{{ $item->tgl_tagih_plg }}</td>
                        <td>{{ $item->status_plg }}</td>
                        <td>{{ $item->keterangan_plg }}</td>
                        <td>
                            <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('perbaikan.store') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id_plg" value="{{ $item->id_plg }}">
                                <input type="hidden" name="nama_plg" value="{{ $item->nama_plg }}">
                                <input type="hidden" name="alamat_plg" value="{{ $item->alamat_plg }}">
                                <input type="hidden" name="no_telepon_plg" value="{{ $item->no_telepon_plg }}">
                                <input type="hidden" name="paket_plg" value="{{ $item->paket_plg }}">
                                <input type="hidden" name="odp" value="{{ $item->odp }}">
                                <input type="hidden" name="maps" value="{{ $item->maps }}">
                                <button type="submit" class="btn btn-warning btn-sm">Perbaikan</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="text-center">Tidak ada data ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
