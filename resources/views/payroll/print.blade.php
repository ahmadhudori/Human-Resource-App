<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            color: #333;
            margin: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
			table-layout: fixed;
        }
        td, th {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
			width: 50%;
    		vertical-align: top;

        }
        .no-border {
            border: none !important;
        }
        .text-right {
            text-align: right;
        }
        .mt-2 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Slip Gaji Karyawan</h2>

    <table>
        <tr>
            <td><strong>Nama Karyawan</strong></td>
            <td>{{ ucfirst($payroll->employee->fullname) }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal</strong></td>
            <td>{{ \Carbon\Carbon::parse($payroll->created_at)->translatedFormat('d F Y') }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Komponen</th>
                <th>Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Gaji Pokok</td>
                <td class="text-right">{{ number_format($payroll->salary, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Bonus</td>
                <td class="text-right">{{ number_format($payroll->bonuses, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Potongan</td>
                <td class="text-right">{{ number_format($payroll->deductions, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Total Bersih</th>
                <th class="text-right">{{ number_format($payroll->net_salary, 0, ',', '.') }}</th>
            </tr>
        </tbody>
    </table>

    <p class="mt-2">Slip ini dicetak otomatis oleh sistem pada {{ now()->translatedFormat('d F Y, H:i') }}.</p>
</body>
</html>
