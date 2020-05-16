<input type="hidden" id="lokasi_url" value="{{ ($mode == 'create') ? 'barang_keluar/create' : 'barang_keluar/edit' }}">
<input type="hidden" id="mode" value="{{ ($mode == 'create') ? 'create' : 'edit' }}">
@php
    $url_delete_detail = ($mode == 'create') ? 'mode='.$mode : 'mode='.$mode.'&id_barang_keluar='.$_GET['id'];
    $url_simpan_detail = ($mode == 'create') ? 'create' : 'edit?id='.$_GET['id'];
@endphp
<div class="row">
    <div class="col-md-12">
        @if (isset($_SESSION['success']) == 'success')
            <div class="alert alert-success" role="alert">Data berhasil di{{ $_SESSION['success'] }}</div>
            <hr>
        @elseif (isset($_SESSION['error']) == 'error')
            <div class="alert alert-danger" role="alert">Data gagal di{{ $_SESSION['error'] }}</div>
            <hr>
        @endif
    </div>
    <div class="col-md-2">
        
        <div class="form-group">
            <label for="kode_barang">Kode Barang</label>
            <select name="kode_barang" id="kode_barang" class="form-control">
                <option value="">Pilih Barang</option>
                @foreach ($barang as $item)
                    <option harga="{{ $item->harga }}" satuan="{{ $item->satuan}}" 
                        stok="{{ $item->stok}}" nama="{{ $item->nama_barang}}" 
                        value="{{ $item->id_barang}}">{{ $item->kode_barang }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" readonly>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="satuan">Satuan</label>
            <input type="text" name="satuan" id="satuan" class="form-control" readonly>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="text" name="stok" id="stok" class="form-control" readonly>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="jml">Jumlah</label>
            <input type="text" name="jml" id="jml" class="form-control">
        </div>
    </div>
    <div class="col-md-2 d-none">
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" name="harga" id="harga" class="form-control">
        </div>
    </div>
    <div class="col-md-9">
        <div class="form-group">
            <label for="stok"><br></label><br>
            <button id="btnTambahBarang" class="btn btn-primary">Tambah Barang</button>
        </div>
    </div>
</div>
{{-- ################### end baris pertama --}}
<hr>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="tgl_barang_keluar">Tanggal Transaksi</label>
            <input type="hidden" id="id_barang_keluar" value="{{ $r->id_barang_keluar ?? '' }}">
            <input type="text" id="tgl_barang_keluar" value="{{ date('m/d/Y', strtotime($r->tgl_barang_keluar ?? date('m/d/Y'))) ?? '' }}" class="datepicker form-control">
        </div>
        <div class="form-group">
            <label for="id_customer">Customer</label>
            <select name="id_customer" id="id_customer" class="form-control">
                <option value="">Pilih Customer</option>
                @foreach ($customer as $itm)
                @php
                    $id_cust = ($r->id_customer ?? '');
                @endphp
                <option {{ ($itm->id_customer == $id_cust) ? 'selected' : '' }} value="{{ $itm->id_customer }}">{{ $itm->nama_customer }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button id="btnSimpanTransaksi" class="btn btn-success">Simpan Transaksi</button>
            <a href="{{ base_url('barang_keluar') }}" class="btn btn-danger">Kembali</a>
        </div>
    </div>
    <div class="col-md-9">
        <table class="table table-striped dataTable dtr-column collapsed">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no =1;
                    $total =0;
                @endphp
                @foreach ($tmp_barang as $item)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $item->kode_barang }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->jml_tmp }}</td>
                            <td>{{ $item->satuan }}</td>
                            <td>{{ number_format($item->harga_tmp) }}</td>
                            <td>{{ number_format($item->harga_tmp*$item->jml_tmp) }}</td>
                            <td>
                                <a href="{{ base_url('barang_keluar/delete_tmp?id=').$item->id_tmp.'&'.$url_delete_detail }}" class="btn-delete btn btn-small btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    @php
                        $no ++;
                        $total += $item->harga_tmp*$item->jml_tmp;
                    @endphp
                @endforeach
                        <tr>
                            <td colspan="6">Total</td>
                            <td>{{ number_format($total) }}</td>
                            <td></td>
                        </tr>
            </tbody>
        </table>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {

            $("#kode_barang").change(function() {
                var nama_barang = $(this).children("option:selected").attr('nama');
                var stok = $(this).children("option:selected").attr('stok');
                var satuan = $(this).children("option:selected").attr('satuan');
                var harga = $(this).children("option:selected").attr('harga');
                $('#nama_barang').val(nama_barang);
                
                $('#satuan').val(satuan);
                $('#harga').val(harga);
                var data = {
                    id :  $(this).children("option:selected").val()
                }
                $.ajax({
                    type: "POST",
                    url: "{{ base_url('barang_keluar/stok') }}",
                    data: data,
                    success: function (msg) { 
                        if(msg != ''){
                            $('#stok').val(msg);
                        }else{
                            $('#stok').val(0);
                        }
                    }
                });
            });

            $("#btnTambahBarang").click(function() {
                var mode = $('#mode').val();

                var id_barang_keluar = $('#id_barang_keluar').val();
                var stok = $('#stok').val();

                var nama_barang = $('#nama_barang').val();
                var jml = $('#jml').val();
                var harga = $('#harga').val();
                var id_barang = $('#kode_barang').val();
                if(nama_barang == '' || jml == ''){
                    alert('data tidak boleh kosong!')
                }else{
                    if(parseInt(jml) > parseInt(stok)){
                        alert('Stok tidak mencukupi');
                        return false;
                    }
                    var data = {
                        id_barang_keluar : id_barang_keluar,
                        
                        id_barang : id_barang,
                        jml : jml,
                        harga : harga,
                        mode:mode
                    }
                    $.ajax({
                        type: "POST",
                        url: "{{ base_url('barang_keluar/simpan_tmp') }}",
                        data: data,
                        success: function (msg) { 
                            if(msg == 'sukses'){
                                alert('berhasil ditambahkan');
                                window.location.href="{{ base_url().'barang_keluar/'.$url_simpan_detail }}";
                            }else{
                                alert('gagal di tambahkan');
                            }
                        }
                    });
                }
            });

            $("#btnSimpanTransaksi").click(function() {
                var mode = $('#mode').val();

                var id_barang_keluar = $('#id_barang_keluar').val();
                var tgl_barang_keluar = $('#tgl_barang_keluar').val();
                var id_customer = $('#id_customer').val();
                if(tgl_barang_keluar == '' || id_customer == ''){
                    alert('data tidak boleh kosong!')
                }else{
                    var data = {
                        id_barang_keluar : id_barang_keluar,
                        tgl_barang_keluar : tgl_barang_keluar,
                        id_customer : id_customer,
                        mode:mode
                    }
                    $.ajax({
                        type: "POST",
                        url: "{{ base_url('barang_keluar/simpan') }}",
                        data: data,
                        success: function (msg) { 
                            if(msg == 'sukses'){
                                alert('berhasil disimpan');
                                window.location.href="{{ base_url('barang_keluar') }}";
                            }else{
                                alert('gagal di disimpan');
                            }
                        }
                    });
                }
            });
        });
    </script>
@endpush
