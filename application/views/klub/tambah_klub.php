<div class="container mt-5">
    <div class="row">
        <div class="col-md-5">
            <h2>Form Tambah Data Klub</h2>
            <form action="<?= base_url('klub/proses-tambah-klub') ?>" method="post">
                <div class="mb-3">
                    <label for="nama_klub" class="form-label">Nama Klub</label>
                    <input type="text" class="form-control" id="nama_klub" name="nama_klub" value="<?= set_value('nama_klub') ?>">
                    <?= form_error('nama_klub', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                </div>
                <div class="mb-4">
                    <label for="asal_kota_klub" class="form-label">Kota Klub</label>
                    <input type="text" class="form-control" id="asal_kota_klub" name="asal_kota_klub" alue="<?= set_value('asal_kota_klub') ?>">
                    <?= form_error('asal_kota_klub', '<p style="font-size: 12px;color: red;" class="my-2">', '</p>'); ?>
                </div>
                <a type="button" class="btn btn-dark" href="<?= base_url('klub') ?>">Kembali</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>