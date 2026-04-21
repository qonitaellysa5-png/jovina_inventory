@once
<style>
/* ========================= MODAL EDIT RETUR ========================= */
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
    font-size:22px;
    font-weight:600;
    margin:0;
}
.modal-custom-edit .modal-body{ padding:10px 18px 14px; }
.modal-custom-edit label{
    font-size:12px;
    color:#222;
    margin-bottom:6px;
    line-height:1.1;
}
.modal-custom-edit .form-control, .modal-custom-edit select{
    height:30px;
    font-size:13px;
    border-radius:3px;
}
.modal-custom-edit .modal-footer{
    border-top:none;
    padding:10px 18px 18px;
    display:flex;
    justify-content:center;
    gap:14px;
}
.modal-custom-edit .btn-save{
    background:#1fb289;
    border:none;
    padding:8px 24px;
    border-radius:4px;
    color:#fff;
    font-size:14px;
    min-width:88px;
}
.modal-custom-edit .btn-cancel{
    background:#f05e5e;
    border:none;
    padding:8px 24px;
    border-radius:4px;
    color:#fff;
    font-size:14px;
    min-width:88px;
}

/* ========================= MODAL HAPUS ========================= */
.modal-custom-delete .modal-dialog{ max-width:380px; }
.modal-custom-delete .modal-content{
    border-radius:8px;
    padding:18px 16px 16px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,.25);
    border:1px solid rgba(0,0,0,.08);
}
.modal-custom-delete .warn-icon{
    width:44px;
    height:44px;
    border-radius:50%;
    border:2px solid #f06b5b;
    color:#f06b5b;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
    margin:0 auto 10px;
    font-weight:700;
}
.modal-custom-delete h5{
    font-size:18px;
    font-weight:600;
    margin:0;
}
.modal-custom-delete p{
    font-size:12px;
    color:#555;
    margin-top:6px;
}
.modal-custom-delete .modal-footer{
    border-top:none;
    display:flex;
    justify-content:center;
    gap:12px;
    margin-top:14px;
    padding:0;
}
.modal-custom-delete .btn-del{
    background:#e57362;
    border:none;
    color:#fff;
    padding:8px 18px;
    border-radius:4px;
    min-width:110px;
    font-size:14px;
}
.modal-custom-delete .btn-cancel-del{
    background:#bdbdbd;
    border:none;
    color:#fff;
    padding:8px 18px;
    border-radius:4px;
    min-width:110px;
    font-size:14px;
}

@media (max-width:460px){
    .modal-custom-edit .modal-dialog,
    .modal-custom-delete .modal-dialog{
        max-width:92%;
    }
}
</style>
@endonce

{{-- =================== MODAL EDIT RETUR ==================== --}}
<div class="modal fade modal-custom-edit" id="editModal{{ $i }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('retur.update', $i) }}">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Retur</h5>
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
                            <input type="text" name="jenis_barang" class="form-control" value="{{ $s->jenis }}" required>
                        </div>
                        <div class="col-6">
                            <label>Satuan</label>
                            <input type="text" name="satuan_barang" class="form-control" value="{{ $s->satuan }}" required>
                        </div>

                        <div class="col-6">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" value="{{ $s->jumlah }}" min="1" required>
                        </div>
                        <div class="col-6">
                            <label>Tanggal Retur</label>
                            <input type="date" name="tanggal_retur" class="form-control" value="{{ $s->tanggal_retur }}" required>
                        </div>

                        <div class="col-6">
                            <label>Tanggal Masuk Retur</label>
                            <input type="date" name="tanggal_masuk_retur" class="form-control" value="{{ $s->tanggal_masuk_retur }}" required>
                        </div>

                        <div class="col-6">
                            <label>Gudang</label>
                            
                            <select name="gudang_nama" class="form-control" required>
                                <option value="">-- Pilih Gudang --</option>

                                @foreach($opsiGudang as $nm)
                                    <option value="{{ $nm }}" {{ $s->gudang === $nm ? 'selected' : '' }}>{{ $nm }}</option>
                                @endforeach

                                @if(isset($gudangs))
                                    @foreach($gudangs as $g)
                                        @if(!in_array($g->nama, $opsiGudang))
                                            <option value="{{ $g->nama }}" {{ $s->gudang === $g->nama ? 'selected' : '' }}>{{ $g->nama }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
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

{{-- =================== MODAL HAPUS RETUR  =================== --}}
<div class="modal fade modal-custom-delete" id="deleteModal{{ $i }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('retur.destroy', $i) }}">
            @csrf
            @method('DELETE')

            <div class="modal-content">
                <div class="warn-icon">!</div>
                <h5>Apakah Anda yakin?</h5>
                <p>Data yang dihapus tidak dapat dikembalikan!</p>

                <div class="modal-footer">
                    <button type="submit" class="btn-del">Ya, hapus!</button>
                    <button type="button" class="btn-cancel-del" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>