<div class="container mt-4">
    <h1 class="text-center mb-4">Klasemen Klub Sepakbola</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Posisi</th>
                <th scope="col">Klub</th>
                <th class="text-center" scope="col">Main</th>
                <th class="text-center" scope="col">Menang</th>
                <th class="text-center" scope="col">Seri</th>
                <th class="text-center" scope="col">Kalah</th>
                <th class="text-center" scope="col">Gol</th>
                <th class="text-center" scope="col">Kebobolan</th>
                <th class="text-center" scope="col">Point</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($klasemen as $key => $item) { ?>
                <tr>
                    <th scope="row"><?= $key + 1 ?></th>
                    <td><?= $item->nama_klub ?></td>
                    <?php
                    $this->db->select('COUNT(*) as jumlah_pertandingan');
                    $this->db->from('t_pertandingan');
                    $this->db->where('(id_kandang = ' . $item->id_klub . ' OR id_tandang = ' . $item->id_klub . ')');
                    $main = $this->db->get()->row()->jumlah_pertandingan;;
                    ?>
                    <td class="text-center"><?= $main ?></td>
                    <td class="text-center"><?= $item->menang ?></td>
                    <td class="text-center"><?= $item->seri ?></td>
                    <td class="text-center"><?= $item->kalah ?></td>
                    <td class="text-center"><?= $item->goal ?></td>
                    <td class="text-center"><?= $item->kebobolan ?></td>
                    <td class="text-center"><?= $item->point ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>