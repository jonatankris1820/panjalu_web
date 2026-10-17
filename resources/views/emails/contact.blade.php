<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Baru – Kaosintim</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap');

        body { font-family: 'DM Sans', Arial, sans-serif; background: #F9F9F9; margin: 0; padding: 0 20px; }
        .wrapper { max-width: 600px; margin: 30px auto; background: #FFF; border-radius: 12px; overflow: hidden; }
        .header { background: #E52331; padding: 24px 30px; }
        .header h1 { color: #FFF; margin: 0; font-size: 20px; font-weight: 700; }
        .body { padding: 30px 30px 10px 30px; }
        .field { margin-bottom: 25px; }
        .field-label { font-size: 12px; font-weight: 700; text-transform: uppercase; color: #4F5356; margin-bottom: 5px; }
        .field-value { font-size: 15px; color: #000; border-left: 4px solid #E52331; padding-left: 12px; }
        .pesan-box { background: #F9F9F9; border-radius: 8px; padding: 11px 16px; font-size: 15px; color: #000; line-height: 1.6; margin-top: 4px; }
        .footer { background: #E52331; padding: 16px 32px; font-size: 12px; color: #FFF; text-align: center; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Hallo Kaosintim, <br> Pesan Baru Masuk!!</h1>
        </div>
        <div class="body">
            <div class="field">
                <div class="field-label">Nama</div>
                <div class="field-value">{{ $data['nama'] }}</div>
            </div>
            <div class="field">
                <div class="field-label">WhatsApp</div>
                <div class="field-value">{{ $data['whatsapp'] }}</div>
            </div>
            <div class="field">
                <div class="field-label">Email</div>
                <div class="field-value">{{ $data['email'] }}</div>
            </div>
            <div class="field">
                <div class="field-label">Keperluan</div>
                <div class="field-value">{{ ucfirst(str_replace('-', ' ', $data['keperluan'])) }}</div>
            </div>
            <div class="field">
                <div class="field-label">Pesan</div>
                <div class="pesan-box">{{ $data['pesan'] }}</div>
            </div>
        </div>
        <div class="footer">
            Email ini dikirim otomatis dari form kontak website Kaosintim &bull; {{ now()->format('d M Y, H:i') }} WIB
        </div>
    </div>
</body>
</html>
