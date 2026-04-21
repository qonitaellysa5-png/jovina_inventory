@once
<style>
/* =========================
   EDIT (ROW)
   ========================= */
.modal-custom-edit .modal-dialog{ max-width:420px; }
.modal-custom-edit .modal-content{
    border-radius:6px;
    border:1px solid rgba(0,0,0,.08);
    box-shadow:0 10px 30px rgba(0,0,0,.25);
}
.modal-custom-edit .modal-header{ border-bottom:none; padding:16px 18px 6px; }
.modal-custom-edit .modal-title{ font-size:20px; font-weight:600; margin:0; }
.modal-custom-edit .modal-body{ padding:10px 18px 14px; }
.modal-custom-edit label{ font-size:12px; color:#222; margin-bottom:6px; line-height:1.1; }
.modal-custom-edit .form-control,
.modal-custom-edit select{ height:30px; font-size:13px; border-radius:3px; }
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

/* =========================
   CONFIRM DELETE (GLOBAL)
   ========================= */
.modal-custom-confirm .modal-dialog{ max-width:400px; }
.modal-custom-confirm .modal-content{
    border-radius:10px;
    border:1px solid rgba(0,0,0,.08);
    box-shadow:0 10px 30px rgba(0,0,0,.25);
    padding:18px 18px 16px;
    text-align:center;
}
.modal-custom-confirm .warn-icon{
    width:44px; height:44px;
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
.modal-custom-confirm .warn-title{ margin:0; font-size:18px; font-weight:600; color:#111; }
.modal-custom-confirm .warn-sub{ margin:8px 0 0; font-size:12px; color:#555; }
.modal-custom-confirm .modal-footer{
    border-top:none;
    justify-content:center;
    gap:14px;
    padding:14px 0 0;
    margin:0;
}
.modal-custom-confirm .btn-del2{
    background:#e57462;
    border:none;
    color:#fff;
    padding:8px 18px;
    border-radius:4px;
    font-size:14px;
    min-width:110px;
}
.modal-custom-confirm .btn-cancel-del2{
    background:#bdbdbd;
    border:none;
    color:#fff;
    padding:8px 18px;
    border-radius:4px;
    font-size:14px;
    min-width:100px;
}

/* =========================
   ADD (GLOBAL)
   ========================= */
#addModal .modal-dialog{ max-width:560px; }
#addModal .modal-content{
    border-radius:6px;
    box-shadow:0 10px 30px rgba(0,0,0,.25);
    border:1px solid rgba(0,0,0,.08);
}
#addModal .modal-header{ border-bottom:none; padding:18px 22px 6px; }
#addModal .modal-title{ font-size:24px; font-weight:500; letter-spacing:.2px; }
#addModal .modal-body{ padding:10px 22px 16px; }
#addModal label{ font-size:12px; color:#222; margin-bottom:6px; }
#addModal .req{ color:#e53935; font-weight:700; }
#addModal .form-control,
#addModal select{ height:30px; border-radius:3px; font-size:13px; }
#addModal .modal-footer{
    border-top:none;
    padding:10px 22px 20px;
    justify-content:center;
    gap:18px;
}
#addModal .btn-save{
    background:#1fb289;
    border:none;
    padding:8px 24px;
    border-radius:4px;
    color:#fff;
    font-size:14px;
    min-width:88px;
}
#addModal .btn-cancel{
    background:#f05e5e;
    border:none;
    padding:8px 24px;
    border-radius:4px;
    color:#fff;
    font-size:14px;
    min-width:88px;
}

/* =========================
   SUCCESS (GLOBAL)
   ========================= */
#successModal .modal-dialog{ max-width:320px; } 
#successModal .modal-content{
    border-radius:10px;
    border:1px solid rgba(0,0,0,.08);
    box-shadow:0 10px 30px rgba(0,0,0,.25);
    padding:22px 18px 18px;
    text-align:center;
}
#successModal .check{ font-size:44px; color:#7acb7a; margin-bottom:10px; }
#successModal h5{ margin:0; font-size:20px; font-weight:600; color:#111; }
#successModal p{ margin:8px 0 0; font-size:12px; color:#444; }

@media (max-width:460px){
    .modal-custom-edit .modal-dialog{ max-width:92%; }
    .modal-custom-confirm .modal-dialog{ max-width:92%; }
    #addModal .modal-dialog{ max-width:92%; }
    #successModal .modal-dialog{ max-width:92%; }
}
</style>
@endonce

{{-- ========================= ROW MODE ========================= --}}
@if(($mode ?? '') === 'row')
<div class="modal fade modal-custom-edit" id="editModal{{ $s->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('stok-keluar.update', $s->id) }}">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Stok Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <label>Kode Barang<span class="req">*</span></label>
                            <input type="text" name="kode" class="form-control" value="{{ $s->barang?->kode }}" required>
                        </div>
                        <div class="col-6">
                            <label>Nama Barang<span class="req">*</span></label>
                            <input type="text" name="nama" class="form-control" value="{{ $s->barang?->nama }}" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-6">
                            <label>Jenis Barang<span class="req">*</span></label>
                            <input type="text" name="jenis" class="form-control" value="{{ $s->barang?->jenis }}" required>
                        </div>
                        <div class="col-6">
                            <label>Satuan<span class="req">*</span></label>
                            <input type="text" name="satuan" class="form-control" value="{{ $s->barang?->satuan }}" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-6">
                            <label>Jumlah<span class="req">*</span></label>
                            <input type="number" name="jumlah" class="form-control" value="{{ $s->jumlah }}" required min="1">
                        </div>
                        <div class="col-6">
                            <label>Tanggal<span class="req">*</span></label>
                            <input type="date" name="tanggal" class="form-control"
                                   value="{{ \Illuminate\Support\Carbon::parse($s->tanggal)->format('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label>Gudang<span class="req">*</span></label>
                        <select name="gudang_id" class="form-control" required>
                            <option value="">-- Pilih Gudang --</option>
                            @foreach($gudangs as $g)
                                <option value="{{ $g->id }}" {{ $s->gudang_id == $g->id ? 'selected' : '' }}>
                                    {{ $g->nama }}
                                </option>
                            @endforeach
                        </select>
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

<form id="formDeleteStokKeluar{{ $s->id }}" method="POST" action="{{ route('stok-keluar.destroy', $s->id) }}" style="display:none;">
    @csrf
    @method('DELETE')
</form>
@endif


{{-- ========================= GLOBAL MODE ========================= --}}
@if(($mode ?? '') === 'global')
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('stok-keluar.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Stok Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <label>Kode Barang<span class="req">*</span></label>
                            <input type="text" name="kode" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label>Nama Barang<span class="req">*</span></label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-6">
                            <label>Jenis Barang<span class="req">*</span></label>
                            <input type="text" name="jenis" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label>Satuan<span class="req">*</span></label>
                            <input type="text" name="satuan" class="form-control" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-6">
                            <label>Jumlah<span class="req">*</span></label>
                            <input type="number" name="jumlah" class="form-control" required min="1">
                        </div>
                        <div class="col-6">
                            <label>Tanggal<span class="req">*</span></label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label>Gudang<span class="req">*</span></label>
                        <select name="gudang_id" class="form-control" required>
                            <option value="">-- Pilih Gudang --</option>
                            @foreach($gudangs as $g)
                                <option value="{{ $g->id }}">{{ $g->nama }}</option>
                            @endforeach
                        </select>
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

<div class="modal fade modal-custom-confirm" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="warn-icon">!</div>
            <h5 class="warn-title">Apakah Anda yakin?</h5>
            <p class="warn-sub" id="confirmDeleteText">Data akan dihapus dan tidak dapat dikembalikan!</p>

            <div class="modal-footer">
                <button type="button" class="btn-del2" id="btnConfirmDelete">Ya, hapus!</button>
                <button type="button" class="btn-cancel-del2" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="check"><i class="fa fa-check"></i></div>
            <h5 id="successTitle">Berhasil!</h5>
            <p id="successMessage">Aksi berhasil.</p>
        </div>
    </div>
</div>
@endif