<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')): ?>
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    <?= session()->getFlashData('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<?php if (session()->getFlashData('failed')): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= session()->getFlashData('failed') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
  Tambah Diskon
</button>

<form method="get" action="<?= base_url('/diskon') ?>" class="row mb-3">
</form>

<table class="table datatable">
  <thead>
    <tr>
      <th>#</th>
      <th>Tanggal</th>
      <th>Nominal</th>
      <th>Atur</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($diskon as $i => $d): ?>
    <tr>
      <td><?= $i + 1 ?></td>
      <td><?= $d['tanggal'] ?></td>
      <td>Rp <?= number_format($d['nominal']) ?></td>
      <td>
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-<?= $d['id'] ?>">
          Edit
        </button>
        <a href="<?= base_url('diskon/delete/' . $d['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus data ini?')">
          Hapus
        </a>
      </td>
    </tr>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal-<?= $d['id'] ?>" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Diskon</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <form method="post" action="<?= base_url('diskon/update/' . $d['id']) ?>">
            <?= csrf_field() ?>
            <div class="modal-body">
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" value="<?= $d['tanggal'] ?>" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label>Nominal Diskon</label>
                <input type="number" name="nominal" value="<?= $d['nominal'] ?>" class="form-control" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End Edit Modal -->

    <?php endforeach; ?>
  </tbody>
</table>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Diskon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form method="post" action="<?= base_url('diskon/store') ?>">
        <?= csrf_field() ?>
        <div class="modal-body">
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required value="<?= old('tanggal') ?>">
          </div>
          <div class="form-group">
            <label for="nominal">Nominal Diskon</label>
            <input type="number" name="nominal" class="form-control" required value="<?= old('nominal') ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Add Modal -->

<?= $this->endSection() ?>
