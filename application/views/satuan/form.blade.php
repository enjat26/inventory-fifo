<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="satuan">Nama Satuan</label>
            <input type="text" name="satuan" id="satuan" value="{{ $field->satuan ?? ''}}"
            class="form-control {{ (form_error('satuan')) ? 'is-invalid' : '' }}" >
            <div class="invalid-feedback">
                {!! (form_error('satuan')) ? form_error('satuan') : '' !!} 
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ base_url('satuan') }}" class="btn btn-danger">Kembali</a>
        </div>
    </div>
</div>