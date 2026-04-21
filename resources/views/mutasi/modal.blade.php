@once
<style>
/* ========================= MODAL EDIT ========================= */
.modal-custom-edit .modal-dialog{ max-width:420px; }

.modal-custom-edit .modal-content{
    border-radius:6px;
    border:1px solid rgba(0,0,0,.08);
    box-shadow:0 10px 30px rgba(0,0,0,.25);
}

.modal-custom-edit .modal-header{
    border-bottom:none;
    padding:16px 18px 6px;
}

.modal-custom-edit .modal-title{
    font-size:20px;
    font-weight:600;
    margin:0;
}

.modal-custom-edit .modal-body{
    padding:10px 18px 14px;
}

.modal-custom-edit label{
    font-size:12px;
    color:#222;
    margin-bottom:6px;
    line-height:1.1;
}

.modal-custom-edit .form-control,
.modal-custom-edit select{
    height:30px;
    border-radius:3px;
    font-size:13px;
}


.modal-custom-edit .row.g-3 > [class*="col-"]{
    margin-top:0;
}

.modal-custom-edit .modal-footer{
    border-top:none;
    padding:10px 18px 16px;
    display:flex;
    justify-content:center;
    gap:14px;
}

.modal-custom-edit .btn-save{
    background:#22b07d;
    border:none;
    padding:8px 22px;
    border-radius:4px;
    color:#fff;
    font-size:14px;
    min-width:110px;
}

.modal-custom-edit .btn-cancel{
    background:#f16363;
    border:none;
    padding:8px 22px;
    border-radius:4px;
    color:#fff;
    font-size:14px;
    min-width:110px;
}

/* ========================= MODAL DELETE ========================= */
.modal-custom-delete .modal-dialog{ max-width:400px; }

.modal-custom-delete .modal-content{
    border-radius:10px;
    border:1px solid rgba(0,0,0,.08);
    box-shadow:0 10px 30px rgba(0,0,0,.25);
    padding:18px 18px 16px;
    text-align:center;
}

.modal-custom-delete .warn-icon{
    width:44px;
    height:44px;
    border-radius:50%;
    border:2px solid #f06b5b;
    color:#f06b5b;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    font-size:20px;
    margin:0 auto 10px;
}

.modal-custom-delete .warn-title{
    margin:0;
    font-size:18px;
    font-weight:600;
    color:#111;
}

.modal-custom-delete .warn-sub{
    margin:8px 0 0;
    font-size:12px;
    color:#555;
}

.modal-custom-delete .modal-footer{
    border-top:none;
    display:flex;
    justify-content:center;
    gap:14px;
    padding:14px 0 0;
    margin:0;
}

.modal-custom-delete .btn-del2{
    background:#e57462;
    border:none;
    color:#fff;
    padding:8px 18px;
    border-radius:4px;
    font-size:14px;
    min-width:110px;
}

.modal-custom-delete .btn-cancel-del2{
    background:#bdbdbd;
    border:none;
    color:#fff;
    padding:8px 18px;
    border-radius:4px;
    font-size:14px;
    min-width:100px;
}

@media (max-width:460px){
    .modal-custom-edit .modal-dialog,
    .modal-custom-delete .modal-dialog{ max-width:92%; }

    .modal-custom-edit .row.g-3 > .col-6{ flex:0 0 100%; max-width:100%; }
}
</style>
@endonce

{{-- EDIT --}}
<div class="modal fade modal-custom-edit" id="editModal{{ $i }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('mutasi.update', $i) }}">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Mutasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <label>Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" value="{{ $s->kode }}" required>
                        </div>

                        <div class="col-6">
                            <label>Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" value="{{ $s->nama }}" required>
                        </div>

                        <div class="col-6">
                            <label>Jenis Barang</label>
                            <input type="text" name="jenis_barang" class="form-control" value="{{ $s->jenis_barang ?? '' }}" placeholder="Persediaan">
                        </div>

                        <div class="col-6">
                            <label>Satuan</label>
                            <input type="text" name="satuan_barang" class="form-control" value="{{ $s->satuan_barang ?? '' }}" placeholder="pcs/helai">
                        </div>

                        <div class="col-6">
                            <label>Gudang Asal</label>
                            <select name="gudang_asal_nama" class="form-control" required>
                                <option value="">-- Pilih Gudang --</option>
                                @foreach($opsiGudang as $g)
                                    <option value="{{ $g }}" {{ $s->gudang_asal === $g ? 'selected' : '' }}>
                                        {{ $g }}
                                    </option>
                                @endforeach

                                @foreach(($gudangs ?? collect()) as $g)
                                    @if(!in_array($g->nama, $opsiGudang))
                                        <option value="{{ $g->nama }}" {{ $s->gudang_asal === $g->nama ? 'selected' : '' }}>
                                            {{ $g->nama }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6">
                            <label>Gudang Tujuan</label>
                            <select name="gudang_tujuan_nama" class="form-control" required>
                                <option value="">-- Pilih Gudang --</option>
                                @foreach($opsiGudang as $g)
                                    <option value="{{ $g }}" {{ $s->gudang_tujuan === $g ? 'selected' : '' }}>
                                        {{ $g }}
                                    </option>
                                @endforeach

                                @foreach(($gudangs ?? collect()) as $g)
                                    @if(!in_array($g->nama, $opsiGudang))
                                        <option value="{{ $g->nama }}" {{ $s->gudang_tujuan === $g->nama ? 'selected' : '' }}>
                                            {{ $g->nama }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" value="{{ $s->jumlah }}" min="1" required>
                        </div>

                        <div class="col-6">
                            <label>Tanggal Transaksi</label>
                            <input type="date" name="tanggal_transaksi" class="form-control" value="{{ $s->tanggal_transaksi }}" required>
                        </div>

                        <div class="col-6">
                            <label>Status</label>
                            <input type="text" name="status" class="form-control" value="{{ $s->status }}" required>
                        </div>

                        <div class="col-6">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="{{ $s->keterangan }}">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn-save">Simpan</button>
                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- DELETE --}}
<div class="modal fade modal-custom-delete" id="deleteModal{{ $i }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('mutasi.destroy', $i) }}">
            @csrf
            @method('DELETE')

            <div class="modal-content">
                <div class="warn-icon">!</div>
                <h5 class="warn-title">Apakah Anda yakin?</h5>
                <p class="warn-sub">Data mutasi ini akan dihapus.</p>

                <div class="modal-footer">
                    <button type="submit" class="btn-del2">Ya, hapus!</button>
                    <button type="button" class="btn-cancel-del2" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>