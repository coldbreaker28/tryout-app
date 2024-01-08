<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/home-mahasiswa.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/table.css') }}">
        <title>Ujian Online - Mahasiswa</title>
        <style>
            .chart-card {
                position: relative;
                max-width: 800px;
                width: 100%;
                height: 900px;
                background-color: #fff;
                box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
                border-radius: 8px;
                margin: 15px auto;
                padding: 20px;
            }
        </style>
    </head>
    <body>

        <header>
            <h1>Ujian Online - Online Ujian</h1>
            @include('Components.navbar')
        </header>
        <div class="chart-card">
            <h1>Nilai Mahasiswa</h1>
            <p>Total Skor: {{ $totalSkor }}</p>
            <canvas id="grafikJawaban" width="400" height="200"></canvas>
        </div>
        <div class="table-container">
                <span>Hasil Peserta Ujian </span>
                <table class="responsive-table daftar-table">
                    <thead>
                        <tr>
                            <th scope="col">Waktu Mulai</th>
                            <th scope="col">Status</th>
                            <th scope="col">jawaban Mahasiswa</th>
                            <th scope="col">Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jawaban as $data)
                        <tr>
                            <td style="border: 1px dashed #1B262C; text-align: center;" >{{ $data->updated_at->format('d-M-Y') }}</td>
                            <td style="border: 1px dashed #1B262C; text-align: center;" >{{ $data->status }}</td>
                            <td style="border: 1px dashed #1B262C; text-align: justify;" >{{ $data->jawaban_mahasiswa }}</td>
                            <td style="border: 1px dashed #1B262C; text-align: center;" >{{ $data->poin }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('grafikJawaban').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: @json($dataGrafik['labels']),
                    datasets: [{
                        data: @json($dataGrafik['data']),
                        backgroundColor: @json($dataGrafik['backgroundColor']),
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right'
                        }
                    }
                }
            });
        </script>
        @include('Components.footer')
    </body>
</html>