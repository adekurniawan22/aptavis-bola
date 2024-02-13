<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Daftar Data Klub</h2>
                <a href="<?= base_url('klub/tambah-klub') ?>" class="btn btn-primary text-end">+Tambah Data</a>
            </div>

            <table id="example" class="table">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10%;">No.</th>
                        <th scope="col">Nama Klub</th>
                        <th scope="col">Asal Kota Klub</th>
                        <th scope="col" style="width: 20%;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($klub as $k) : ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $k->nama_klub ?></td>
                            <td><?= $k->asal_kota_klub ?></td>
                            <td class="text-center">
                                <form action="<?= base_url('klub/edit-klub') ?>" method="post" class="d-inline-block">
                                    <input type="hidden" name="id_klub" value="<?= $k->id_klub ?>">
                                    <button class="btn btn-sm btn-primary"><i class="bi bi-pencil-square me-2"></i>Edit</button>
                                </form>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus_klub<?= $k->id_klub ?>"><i class="bi bi-trash3-fill me-2"></i>Hapus</button>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php foreach ($klub as $k) : ?>
    <!-- Modal Hapus Klub -->
    <div class="modal fade" id="hapus_klub<?= $k->id_klub ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus klub</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah kamu yakin ingin menghapus klub ini?
                </div>
                <div class="modal-footer">
                    <form action="<?= base_url('klub/hapus-klub') ?>" method="post">
                        <input type="hidden" name="id_klub" value="<?= $k->id_klub ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>