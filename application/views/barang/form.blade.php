<div class="row">
    <div class="col-md-6">
        @if (validation_errors() != false)
            <div class="alert alert-danger" role="alert">
                {!! validation_errors() !!}
            </div>
        @endif
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" value="{{ $field->nama_barang ?? ''}}"
                class="form-control {{ (form_error('nama_barang')) ? 'is-invalid' : '' }}" >
            <div class="invalid-feedback">
                {!! (form_error('nama_barang')) ? form_error('nama_barang') : '' !!} 
            </div>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
                <input type="text" name="harga" id="harga" value="{{ $field->harga ?? ''}}"
                class="form-control {{ (form_error('harga')) ? 'is-invalid' : '' }}" >
            <div class="invalid-feedback">
                {!! (form_error('harga')) ? form_error('harga') : '' !!} 
            </div>
        </div>
        <div class="form-group">
            <label for="width">Width</label>
                <input type="text" name="width" id="width" value="{{ $field->width ?? ''}}"
                class="form-control {{ (form_error('width')) ? 'is-invalid' : '' }}" >
            <div class="invalid-feedback">
                {!! (form_error('width')) ? form_error('width') : '' !!} 
            </div>
        </div>
        <div class="form-group">
            <label for="length">Length</label>
                <input type="text" name="length" id="length" value="{{ $field->length ?? ''}}"
                class="form-control {{ (form_error('length')) ? 'is-invalid' : '' }}" >
            <div class="invalid-feedback">
                {!! (form_error('length')) ? form_error('length') : '' !!} 
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
            <label for="weigth">Weigth</label>
            <input type="text" name="weigth" id="weigth" value="{{ $field->weigth ?? ''}}"
                class="form-control {{ (form_error('weigth')) ? 'is-invalid' : '' }}" >
            <div class="invalid-feedback">
                {!! (form_error('weigth')) ? form_error('weigth') : '' !!} 
            </div>
        </div>
        <div class="form-group">
            <label for="no_rak">Rak</label>
            <select name="no_rak" id="no_rak" 
                class="form-control {{ (form_error('no_rak')) ? 'is-invalid' : '' }}">
                <option value="">Pilih Rak</option>
                @foreach ($rak as $item)
                    <option 
                        {{ !isset($field->no_rak) ? '' : (($item->no_rak == $field->no_rak) ? 'selected' : '') }} 
                        value="{{$item->no_rak}}">{{ $item->no_rak }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                {!! (form_error('no_rak')) ? form_error('no_rak') : '' !!} 
            </div>
        </div>
        <div class="form-group">
            <label for="satuan">Satuan</label>
            <select name="satuan" id="satuan" 
                class="form-control {{ (form_error('satuan')) ? 'is-invalid' : '' }}">
                <option value="">Pilih Satuan</option>
                @foreach ($satuan as $item)
                    <option 
                        {{ !isset($field->satuan) ? '' : (($item->satuan == $field->satuan) ? 'selected' : '') }} 
                        value="{{$item->satuan}}">{{ $item->satuan }}
                    </option>
                @endforeach
            </select> 
            <div class="invalid-feedback">
                {!! (form_error('satuan')) ? form_error('satuan') : '' !!} 
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ base_url('barang') }}" class="btn btn-danger">Kembali</a>
        </div>
    </div>
</div>