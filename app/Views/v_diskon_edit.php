<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Edit Diskon</h2>
<form method="post" action="/diskon/update/<?= $diskon['id'] ?>">
  <div class="mb-3">
    <label for="tanggal">Tanggal</label>
    <input type="date" name="tanggal" class="form-control" value="<?= $diskon['tanggal'] ?>" readonly>
  </div>
  <div class="mb-3">
    <label for="nominal">Nominal</label>
    <input type="number" name="nominal" class="form-control" value="<?= $diskon['nominal'] ?>" required>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>

<?= $this->endSection() ?>
