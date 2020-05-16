<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="no_rak">Nama Rak</label>
            <input type="text" name="no_rak" id="no_rak" value="{{ $field->no_rak ?? ''}}"
            class="form-control {{ (form_error('no_rak')) ? 'is-invalid' : '' }}" >
            <div class="invalid-feedback">
                {!! (form_error('no_rak')) ? form_error('no_rak') : '' !!} 
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ base_url('rak') }}" class="btn btn-danger">Kembali</a>
        </div>
    </div>
</div>