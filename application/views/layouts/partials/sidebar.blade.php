<div class="main-sidebar">
    <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <img width="100" src="<?= base_url('assets/img/logo.png')?>" alt="">
        <a href="{{ base_url('home') }}">Inventory</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ base_url('home') }}">IB</a>
    </div>
    <ul class="sidebar-menu">
        <hr>
        <li class="nav-item"><a class="nav-link " href="<?= base_url('home')?>"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fa fa-table"></i><span>Master Data</span></a>
            <ul class="dropdown-menu">
                <li class=""><a class="nav-link" href="<?= base_url('satuan')?>">Data Satuan</a></li>
                <li class=""><a class="nav-link" href="<?= base_url('rak')?>">Data Rak</a></li>
                <li class=""><a class="nav-link" href="<?= base_url('barang')?>">Data Barang</a></li>
                <li class=""><a class="nav-link" href="<?= base_url('customer')?>">Data Customer</a></li>
                <li class=""><a class="nav-link" href="<?= base_url('supplier')?>">Data Supplier</a></li>
            </ul>
        </li>
         <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fa fa-laptop"></i><span>Transaksi</span></a>
            <ul class="dropdown-menu">
                <li class=""><a class="nav-link" href="<?= base_url('barang_masuk')?>">Barang Masuk</a></li>
                <li class=""><a class="nav-link" href="<?= base_url('barang_keluar')?>">Barang Keluar</a></li>
            </ul>
        </li>
         <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fa fa-folder"></i><span>Laporan</span></a>
            <ul class="dropdown-menu">
                <li class=""><a class="nav-link" href="<?= base_url('lap_barang')?>">Lap. Data Barang</a></li>
                <li class=""><a class="nav-link" href="<?= base_url('lap_barang_masuk')?>">Lap. Barang Masuk</a></li>
                <li class=""><a class="nav-link" href="<?= base_url('lap_barang_keluar')?>">Lap. Barang Keluar</a></li>
            </ul>
        </li>
    </ul>
    </aside>
</div>