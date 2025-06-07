<?php $__env->startSection('content'); ?>

<div class="row mb-4">
  <div class="col">
    <div class="card bg-primary text-white shadow">
      <div class="card-body p-4">
        <h4>Hallo selamat Datangg <?php echo e(auth()->user()->name); ?></h4>
      </div>
    </div>
  </div>
</div>

<div class="row g-4 mb-4">
  
  <div class="col-lg-3 col-md-6">
    <div class="card text-white bg-primary shadow-sm">
      <div class="card-body">
        <h5 class="card-title"><?php echo e($totalPengaduan ?? 0); ?></h5>
        <p class="card-text mb-0">Total Pengaduan</p>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="card text-white bg-warning shadow-sm">
      <div class="card-body">
        <h5 class="card-title"><?php echo e($sedangDiproses ?? 0); ?></h5>
        <p class="card-text mb-0">Pengaduan Ditinjau</p>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="card text-white bg-success shadow-sm">
      <div class="card-body">
        <h5 class="card-title"><?php echo e($selesai ?? 0); ?></h5>
        <p class="card-text mb-0">Pengaduan Dikerjakan</p>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="card text-white bg-danger shadow-sm">
      <div class="card-body">
        <h5 class="card-title"><?php echo e($tidakDiproses ?? 0); ?></h5>
        <p class="card-text mb-0">Pengaduan Ditolak</p>
      </div>
    </div>
  </div>
</div>

<div class="row g-4">
  
  <div class="col-lg-7">
    <div class="card shadow-sm h-100">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">Pengaduan Terbaru</h5>
        <a href="/admin/pengaduan" class="btn btn-sm btn-warning">Semua Pengaduan</a>
      </div>
      <div class="card-body p-3">
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Pengirim</th>
              </tr>
            </thead>
            <tbody>
              <?php $__empty_1 = true; $__currentLoopData = $pengaduans ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pengaduan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                  <td><?php echo e($loop->iteration); ?></td>
                  <td><?php echo e($pengaduan->judul_pengaduan); ?></td>
                  <td>
                    <?php
                      $badgeColor = match($pengaduan->status) {
                        'Sedang Diproses' => 'warning',
                        'Selesai' => 'success',
                        'Tidak Dapat Diproses' => 'danger',
                        default => 'secondary'
                      };
                    ?>
                    <span class="badge bg-<?php echo e($badgeColor); ?>"><?php echo e($pengaduan->status); ?></span>
                  </td>
                  <td><?php echo e($pengaduan->user->name ?? 'User tidak ditemukan'); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                  <td colspan="4" class="text-center text-muted">Tidak ada pengaduan.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  
  <div class="col-lg-5">
    <div class="card shadow-sm h-100">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">Komentar Terbaru</h5>
        <a href="/admin/komentar" class="btn btn-sm btn-warning">Semua</a>
      </div>
      <div class="card-body p-3">
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>No</th>
                <th>Komentar</th>
                <th>Oleh</th>
              </tr>
            </thead>
            <tbody>
              <?php $__empty_1 = true; $__currentLoopData = $comments ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                  <td><?php echo e($loop->iteration); ?></td>
                  <td><?php echo e(\Illuminate\Support\Str::limit($comment->body, 50)); ?></td>
                  <td><?php echo e($comment->user->name ?? 'User tidak ditemukan'); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                  <td colspan="3" class="text-center text-muted">Belum ada komentar.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\campus-facility-report-Kelompok4\pengaduan_fasilitas_kampus\resources\views/dashboard.blade.php ENDPATH**/ ?>