<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #INV-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</title>
    <style>
        /* CSS Standar khusus untuk DomPDF */
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #333;
            font-size: 14px;
            margin: 0;
            padding: 20px;
        }
        .invoice-box {
            max-width: 100%;
            margin: auto;
            padding: 30px;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
        }
        table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .header-table td {
            padding-bottom: 40px;
            vertical-align: top;
        }
        .header-left {
            width: 50%;
        }
        .header-right {
            width: 50%;
            text-align: right;
        }
        .title {
            font-size: 42px;
            line-height: 45px;
            color: #2563eb; /* Aksen Biru Utama */
            font-weight: bold;
            margin-bottom: 5px;
        }
        .invoice-number {
            font-size: 16px;
            color: #64748b;
            margin-top: 0;
        }
        .info-table {
            margin-bottom: 40px;
        }
        .info-table td {
            vertical-align: top;
        }
        .info-title {
            font-size: 12px;
            font-weight: bold;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        .info-content {
            font-size: 16px;
            font-weight: bold;
            color: #0f172a;
        }
        .blue-text {
            color: #2563eb;
        }
        .item-table {
            border: 1px solid #e2e8f0;
        }
        .item-table th {
            background-color: #eff6ff; /* Aksen Latar Biru Terang */
            color: #1e3a8a;
            font-weight: bold;
            padding: 12px 15px;
            border-bottom: 2px solid #bfdbfe;
        }
        .item-table td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .total-row td {
            padding: 15px;
            font-weight: bold;
        }
        .subtotal {
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
        .grand-total {
            font-size: 20px;
            color: #2563eb;
            background-color: #f8fafc;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            font-weight: bold;
            font-size: 14px;
            border-radius: 4px;
            margin-top: 10px;
        }
        .badge-success { background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .badge-warning { background-color: #fef08a; color: #854d0e; border: 1px solid #fde047; }
        .badge-danger { background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    </style>
</head>
<body>

    <div class="invoice-box">
        <table class="header-table">
            <tr>
                <td class="header-left">
                    <div class="title">INVOICE</div>
                    <p class="invoice-number">#INV-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</p>
                    <p style="color: #64748b; font-size: 14px; margin-top: 5px;">
                        Tanggal Terbit: {{ \Carbon\Carbon::now()->format('d F Y') }}
                    </p>
                </td>
                <td class="header-right">
                    <div class="info-title">Dibayarkan Kepada:</div>
                    <div class="info-content blue-text">PT BROOKAL SUKSES ABADI</div>
                    <p style="margin: 5px 0; color: #475569;">BCA: 123-456-7890</p>
                    <p style="margin: 0; color: #475569;">WhatsApp CS: +62 857-2003-1617</p>
                </td>
            </tr>
        </table>

        <table class="info-table">
            <tr>
                <td style="width: 50%;">
                    <div class="info-title">Ditagihkan Kepada:</div>
                    <div class="info-content">{{ Auth::user()->name }}</div>
                    <p style="margin: 5px 0 0 0; color: #475569;">{{ Auth::user()->email }}</p>
                </td>
            </tr>
        </table>

        <table class="item-table">
            <thead>
                <tr>
                    <th style="text-align: left;">Deskripsi Paket Tour</th>
                    <th class="text-center">Tanggal Berangkat</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-right">Harga Satuan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $transaction->package->name }}</strong>
                    </td>
                    <td class="text-center">{{ $transaction->tour_date->format('d M Y') }}</td>
                    <td class="text-center">{{ $transaction->pax_count }} Pax</td>
                    <td class="text-right">Rp {{ number_format($transaction->package->price, 0, ',', '.') }}</td>
                </tr>

                <tr class="total-row subtotal">
                    <td colspan="3" class="text-right">Subtotal</td>
                    <td class="text-right">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                </tr>
                <tr class="total-row grand-total">
                    <td colspan="3" class="text-right">TOTAL TAGIHAN</td>
                    <td class="text-right">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p style="color: #64748b; font-size: 14px; margin-bottom: 5px;">Status Pembayaran:</p>

            @if($transaction->status == 'approved')
                <div class="status-badge badge-success">LUNAS / SIAP BERANGKAT</div>
            @elseif($transaction->status == 'pending')
                <div class="status-badge badge-danger">BELUM DIBAYAR</div>
            @else
                <div class="status-badge badge-warning">MENUNGGU KONFIRMASI</div>
            @endif

            <p style="margin-top: 30px; color: #94a3b8; font-style: italic; font-size: 13px;">
                Terima kasih telah mempercayakan perjalanan liburan Anda bersama kami.
            </p>
        </div>
    </div>

</body>
</html>
