<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= session()->getFlashData('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<?php echo form_open('keranjang/edit') ?>

<table class="table datatable">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Foto</th>
      <th>Harga</th>
      <th>Jumlah</th>
      <th>Subtotal</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 1;
    $grandTotal = 0;

    if (!empty($items)) :
      foreach ($items as $index => $item) :
        $diskon = isset($item['options']['diskon']) ? $item['options']['diskon'] : 0;
        $hargaAsli = $item['price'] + $diskon;
        $hargaSetelahDiskon = $item['price'];
        $subtotal = $item['subtotal'];
        $grandTotal += $subtotal;
    ?>
        <tr>
          <td><?= $item['name'] ?></td>
          <td>
            <?php if (!empty($item['options']['foto'])): ?>
              <img src="<?= base_url('img/' . $item['options']['foto']) ?>" width="100px">
            <?php endif; ?>
          </td>
          <td>
            <del class="text-muted"><?= number_to_currency($hargaAsli, 'IDR') ?></del><br>
            <?= number_to_currency($hargaSetelahDiskon, 'IDR') ?>
            <?php if (!empty($diskon)): ?>
              <br><small class="text-success">-Rp <?= number_format($diskon) ?> diskon</small>
            <?php endif; ?>
          </td>
          <td>
            <input type="number" min="1" name="qty<?= $i++ ?>" class="form-control" value="<?= $item['qty'] ?>">
          </td>
          <td><?= number_to_currency($subtotal, 'IDR') ?></td>
          <td>
            <a href="<?= base_url('keranjang/delete/' . $item['rowid']) ?>" class="btn btn-danger">
              <i class="bi bi-trash"></i>
            </a>
          </td>
        </tr>
    <?php
      endforeach;
    endif;
    ?>
  </tbody>
</table>

<div class="alert alert-info">
  <?= "Total = " . number_to_currency($grandTotal, 'IDR') ?>
</div>

<button type="submit" class="btn btn-primary">Perbarui Keranjang</button>
<a class="btn btn-warning" href="<?= base_url('keranjang/clear') ?>">Kosongkan Keranjang</a>

<?php if (!empty($items)) : ?>
  <a class="btn btn-success" href="<?= base_url('checkout') ?>">Selesai Belanja</a>
<?php endif; ?>

<?php echo form_close() ?>
<?= $this->endSection() ?>
