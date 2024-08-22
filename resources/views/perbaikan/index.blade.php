@extends('layout')

@section('konten')
    <div class="mb-4">
        <div><h5 class="text text-center">Perbaikan</h5></div>
        <!-- Form Filter dan Pencarian -->
        <form action="{{ route('perbaikan.index') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="search" class="sr-only">Pencarian</label>
                    <input type="text" name="search" id="search" class="form-control"
                        value="{{ request('search') }}" placeholder="Pencarian">
                </div>
                <div class="col-md-6 mb-2 position-relative">
                    <label for="date" class="sr-only">Tanggal</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}" placeholder="Tanggal">
                    <i class="bi bi-calendar position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;" onclick="document.getElementById('date').focus();"></i>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Filter</button>
        </form>

        <a href="{{ route('perbaikan.create') }}" class="btn btn-primary btn-sm mb-2">Buat Kasus</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Pel</th>
                    <th>Nama Pel</th>
                    <th>Alamat</th>
                    <th>No Hp</th>
                    <th>Paket</th>
                    <th>Odp</th>
                    <th>Maps</th>
                    <th>
                        <!-- Link untuk sorting -->
                        <a href="{{ route('perbaikan.index', array_merge(request()->except('sort'), ['sort' => $sort === 'asc' ? 'desc' : 'asc'])) }}">
                            Tanggal
                            @if ($sort === 'asc')
                                &uarr; <!-- Icon untuk sorting ascending -->
                            @else
                                &darr; <!-- Icon untuk sorting descending -->
                            @endif
                        </a>
                    </th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($perbaikan as $no => $item)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $item->id_plg }}</td>
                        <td>{{ $item->nama_plg }}</td>
                        <td>{{ $item->alamat_plg }}</td>
                        <td>{{ $item->no_telepon_plg }}</td>
                        <td>{{ $item->paket_plg }}</td>
                        <td>{{ $item->odp }}</td>
                        <td>{{ $item->maps }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('perbaikan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('perbaikan.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada data ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pilihan Filter Grafik -->
    <div class="mb-4">
        <label class="mr-2">Pilih Grafik:</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="chartType" id="weekly" value="weekly">
            <label class="form-check-label" for="weekly">Mingguan</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="chartType" id="monthly" value="monthly">
            <label class="form-check-label" for="monthly">Bulanan</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="chartType" id="yearly" value="yearly">
            <label class="form-check-label" for="yearly">Tahunan</label>
        </div>
    </div>

    <!-- Grafik Perbaikan -->
    <div class="mt-5" id="weeklyChartContainer" style="display:none;">
        <h5>Grafik Perbaikan Mingguan</h5>
        <canvas id="weeklyChart" style="max-height: 300px;"></canvas>
    </div>

    <div class="mt-5" id="monthlyChartContainer" style="display:none;">
        <h5>Grafik Perbaikan Bulanan</h5>
        <canvas id="monthlyChart" style="max-height: 300px;"></canvas>
    </div>

    <div class="mt-5" id="yearlyChartContainer" style="display:none;">
        <h5>Grafik Perbaikan Tahunan</h5>
        <canvas id="yearlyChart" style="max-height: 300px;"></canvas>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const weeklyData = @json($weeklyData);
        const monthlyData = @json($monthlyData);
        const yearlyData = @json($yearlyData);

        const weeklyChart = new Chart(document.getElementById('weeklyChart'), {
            type: 'bar',
            data: {
                labels: Object.keys(weeklyData),
                datasets: [{
                    label: 'Total Perbaikan Mingguan',
                    data: Object.values(weeklyData),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            }
        });

        const monthlyChart = new Chart(document.getElementById('monthlyChart'), {
            type: 'bar',
            data: {
                labels: Object.keys(monthlyData),
                datasets: [{
                    label: 'Total Perbaikan Bulanan',
                    data: Object.values(monthlyData),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            }
        });

        const yearlyChart = new Chart(document.getElementById('yearlyChart'), {
            type: 'bar',
            data: {
                labels: Object.keys(yearlyData),
                datasets: [{
                    label: 'Total Perbaikan Tahunan',
                    data: Object.values(yearlyData),
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            }
        });

        // Tampilkan grafik sesuai pilihan
        document.querySelectorAll('input[name="chartType"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('weeklyChartContainer').style.display = 'none';
                document.getElementById('monthlyChartContainer').style.display = 'none';
                document.getElementById('yearlyChartContainer').style.display = 'none';

                if (this.value === 'weekly') {
                    document.getElementById('weeklyChartContainer').style.display = 'block';
                } else if (this.value === 'monthly') {
                    document.getElementById('monthlyChartContainer').style.display = 'block';
                } else if (this.value === 'yearly') {
                    document.getElementById('yearlyChartContainer').style.display = 'block';
                }
            });
        });
    </script>
@endsection
