<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Jalan</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/cetak.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/grid.css')?>">
    <!-- <link rel="stylesheet" href="<?php //echo base_url('assets/vendor/') ?>/bootstrap-4.4.1-dist/dist/css/bootstrap.min.css"> -->
</head>
<body>
    <div class="row">
        <div class='col-xs-8 col-sm-8'>
            <img width="200" src="<?php echo base_url('assets/img/logo.png')?>" alt="">
        </div>
        <div class="col-2">
            Kepada Yth. <br>
            Nama Toko :<b><?= $r->nama_customer?></b> <br>
            Alamat : <?= $r->alamat?> <br>
            Kontak Toko :<?= $r->tlp?> <br>
        </div>
    </div>    
    <div class="row">
        <div class='col-xs-12 col-sm-12 center'>
            <h3><u>SURAT JALAN</u></h3>
        </div>
        <div class='col-xs-12 col-sm-12'>
            No. Kwitansi : <?= $r->kwt_barang_keluar?><br>
            Tgl Transaksi : <?= $r->tgl_barang_keluar?>
        </div>
    </div>
    <div class="row">
        <div class='col-xs-12 col-sm-12 center'>
            <table>
                <tr>
                    <td class="kolom">No</td>
                    <td class="kolom">Nama Barang</td>
                    <td class="kolom">Jumlah</td>
                    <td class="kolom">Satuan</td>
                    <td class="kolom">Harga</td>
                    <td class="kolom">Total</td>
                </tr>
                <?php
                    $no =1;
                    $tot =0;
                    foreach($rows as $r) :
                        $tot += $r->jml_keluar*$r->harga_keluar;
                ?>
                    <tr>
                        <td class="kolom"><?= $no ?></td>
                        <td class="kolom"><?= $r->nama_barang?></td>
                        <td class="kolom"><?= $r->jml_keluar?></td>
                        <td class="kolom"><?= $r->satuan?></td>
                        <td class="kolom">Rp. <?= number_format($r->harga_keluar) ?></td>
                        <td class="kolom">Rp. <?= number_format($r->jml_keluar*$r->harga_keluar) ?></td>
                    </tr>
                <?php
                    $no++;
                    endforeach;
                ?>
                <tr>
                    <td class="kolom" colspan="5">Total</td>
                    <td class="kolom">Rp. <?= number_format($tot) ?></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>