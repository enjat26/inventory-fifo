<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Barang Keluar</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/cetak.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/grid.css')?>">
</head>
<body>
    <div class="row">
        <div class='col-xs-8 col-sm-8'>
            <img width="200" src="<?php echo base_url('assets/img/logo.png')?>" alt="">
        </div>
        <div class="col-2">
           <h3>Laporan Data Barang Keluar</h3>
           periode : <?= $_GET['tgl_awal']?> s/d <?= $_GET['tgl_akhir']?>
        </div>
    </div>    
    <hr>
    <div class="row">
        <div class='col-xs-12 col-sm-12 center'>
            <table>
                <tr>
                    <td class="kolom">No</td>
                    <td class="kolom">Tgl Kwitansi</td>
                    <td class="kolom">No Kwitansi</td>
                    <td class="kolom">Customer</td>
                    <td class="kolom">Nama Barang</td>
                    <td class="kolom">Jumlah</td>
                    <td class="kolom">Harga</td>
                    <td class="kolom">Total</td>
                </tr>
                <?php
                    $no =1;
                    $tot =0;
                    foreach($rows as $r) :
                ?>
                    <tr>
                        <td class="kolom"><?= $no ?></td>
                        <td class="kolom"><?= $r->tgl_barang_keluar?></td>
                        <td class="kolom"><?= $r->kwt_barang_keluar?></td>
                        <td class="kolom"><?= $r->nama_customer?></td>
                        <td class="kolom"><?= $r->nama_barang?></td>
                        <td class="kolom"><?= $r->jml_keluar?></td>
                        <td class="kolom">Rp. <?= number_format($r->harga) ?></td>
                        <td class="kolom">Rp. <?= number_format($r->jml_keluar*$r->harga) ?></td>
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