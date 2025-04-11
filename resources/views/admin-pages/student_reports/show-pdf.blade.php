<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cetak Rapor {{ $student->nama }} - PDF</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 1px;
        }

        .header h3 {
            font-size: 12px;
            margin: 1px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 7px 0;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 3px;
            vertical-align: top;
        }

        .table th {
            background-color: #e7e7e7;
            text-align: left;
        }

        .subheading {
            font-weight: bold;
            background-color: #f2f2f2;
            padding: 3px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h3 style="margin: 2px 0;">LAPORAN HASIL BELAJAR (RAPOR) PESERTA DIDIK</h3>
            <h3 style="margin: 2px 0;">
                @if ($schoolYear && $schoolYear->semester === 'I (Satu)')
                    SEMESTER I (SATU)
                @elseif ($schoolYear && $schoolYear->semester === 'II (Dua)')
                    SEMESTER II (DUA)
                @else
                    SEMESTER TIDAK DIKETAHUI
                @endif
                TAHUN PELAJARAN {{ $schoolYear->tahun_awal ?? '-' }}/{{ $schoolYear->tahun_akhir ?? '-' }}
            </h3>
            <h3 style="margin: 2px 0;">SEKOLAH DASAR ISLAM TERPADU ALIYA KOTA BOGOR</h3>
        </div>

        <!-- Identitas -->
        <table style="width: 100%; border-spacing: 5px;">
            <tr>
                <td style="width: 33%; vertical-align: top;">
                    <p style="margin: 5px 0;"><strong>Nama Peserta Didik<span
                                style="display: inline-block; width: 20px;"></span>:
                            {{ $student->nama }}</strong></p>
                    <p style="margin: 5px 0;"><strong>NIS / NISN<span
                                style="display: inline-block; width: 69px;"></span>:
                            {{ $student->nis }} / {{ $student->nisn }}</strong></p>
                    <p style="margin: 5px 0;"><strong>Alamat Sekolah<span
                                style="display: inline-block; width: 40px;"></span>:
                            {{ $schoolProfile->alamat }}</strong></p>
                </td>
                <td style="width: 10%; vertical-align: top;">
                    <p style="margin: 5px 0;"><strong>Kelas<span style="display: inline-block; width: 30px;"></span>:
                            {{ $class->nama }}</strong></p>
                    <p style="margin: 5px 0;"><strong>Fase<span style="display: inline-block; width: 35px;"></span>:
                            @php
                                $className = $class->nama ?? '';
                                if (preg_match('/[1-2]/', $className)) {
                                    $fase = 'A';
                                } elseif (preg_match('/[3-4]/', $className)) {
                                    $fase = 'B';
                                } elseif (preg_match('/[5-6]/', $className)) {
                                    $fase = 'C';
                                } else {
                                    $fase = 'Tidak Diketahui';
                                }

                            @endphp
                            {{ $fase }}
                        </strong></p>
                </td>
            </tr>
        </table>

        <!-- Nilai -->
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 5%;">NO</th>
                    <th style="text-align: left;">MATA PELAJARAN</th>
                    <th style="width: 15%;">NILAI AKHIR</th>
                </tr>
            </thead>
            <tbody>
                @php $isMuatanLokalDisplayed = false; @endphp
                @foreach ($subjects as $subject)
                    @if ($subject->kelompok_mapel == 'Muatan Lokal' && !$isMuatanLokalDisplayed)
                        <tr>
                            <td colspan="3" class="subheading">MUATAN LOKAL & MUATAN KHAS SDIT ALIYA</td>
                        </tr>
                        @php $isMuatanLokalDisplayed = true; @endphp
                    @endif
                    @php
                        $subjectName = strtolower($subject->nama);
                        $targetLabel = 'Target';
                        $capaianLabel = 'Capaian';
                        if (
                            stripos($subjectName, "al-qur'an metode ummi") !== false ||
                            stripos($subjectName, 'tahfiz') !== false
                        ) {
                            $targetLabel = 'Target Akhir Semester';
                            $capaianLabel = 'Capaian Saat Ini';
                        }
                        $grade = $grades->firstWhere('subject_id', $subject->id);
                        $gradeDetail = $grade ? $gradeDetails->firstWhere('grade_id', $grade->id) : null;

                        $hasDetail =
                            $gradeDetail &&
                            ($gradeDetail->target || $gradeDetail->capaian || $gradeDetail->aplikasi_program);
                        $detailCount = collect([
                            $gradeDetail?->target,
                            $gradeDetail?->capaian,
                            $gradeDetail?->aplikasi_program,
                        ])
                            ->filter()
                            ->count();
                    @endphp

                    <tr>
                        <td rowspan="{{ $hasDetail ? $detailCount + 1 : 1 }}"
                            style="text-align: center; vertical-align: middle;">
                            {{ $loop->iteration }}</td>
                        <td>{{ $subject->nama }}</td>
                        <td rowspan="{{ $hasDetail ? $detailCount + 1 : 1 }}"
                            style="text-align: center; vertical-align: middle;">
                            {{ $grade ? $grade->nilai : 'Belum diisi' }}
                        </td>
                    </tr>

                    @if ($gradeDetail && $gradeDetail->target)
                        <tr>
                            <td>
                                {{ $targetLabel }} : {{ $gradeDetail->target }}
                            </td>
                        </tr>
                    @endif

                    @if ($gradeDetail && $gradeDetail->capaian)
                        <tr>
                            <td>
                                {{ $capaianLabel }} : {{ $gradeDetail->capaian }}
                            </td>
                        </tr>
                    @endif

                    @if ($gradeDetail && $gradeDetail->aplikasi_program)
                        <tr>
                            <td>
                                Aplikasi/program : {{ $gradeDetail->aplikasi_program }}
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <!-- Prestasi -->
        <table class="table">
            <thead>
                <tr>
                    <th colspan="3">PRESTASI</th>
                </tr>
                <tr>
                    <th style="width: 5%; text-align: center">No</th>
                    <th style="width: 30%; text-align: left;">Jenis Prestasi</th>
                    <th style="text-align: left;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $achievementsList = $achievements->where('student_id', $student->id);
                    $count = $achievementsList->count();
                @endphp
                @foreach ($achievementsList as $i => $achievement)
                    <tr>
                        <td style="text-align: center">{{ $i + 1 }}</td>
                        <td style="text-align: left;">{{ $achievement->jenis_prestasi }}</td>
                        <td style="text-align: left;">{{ $achievement->keterangan }}</td>
                    </tr>
                @endforeach
                @for ($i = $count + 1; $i <= 2; $i++)
                    <tr>
                        <td style="text-align: center">{{ $i }}</td>
                        <td style="text-align: left;">-</td>
                        <td style="text-align: left;">-</td>
                    </tr>
                @endfor
            </tbody>
        </table>

        <!-- Catatan Guru -->
        <table class="table">
            <thead>
                <tr>
                    <th>CATATAN GURU</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $notes->catatan ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Absensi -->
        <div style="width: 40%; float: left;">
            <table class="table table-sm table-bordered" style="margin-top: 2px;">
                <thead>
                    <tr>
                        <th colspan="2">KETIDAKHADIRAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sakit</td>
                        <td>{{ $attendances->sakit ?? '0' }} Hari</td>
                    </tr>
                    <tr>
                        <td>Izin</td>
                        <td>{{ $attendances->izin ?? '0' }} Hari</td>
                    </tr>
                    <tr>
                        <td>Tanpa Keterangan</td>
                        <td>{{ $attendances->alfa ?? '0' }} Hari</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Keputusan -->
        @php
            $className = $class->nama;
            $naikKelas = '-';

            if (Str::contains($className, '1')) {
                $naikKelas = 'II (Dua)';
            } elseif (Str::contains($className, '2')) {
                $naikKelas = 'III (Tiga)';
            } elseif (Str::contains($className, '3')) {
                $naikKelas = 'IV (Empat)';
            } elseif (Str::contains($className, '4')) {
                $naikKelas = 'V (Lima)';
            } elseif (Str::contains($className, '5')) {
                $naikKelas = 'VI (Enam)';
            } elseif (Str::contains($className, '6')) {
                $naikKelas = 'LULUS';
            }
        @endphp

        @if ($graduationDecision)
            <div style="width: 45%; margin-top: 10px; float: right; text-align: left; line-height: 1.5;">
                <p style="margin: 0;"><strong>Keputusan</strong></p>
                <p style="margin: 0;">
                    Berdasarkan hasil yang dicapai pada semester 1 dan 2 maka peserta didik ditetapkan:
                    <br>
                    <strong>
                        @if ($graduationDecision->status === 'lulus')
                            @if ($naikKelas === 'LULUS')
                                LULUS dari satuan pendidikan
                            @else
                                Naik ke Kelas {{ $naikKelas }}
                            @endif
                        @elseif ($graduationDecision->status === 'tidak lulus')
                            @if ($naikKelas === 'LULUS')
                                TIDAK LULUS dari satuan pendidikan
                            @else
                                Tidak Naik Kelas
                            @endif
                        @endif
                    </strong>
                </p>
            </div>
        @endif

        <!-- Signature -->
        <div style="clear: both; width: 100%;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 30%; text-align: center;">
                        Orangtua / Wali
                        <div style="height: 50px;"></div>
                        <strong>(...............................................)</strong>
                    </td>
                    <td style="width: 30%; text-align: center; position: relative;">
                        <div style="position: relative; top: 70px;"> <!-- atur offset vertikal di sini -->
                            Mengetahui,<br>
                            Kepala Sekolah
                            <div style="height: 50px;"></div>
                            <strong>{{ $schoolProfile->kepsek ?? '...............................................' }}</strong>
                        </div>
                    </td>
                    <td style="width: 30%; text-align: center;">
                        {{ $schoolYear->tempat_rapor ?? 'Bogor' }},
                        {{ \Carbon\Carbon::parse($schoolYear->tanggal_rapor)->locale('id')->translatedFormat('d F Y') ?? '-' }}
                        <br>
                        Wali Kelas
                        <div style="height: 40px;"></div>
                        <strong>{{ $class->waliKelas->nama ?? '...............................................' }}</strong>
                    </td>
                </tr>
            </table>
        </div>

    </div>
</body>

</html>
