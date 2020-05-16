<div class="row">
    <div class="col-md-6">
        @if (validation_errors() != false)
            <div class="alert alert-danger" role="alert">
                {!! validation_errors() !!}
            </div>
        @endif
        <div class="form-group">
            <label for="nama_customer">Nama Customer</label>
                <input type="text" name="nama_customer" id="nama_customer" value="{{ $field->nama_customer ?? ''}}"
                class="form-control {{ (form_error('nama_customer')) ? 'is-invalid' : '' }}" >
            <div class="invalid-feedback">
                {!! (form_error('nama_customer')) ? form_error('nama_customer') : '' !!} 
            </div>
            <label for="tlp">Nomor HP</label>
                <input type="text" name="tlp" id="tlp" value="{{ $field->tlp ?? ''}}"
                class="form-control {{ (form_error('tlp')) ? 'is-invalid' : '' }}" >
            <div class="invalid-feedback">
                {!! (form_error('tlp')) ? form_error('tlp') : '' !!} 
            </div>
            <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" value="{{ $field->alamat ?? ''}}"
                class="form-control {{ (form_error('alamat')) ? 'is-invalid' : '' }}" >
            <div class="invalid-feedback">
                {!! (form_error('alamat')) ? form_error('alamat') : '' !!} 
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ base_url('customer') }}" class="btn btn-danger">Kembali</a>
        </div>
    </div>
</div>