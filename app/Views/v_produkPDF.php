<h1>Data Produk</h1>

<table border="1" width="100%" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Foto</th>
    </tr>

    <?php
    $no = 1;
    foreach ($product as $index => $produk) :
        $base64 = '';
        $path = FCPATH . 'img/' . $produk['foto'];

        if (!empty($produk['foto']) && file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
    ?>
        <tr>
            <td align="center"><?= $no++ ?></td>
            <td><?= esc($produk['nama']) ?></td>
            <td align="right"><?= "Rp " . number_format($produk['harga'], 2, ",", ".") ?></td>
            <td align="center"><?= $produk['jumlah'] ?></td>
            <td align="center">
                <?php if ($base64): ?>
                    <img src="<?= $base64 ?>" width="50px">
                <?php else: ?>
                    <span>Tidak ada gambar</span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<p>Downloaded on <?= date("Y-m-d H:i:s") ?></p>
