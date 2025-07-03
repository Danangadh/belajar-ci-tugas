<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Tambah Diskon</h2>
<?php if (session()->get('errors')): ?>
  <div class="alert alert-danger"><ul>
    <?php foreach (session('errors') as $error): ?>
      <li><?= esc($error) ?></li>
    <?php endforeach ?>
  </ul></div>
<?php endif ?>

<form method="post" action="/diskon/store">
  <div class="mb-3">
    <label for="tanggal">Tanggal</label>
    <input type="date" name="tanggal" class="form-control" value="<?= old('tanggal') ?>" required>
  </div>
  <div class="mb-3">
    <label for="nominal">Nominal Diskon</label>
    <input type="number" name="nominal" class="form-control" value="<?= old('nominal') ?>" required>
  </div>
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?= $this->endSection() ?>
