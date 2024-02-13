<?php if ($this->session->flashdata('pesan')) : ?>
    <div class="modal fade" id="pesan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mb-3" id="modalBody">
                    <?= $this->session->flashdata('pesan') ?>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<!-- Bootstrap Bundle dengan Popper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });

    $(document).ready(function() {
        $('#pesan').modal('show');
    });
</script>

<script>
    $(document).ready(function() {
        $('#btnTambahData').on('click', function() {
            var formInput = `
                <hr>
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
                `;
            $('#formInputContainer').append(formInput);
        });
    });
</script>
<script>
    function validateForm() {
        var id_kandang_selects = document.querySelectorAll('select[name="id_kandang[]"]');
        var id_tandang_selects = document.querySelectorAll('select[name="id_tandang[]"]');

        var hasError = false;
        var duplications = false;
        var hasInDatabase = false;
        var id_kandang_tandang = [];

        for (var i = 0; i < id_kandang_selects.length; i++) {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("pertandingan/check_duplicate"); ?>',
                data: {
                    id_kandang: id_kandang_selects[i].value,
                    id_tandang: id_tandang_selects[i].value
                },
                dataType: 'json',
                async: false, // Menjadikan AJAX menjadi synchronous agar dapat menunggu respons
                success: function(response) {
                    if (response.duplicate) {
                        hasInDatabase = true;
                        alert('Data pertandingan ini sudah ada didatabase');
                    } else {}

                }
            });

            if (id_kandang_selects[i].value === id_tandang_selects[i].value) {
                hasError = true;
                id_kandang_selects[i].classList.add('is-invalid');
                id_tandang_selects[i].classList.add('is-invalid');
                var errorMessage = id_kandang_selects[i].parentNode.querySelector('.error-messagedua');
                var errorMessage2 = id_tandang_selects[i].parentNode.querySelector('.error-messagedua');
                errorMessage.textContent = 'Tim Kandang dan Tim Tandang tidak boleh sama';
                errorMessage2.textContent = 'Tim Kandang dan Tim Tandang tidak boleh sama';
            } else {
                id_kandang_selects[i].classList.remove('is-invalid');
                id_tandang_selects[i].classList.remove('is-invalid');
                var errorMessage = id_kandang_selects[i].parentNode.querySelector('.error-message');
                errorMessage.textContent = '';
            }
            id_kandang_tandang.push(id_kandang_selects[i].value + '_' + id_tandang_selects[i].value);
        }

        var counts = {};

        for (var i = 0; i < id_kandang_tandang.length; i++) {
            var num = id_kandang_tandang[i];
            counts[num] = counts[num] ? counts[num] + 1 : 1;
            if (counts[num] > 1) {
                duplications = true;

                id_kandang_selects[i].classList.add('is-invalid');
                id_tandang_selects[i].classList.add('is-invalid');

                var errorMessage = id_kandang_selects[i].parentNode.querySelector('.error-messagetiga');
                var errorMessage2 = id_tandang_selects[i].parentNode.querySelector('.error-messagetiga');
                errorMessage.textContent += 'Pertandingan yang sama tidak boleh diulang sebanyak 2x';
                errorMessage2.textContent += 'Pertandingan yang sama tidak boleh diulang sebanyak 2x';
            }
        }

        if (duplications || hasError || hasInDatabase) {
            return false;
        }

        return true;
    }
</script>

</body>

</html>