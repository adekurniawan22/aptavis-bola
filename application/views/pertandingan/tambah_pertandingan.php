 <div class="container mt-4 mb-5">
     <h2>Tambah Data Pertandingan</h2>
     <form action="<?php echo base_url('pertandingan/proses_tambah_pertandingan'); ?>" method="post" onsubmit="return validateForm()">
         <div id="formInputContainer">
             <div class="card px-3 pt-3 mb-3 bg-secondary">
                 <div class="row">
                     <div class="col-6 mb-3">
                         <select class="form-control select2" name="id_kandang[]" required>
                             <option value="">Pilih Tim Kandang</option>
                             <?php foreach ($klubs as $klub) : ?>
                                 <option value="<?php echo $klub->id_klub; ?>"><?php echo $klub->nama_klub; ?></option>
                             <?php endforeach; ?>
                         </select>
                         <span class="error-message text-danger"></span>
                         <span class="error-messagedua text-danger"></span>
                         <span class="error-messagetiga text-danger"></span>
                     </div>
                     <div class="col-6 mb-3">
                         <select class="form-control select2" name="id_tandang[]" required>
                             <option value="">Pilih Tim Tandang</option>
                             <?php foreach ($klubs as $klub) : ?>
                                 <option value="<?php echo $klub->id_klub; ?>"><?php echo $klub->nama_klub; ?></option>
                             <?php endforeach; ?>
                         </select>
                         <span class="error-message text-danger"></span>
                         <span class="error-messagedua text-danger"></span>
                         <span class="error-messagetiga text-danger"></span>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-6 mb-3">
                         <input type="number" class="form-control" name="skor_kandang[]" placeholder="Skor Tim Kandang" required>
                     </div>
                     <div class="col-6 mb-3">
                         <input type="number" class="form-control" name="skor_tandang[]" placeholder="Skor Tim Tandang" required>
                     </div>
                 </div>
             </div>
         </div>

         <a type="button" class="btn btn-dark" href="<?= base_url('pertandingan') ?>">Kembali</a>
         <button type="button" class="btn btn-primary" id="btnTambahData">Tambah Data</button>
         <button type="submit" class="btn btn-success">Simpan</button>
     </form>
 </div>