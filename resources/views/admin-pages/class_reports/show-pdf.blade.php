<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cetak Legger Kelas {{ $class->nama ?? '-' }} - PDF</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 10x;
            margin: 0;
        }

        .container {
            width: 100%;
        }

        .header {
            position: relative;
            text-align: center
        }

        .header h3 {
            font-size: 14px;
            margin: 1px 0;
        }

        .header h4 {
            font-size: 11px;
            margin: 1px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 2px 3px;
            /* Lebih kecil */
            vertical-align: top;
            font-size: 8.5px;
            /* Ukuran font kecil */
        }

        .table th {
            background-color: #e7e7e7;
        }

        @media print {
            body {
                margin: 0;
            }

            .header h3,
            .header h4 {
                margin: 2px 0;
            }

            table {
                page-break-inside: avoid;
            }

            .ttd.kiri {
                padding-right: 30% !important;
            }

            .ttd.kanan {
                padding-left: 30% !important;
            }
        }
    </style>
</head>

@if (request('mode') === 'print')
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
@endif

<body>
    <div class="container">
        <div class="header" style="z-index: -1; position: relative; margin-bottom : 20px;">
            <h3>LEGGER NILAI (RAPOR) KELAS {{ $class->nama ?? '-' }}</h3>
            <h4>
                @if ($schoolYear && $schoolYear->semester === 'I (Satu)')
                    SEMESTER I (SATU)
                @elseif ($schoolYear && $schoolYear->semester === 'II (Dua)')
                    SEMESTER II (DUA)
                @else
                    SEMESTER TIDAK DIKETAHUI
                @endif
                TAHUN PELAJARAN {{ $schoolYear->tahun_awal ?? '-' }}/{{ $schoolYear->tahun_akhir ?? '-' }}
            </h4>
        </div>

        <!-- TABEL NILAI MATA PELAJARAN -->
        <table class="table table-bordered table-sm" style="width: 100%;">
            <thead>
                <tr>
                    <th rowspan="2" style="vertical-align: middle; text-align: center;">No</th>
                    <th rowspan="2" style="vertical-align: middle;">Nama Lengkap</th>

                    {{-- Kolom Nilai --}}
                    <th colspan="{{ count($subjects) }}" class="border-bottom" style="text-align: center;">Nilai</th>

                    {{-- Kolom Absensi --}}
                    <th colspan="3" class="border-bottom" style="text-align: center;">Absensi</th>

                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Jumlah</th>
                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Rata-rata</th>
                </tr>
                <tr>
                    @foreach ($subjects as $subject)
                        <th style="text-align: center;">{{ $subject->singkatan ?? $subject->nama }}</th>
                    @endforeach
                    <th style="text-align: center;">S</th>
                    <th style="text-align: center;">I</th>
                    <th style="text-align: center;">A</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td>{{ $student->nama }}</td>

                        {{-- Nilai per mapel --}}
                        @foreach ($subjects as $subject)
                            @php
                                $grade = $student->grades->firstWhere('subject_id', $subject->id);
                            @endphp
                            @php
                                $nilai = $grade->nilai ?? null;
                                $style = is_numeric($nilai) && $nilai <= 70 ? 'background-color: #ff7e7e;' : '';
                            @endphp
                            <td style="text-align: center; {{ $style }}">{{ $nilai ?? '-' }}</td>
                        @endforeach

                        {{-- Absensi --}}
                        <td style="text-align: center;">{{ $student->absensi['sakit'] ?? 0 }}</td>
                        <td style="text-align: center;">{{ $student->absensi['izin'] ?? 0 }}</td>
                        <td style="text-align: center;">{{ $student->absensi['alfa'] ?? 0 }}</td>

                        {{-- Jumlah dan Rata-Rata --}}
                        @php
                            $nilaiArray = $subjects
                                ->map(function ($subject) use ($student) {
                                    $nilai = optional($student->grades->firstWhere('subject_id', $subject->id))->nilai;
                                    return is_numeric($nilai) ? floatval($nilai) : null;
                                })
                                ->filter();

                            $jumlah = $nilaiArray->sum();
                            $rataRata =
                                $nilaiArray->count() > 0 ? number_format($jumlah / $nilaiArray->count(), 2) : '-';
                        @endphp
                        <td style="text-align: center;">{{ $jumlah }}</td>
                        <td style="text-align: center;">{{ $rataRata }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="font-weight: bold; background-color: #fff27e;">
                    <th colspan="2" style="text-align: center; background-color: #fff27e;">Nilai rata-rata</th>

                    {{-- Rata-rata per mata pelajaran --}}
                    @foreach ($subjects as $subject)
                        @php
                            $nilaiPerSubject = $students
                                ->map(
                                    fn($student) => optional($student->grades->firstWhere('subject_id', $subject->id))
                                        ->nilai,
                                )
                                ->filter(fn($nilai) => is_numeric($nilai));

                            $rataSubject =
                                $nilaiPerSubject->count() > 0 ? number_format($nilaiPerSubject->avg(), 2) : '-';
                        @endphp
                        <td style="text-align: center;">{{ $rataSubject }}</td>
                    @endforeach

                    {{-- Rata-rata Absensi --}}
                    @php
                        $rataS =
                            $students->pluck('absensi')->pluck('sakit')->filter(fn($v) => is_numeric($v))->avg() ?? 0;
                        $rataI =
                            $students->pluck('absensi')->pluck('izin')->filter(fn($v) => is_numeric($v))->avg() ?? 0;
                        $rataA =
                            $students->pluck('absensi')->pluck('alfa')->filter(fn($v) => is_numeric($v))->avg() ?? 0;
                    @endphp
                    <td style="text-align: center;">{{ number_format($rataS, 2) }}</td>
                    <td style="text-align: center;">{{ number_format($rataI, 2) }}</td>
                    <td style="text-align: center;">{{ number_format($rataA, 2) }}</td>

                    {{-- Rata-rata dari Jumlah dan Rata-rata nilai siswa --}}
                    @php
                        $jumlahSemua = $students
                            ->map(function ($student) use ($subjects) {
                                $nilaiArray = $subjects
                                    ->map(
                                        fn($subject) => optional(
                                            $student->grades->firstWhere('subject_id', $subject->id),
                                        )->nilai,
                                    )
                                    ->filter(fn($nilai) => is_numeric($nilai));
                                return $nilaiArray->sum();
                            })
                            ->filter();

                        $rata2Semua = $students
                            ->map(function ($student) use ($subjects) {
                                $nilaiArray = $subjects
                                    ->map(
                                        fn($subject) => optional(
                                            $student->grades->firstWhere('subject_id', $subject->id),
                                        )->nilai,
                                    )
                                    ->filter(fn($nilai) => is_numeric($nilai));
                                return $nilaiArray->count() > 0 ? $nilaiArray->sum() / $nilaiArray->count() : null;
                            })
                            ->filter();

                        $avgJumlah = $jumlahSemua->count() > 0 ? number_format($jumlahSemua->avg(), 2) : '-';
                        $avgRata2 = $rata2Semua->count() > 0 ? number_format($rata2Semua->avg(), 2) : '-';
                    @endphp
                    <td style="text-align: center;">{{ $avgJumlah }}</td>
                    <td style="text-align: center;">{{ $avgRata2 }}</td>
                </tr>
            </tfoot>
        </table>

        <!-- TABEL TANDA TANGAN -->
        <table style="width: 100%; margin-top: 30px; font-size: 10px;">
            <tr>
                <td class="ttd kiri" style="width: 50%; text-align: center; padding-right: 60%">
                    Kepala Sekolah<br>
                    <span style="display: block; min-height: 50px;"></span>
                    <strong>{{ $schoolProfile->kepsek ?? '...............................................' }}</strong>
                </td>
                <td class="ttd kanan" style="width: 50%; text-align: center; padding-left: 60%">
                    Wali Kelas<br>
                    <span style="display: block; min-height: 50px;"></span>
                    <strong>{{ $class->waliKelas->nama ?? '...............................................' }}</strong>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
