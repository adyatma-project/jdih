<!DOCTYPE html>
<html>
<head>
    <title>Data Produk Hukum</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 5px; text-align: left; vertical-align: top; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h3>Data Produk Hukum JDIH</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul / Tentang</th>
                <th>Nomor Peraturan</th>
                <th>Tahun</th>
                <th>Kategori</th>
                <th>TEU Badan / Pengarang</th>
                <th>Tgl Penetapan</th>
                <th>Tgl Pengundangan</th>
                <th>Sumber</th>
                <th>Subjek</th>
                <th>Bidang Hukum</th>
                <th>Status</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($produk_hukum_data as $row):
                // Ambil Nama Kategori
                $kategori = $this->db->get_where('ref_kategori', ['id_kategori' => $row->id_kategori])->row();
                $nama_kategori = ($kategori) ? $kategori->kategori : '-';
                
                // Status Text
                $status_text = ($row->status == '1') ? 'Berlaku' : 'Tidak Berlaku';
            ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $row->tentang ?></td>
                <td><?php echo $row->no_peraturan ?></td>
                <td><?php echo $row->tahun ?></td>
                <td><?php echo $nama_kategori ?></td>
                <td><?php echo $row->teu_badan ?></td>
                <td><?php echo $row->tanggal_penetapan ?></td>
                <td><?php echo $row->tanggal_pengundangan ?></td>
                <td><?php echo $row->sumber ?></td>
                <td><?php echo $row->subjek ?></td>
                <td><?php echo $row->bidang_hukum ?></td>
                <td><?php echo $status_text ?></td>
                <td><?php echo $row->file ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>