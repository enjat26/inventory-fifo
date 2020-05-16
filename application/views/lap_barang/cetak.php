<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Barang</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/cetak.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/grid.css')?>">
</head>
<body>
    <div class="row">
        <div class='col-xs-8 col-sm-8'>
            <img width="200" src="<?php echo base_url('assets/img/logo.png')?>" alt="">
        </div>
        <div class="col-2">
           <h3>Laporan Data Barang</h3>
        </div>
    </div>    
    <hr>
    <div class="row">
        <div class='col-xs-12 col-sm-12 center'>
            <table>
                <tr>
                    <td class="kolom">No</td>
                    <td class="kolom">Kode Barang</td>
                    <td class="kolom">Nama Barang</td>
                    <td class="kolom">No Rak</td>
                    <td class="kolom">Satuan</td>
                    <td class="kolom">Harga</td>
                    <td class="kolom">Width</td>
                    <td class="kolom">Length</td>
                    <td class="kolom">Weigth</td>
                </tr>
                <?php
                    $no =1;
                    $tot =0;
                    foreach($rows as $r) :
                ?>
                    <tr>
                        <td class="kolom"><?= $no ?></td>
                        <td class="kolom"><?= $r->kode_barang?></td>
                        <td class="kolom"><?= $r->nama_barang?></td>
                        <td class="kolom"><?= $r->no_rak?></td>
                        <td class="kolom"><?= $r->satuan?></td>
                        <td class="kolom">Rp. <?= number_format($r->harga) ?></td>
                        <td class="kolom"><?= $r->width?></td>
                        <td class="kolom"><?= $r->length?></td>
                        <td class="kolom"><?= $r->weigth?></td>
                    </tr>
                <?php
                    $no++;
                    endforeach;
                ?>
            </table>
        </div>
    </div>
</body>
</html>