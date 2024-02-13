<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Daftar Data Skor Pertandingan</h2>
                <a href="<?= base_url('pertandingan/tambah-pertandingan') ?>" class="btn btn-primary text-end">+Tambah Skor Pertandingan</a>
            </div>

            <table id="example" class="table">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10%;">No.</th>
                        <th scope="col">Klub Kandang</th>
                        <th scope="col">Klub Tandang</th>
                        <th scope="col">Skor</th>
                        <th scope="col" style="width: 20%;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($pertandingan as $p) : ?>
                        <tr>
                            <td><?= $no ?></td>
                            <?php $klub_kandang = $this->db->get_where('t_klub', array('id_klub' => $p->id_kandang))->row(); ?>
                            <?php $klub_tandang = $this->db->get_where('t_klub', array('id_klub' => $p->id_tandang))->row(); ?>
                            <td><?= $klub_kandang->nama_klub ?></td>
                            <td><?= $klub_tandang->nama_klub ?></td>
                            <td><?= $p->skor_kandang ?> - <?= $p->skor_tandang ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus_pertandingan<?= $p->id_pertandingan ?>"><i class="bi bi-trash3-fill me-2"></i>Hapus</button>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php foreach ($pertandingan as $p) : ?>
    <!-- Modal Hapus Klub -->
    <div class="modal fade" id="hapus_pertandingan<?= $p->id_pertandingan ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus pertandingan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah kamu yakin ingin menghapus pertandingan ini?
                </div>
                <div class="modal-footer">
                    <form action="<?= base_url('pertandingan/hapus-pertandingan') ?>" method="post">
                        <input type="hidden" name="id_pertandingan" value="<?= $p->id_pertandingan ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>