<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-serif  font-family: ui-serif, Georgia, Cambria, "Times New Roman", Times, serif;
            font-mono   font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;

        }
        table, td, th {
          width: auto;
          border: 1px solid gray;
          font-size: .75rem;
          padding: .5rem;
      }
      table {
          height: 10px;
          border-collapse: collapse;
          margin-top: 36px;
      }

      .page-break {
        page-break-after: always;
    }
</style>
</head>
<body class="font-sans antialiased">
    @php
    $large_data = [];
    array_merge();

    @endphp
    <h1>SINTUA RADJAWANE SH & PARTNERS</h1>
    <h2>Laporan gaji dan absensi</h2>
    <p>Periode: {{ $periode->dari }} - {{ $periode->hingga }}</p>
    <table>
        <thead>
            <tr>
                <th>nik</th>
                <th>nama</th>
                <th>jabatan</th>
                <th>lokasi</th>
                <th>gaji</th>
                <th>hadir</th>
                <th>sakit</th>
                <th>izin</th>
                <th>tanpa keterangan</th>
                <th>off</th>
                <th>lembur</th>
                <th>upah lembur</th>
                @foreach($list_potongan as $p)
                <th>{{ $p->keterangan }}</th>
                @endforeach
                <th>gaji diterima</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $datom)
            <tr>
                <td>{{ $datom["nik"] }}</td>
                <td>{{$datom["nama"]}}</td>
                <td>{{$datom["jabatan"]}}</td>
                <td>{{$datom["lokasi"]}}</td>
                <td>{{  number_format($datom["gaji"], 0, ',', '.') }}</td>
                <td>{{$datom["hadir"]}}</td>
                <td>{{$datom["sakit"]}}</td>
                <td>{{$datom["izin"]}}</td>
                <td>{{$datom["alpha"]}}</td>
                <td>{{$datom["off"]}}</td>
                <td>{{$datom["lembur"]}}</td>
                <td>{{ number_format($datom["upah_lembur"], 0, ',', '.') }}</td>
                @foreach($list_potongan as $p)
                <td>{{ number_format($datom[$p->keterangan], 0, ',', '.') }}</td>
                @endforeach
                <td>{{ number_format($datom["total_gaji"], 0, ',', '.') }}</td>
            </tr>
            @if($loop->iteration % 10 == 0)
            <tr class="page-break"></tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <div style="text-align: right; margin-top: 20px;">
        <p style="margin-bottom: 50px;">Tertanda,</p>
        <p>Staff Administrasi dan Keuangan</p>
    </div>
</body>
</html>
