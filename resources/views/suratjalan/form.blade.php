<div class="row">
    <div class="col-md-6 mb-3">
        <label>No Surat Jalan</label>
        <input type="text" name="no_sj" class="form-control"
            value="{{ old('no_sj', $suratJalan->no_sj ?? '') }}" required>
    </div>

    <div class="col-md-6 mb-3">
        <label>No PPI</label>
        <select name="no_ppi" class="form-control">
            <option value="">-- Pilih No PPI --</option>
            @foreach($ppi as $p)
                <option value="{{ $p->no_ppi }}"
                    {{ old('no_ppi', $suratJalan->no_ppi ?? '') == $p->no_ppi ? 'selected' : '' }}>
                    {{ $p->no_ppi }} - {{ $p->pemohon }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label>No PO</label>
        <input type="text" name="no_po" class="form-control"
            value="{{ old('no_po', $suratJalan->no_po ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label>Kategori</label>
        <input type="text" name="kategori" class="form-control"
            value="{{ old('kategori', $suratJalan->kategori ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label>Merk</label>
        <input type="text" name="merk" class="form-control"
            value="{{ old('merk', $suratJalan->merk ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label>Model</label>
        <input type="text" name="model" class="form-control"
            value="{{ old('model', $suratJalan->model ?? '') }}">
    </div>

    <div class="col-md-12 mb-3">
        <label>Spesifikasi</label>
        <textarea name="spesifikasi" class="form-control" rows="2">{{ old('spesifikasi', $suratJalan->spesifikasi ?? '') }}</textarea>
    </div>

    <div class="col-md-6 mb-3">
        <label>Serial Number</label>
        <input type="text" name="serial_number" class="form-control"
            value="{{ old('serial_number', $suratJalan->serial_number ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label>QTY</label>
        <input type="number" name="qty" class="form-control"
            value="{{ old('qty', $suratJalan->qty ?? '') }}" min="1">
    </div>

    <div class="col-md-6 mb-3">
        <label>Jenis Surat Jalan</label>
        <input type="text" name="jenis_surat_jalan" class="form-control"
            value="{{ old('jenis_surat_jalan', $suratJalan->jenis_surat_jalan ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label>Tanggal Input</label>
        <input type="date" name="tanggal_input" class="form-control"
            value="{{ old('tanggal_input', $suratJalan->tanggal_input ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label>Kode Asset</label>
        <input type="text" name="kode_asset" class="form-control"
            value="{{ old('kode_asset', $suratJalan->kode_asset ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label>BAST</label>
        <input type="text" name="bast" class="form-control"
            value="{{ old('bast', $suratJalan->bast ?? '') }}">
    </div>

    <div class="col-md-12 mb-3">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan', $suratJalan->keterangan ?? '') }}</textarea>
    </div>

    <div class="col-md-12 mb-3">
        <label>File (opsional)</label>
        <input type="file" name="file" class="form-control">
        @if(!empty($suratJalan->file))
            <a href="{{ asset('storage/' . $suratJalan->file) }}" target="_blank" class="d-block mt-2">Lihat File</a>
        @endif
    </div>
</div>
