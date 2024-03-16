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
              font-size: 1rem;
              padding: .5rem;
            }
            table {
              height: 10px;
              border-collapse: collapse;
              margin-top: 36px;
            }

            .with-border {
                border-top: 1px solid gray;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        @php
            $large_data = [];
            array_merge();

        @endphp
        <h1>SINTUA RADJAWANE SH & PARTNERS</h1>
        <h2>Slip gaji</h2>
        <p>Periode: {{ $periode->dari }} - {{ $periode->hingga }}</p>

        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $data["nama"] }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $data["nik"] }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $data["jabatan"] }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <td>Gaji</td>
                <td>:</td>
                <td>{{ number_format($data["gaji"], 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Upah Lembur</td>
                <td>:</td>
                <td>{{ number_format($data["upah_lembur"], 0, ',', '.') }}</td>
            </tr>
            @foreach($list_potongan as $p)
                <tr>
                    <td>{{ $p->keterangan }}</td>
                    <td>:</td>
                    <td>-{{ number_format($data[$p->keterangan], 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="with-border">
                <td>Jumlah</td>
                <td>:</td>
                <td>Rp. {{ number_format($data["total_gaji"], 0, ',', '.') }}</td>
            </tr>
        </table>
    </body>
</html>
