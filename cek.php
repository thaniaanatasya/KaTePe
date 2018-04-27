<?php 
$nik = ''; 
if (isset($_POST['nik'])) { 
    $nik = trim($_POST['nik']); 
} 

function bulan($i) { 
    $i = intval($i) - 1; 
    $data = array( 
        'Januari', 
        'Februari', 
        'Maret', 
        'April', 
        'Mei', 
        'Juni', 
        'Juli', 
        'Agustus', 
        'September', 
        'Oktober', 
        'November', 
        'Desember' 
    ); 
    if (isset($data[$i])) { 
        return trim($data[$i]); 
    } 
    return '<span class="error">Invalid</span>'; 
} 

function kode_provinsi($i) { 
    $i = intval($i); 
    $data = array( 
        11 => 'Aceh', 
        12 => 'Sumatera Utara', 
        13 => 'Sumatera Barat', 
        14 => 'Riau', 
        15 => 'Jambi', 
        16 => 'Sumatera Selatan', 
        17 => 'Bengkulu', 
        18 => 'Lampung', 
        19 => 'Kep. Bangka Belitung', 
        21 => 'Kep. Riau', 
        31 => 'DKI Jakarta', 
        32 => 'Jawa Barat', 
        33 => 'Jawa Tengah', 
        34 => 'Yogyakarta', 
        35 => 'Jawa Timur', 
        36 => 'Banten', 
        51 => 'Bali', 
        52 => 'Nusa Tenggara Barat', 
        53 => 'Nusa Tenggara Timur', 
        61 => 'Kalimantan Barat', 
        62 => 'Kalimantan Tengah', 
        63 => 'Kalimantan Selatan', 
        64 => 'Kalimantan Timur', 
        71 => 'Sulawesi Utara', 
        72 => 'Sulawesi Tengah', 
        73 => 'Sulawesi Selatan', 
        74 => 'Sulawesi Tenggara', 
        75 => 'Gorontalo', 
        76 => 'Sulawesi Barat', 
        81 => 'Maluku', 
        82 => 'Maluku Utara', 
        91 => 'Papua Barat', 
        94 => 'Papua' 
    ); 
    if (isset($data[$i])) { 
        return trim($data[$i]); 
    } 
    return '<span class="error">Invalid</span>'; 
} 
?><html> 
<head> 
<title>Arti NIK</title> 
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<style type="text/css"> 
body { 
    font-size:1em; 
    padding:1em; 
} 
.error { 
    color:#F00; 
    font-weight:900; 
} 
</style> 
</head> 
<body> 
<form method="post"> 
<input type="hidden" name="go" value="1" /> 
<div> 
NIK (16 digit) : <input type="text" name="nik" value="<?php echo htmlentities($nik); ?>" /> 
</div> 
<input type="submit" value=" Cek " /> 
</form> 
<?php 
if (isset($_POST['go'])) { 
    if (strlen($nik) != 16) { 
        echo '<div class="error">Panjang NIK harus 16 angka. Input Anda = '.strlen($nik).' angka.</div>'; 
    } else { 
        $data = array(); 
        $data['provinsi'] = substr($nik, 0, 2); 
        $data['kota'] = substr($nik, 2, 2); 
        $data['kecamatan'] = substr($nik, 4, 2); 
        $data['tanggal_lahir'] = substr($nik, 6, 2); 
        $data['bulan_lahir'] = substr($nik, 8, 2); 
        $data['tahun_lahir'] = substr($nik, 10, 2); 
        $data['unik'] = substr($nik, 12, 4); 
        if (intval($data['tanggal_lahir']) > 40) { 
            $data['tanggal_lahir_2'] = intval($data['tanggal_lahir']) - 40; 
            $gender = 'Wanita'; 
        } else { 
            $data['tanggal_lahir_2'] = intval($data['tanggal_lahir']); 
            $gender = 'Pria'; 
        } 
        //echo '<pre>'; 
        //print_r($data); 
        //echo '</pre>'; 
        ?> 
        <table border="1" cellpadding="5" cellspacing="0"> 
            <tr> 
                <th>Angka</th> 
                <th>Kode</th> 
                <th>Arti</th> 
            </tr> 
            <tr> 
                <td> 
                    <?php echo $data['provinsi']; ?> 
                </td> 
                <td> 
                    Provinsi 
                </td> 
                <td> 
                    <?php echo kode_provinsi($data['provinsi']); ?> 
                </td> 
            </tr> 
            <tr valign="top"> 
                <td> 
                    <?php echo $data['kota']; ?> 
                </td> 
                <td> 
                    Kota / Kabupaten 
                </td> 
                <td> 
                    <a href="http://www.kemendagri.go.id/pages/data-wilayah">Cek di sini</a> 
                    <br /> 
                    <span style="font-weight:900;color:#00F"> 
                    <?php if (intval($data['kota']) > 70) { 
                        echo 'Kota'; 
                    } else { 
                        echo 'Kabupaten'; 
                    } 
                    ?> 
                    </span> 
                </td> 
            </tr> 
            <tr> 
                <td> 
                    <?php echo $data['kecamatan']; ?> 
                </td> 
                <td> 
                    Kecamatan 
                </td> 
                <td> 
                    <a href="http://www.kemendagri.go.id/pages/data-wilayah">Cek di sini</a> 
                </td> 
            </tr> 
            <tr valign="top"> 
                <td> 
                    <?php echo $data['tanggal_lahir']; ?> 
                </td> 
                <td> 
                    Tanggal Lahir 
                </td> 
                <td> 
                    <?php echo $data['tanggal_lahir_2']; ?> 
                    <br /> 
                    <span style="font-weight:900;color:#00F"><?php echo $gender; ?></span> 
                </td> 
            </tr> 
            <tr> 
                <td> 
                    <?php echo $data['bulan_lahir']; ?> 
                </td> 
                <td> 
                    Bulan Lahir 
                </td> 
                <td> 
                    <?php echo bulan($data['bulan_lahir']); ?> 
                </td> 
            </tr> 
            <tr> 
                <td> 
                    <?php echo $data['tahun_lahir']; ?> 
                </td> 
                <td> 
                    Tahun Lahir 
                </td> 
                <td> 
                    <?php echo $data['tahun_lahir']; ?> 
                </td> 
            </tr> 
            <tr> 
                <td> 
                    <?php echo $data['unik']; ?> 
                </td> 
                <td> 
                    Nomor Urut 
                </td> 
                <td> 
                    <?php echo $data['unik']; ?> 
                </td> 
            </tr> 
        </table> 
        <?php 
    } 
} 
?> 
</body> 
</html>