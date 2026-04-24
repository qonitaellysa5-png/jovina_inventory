@once
<style>
 
    .modal { z-index: 2000 !important; }
    .modal-backdrop { z-index: 1990 !important; }

    #addModal .modal-dialog{ max-width:560px; }
    #addModal .modal-content{
        border-radius:6px;
        box-shadow:0 10px 30px rgba(0,0,0,.25);
        border:1px solid rgba(0,0,0,.08);
    }
    #addModal .modal-header{
        border-bottom:none;
        padding:18px 22px 6px;
    }
    #addModal .modal-title{
        font-size:26px;
        font-weight:500;
        letter-spacing:.2px;
    }
    #addModal .modal-body{ padding:10px 22px 16px; }
    #addModal label{
        font-size:12px;
        color:#222;
        margin-bottom:6px;
    }
    #addModal .req{ color:#e53935; font-weight:700; }
    #addModal .form-control{
        height:30px;
        border-radius:3px;
        font-size:13px;
    }
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

   
    .modal-custom-edit .modal-dialog{ max-width:420px; }
    .modal-custom-edit .modal-content{
        border-radius:6px;
        box-shadow:0 10px 30px rgba(0,0,0,.25);
        border:1px solid rgba(0,0,0,.08);
    }
    .modal-custom-edit .modal-header{
        border-bottom:none;
        padding:18px 22px 6px;
    }
    .modal-custom-edit .modal-title{
        font-size:26px;
        font-weight:500;
        letter-spacing:.2px;
        margin:0;
    }
    .modal-custom-edit .modal-body{ padding:10px 18px 14px; }
    .modal-custom-edit label{
        font-size:12px;
        color:#222;
        margin-bottom:6px;
        line-height:1.1;
    }
    .modal-custom-edit .form-control{
        height:30px;
        border-radius:3px;
        font-size:13px;
    }
    .modal-custom-edit .modal-footer{
        border-top:none;
        padding:10px 18px 18px;
        justify-content:center;
        gap:18px;
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

    #successModal .modal-dialog{ max-width:320px; }
    #successModal .modal-content{
        border-radius:6px;
        border:1px solid rgba(0,0,0,.08);
        box-shadow:0 10px 30px rgba(0,0,0,.25);
        padding:26px 18px 22px;
        text-align:center;
    }
    #successModal .check{
        font-size:44px;
        color:#7acb7a;
        margin-bottom:10px;
    }
    #successModal h5{
        margin:0;
        font-size:20px;
        font-weight:600;
        color:#111;
    }
    #successModal p{
        margin:8px 0 0;
        font-size:12px;
        color:#444;
    }
</style>
@endonce


@if(($mode ?? '') === 'global')

<!-- =================== MODAL TAMBAH BARANG =================== -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="formTambahBarang" method="POST" action="{{ route('barang.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-6">
                            <label>Kode Barang<span class="req">*</span></label>
                            <input type="text" name="kode" class="form-control" placeholder="Contoh: BRG001" required>

                            <div class="mt-3">
                                <label>Jenis Barang<span class="req">*</span></label>
                                <input type="text" name="jenis" class="form-control" required>
                            </div>

                            <div class="mt-3">
                                <label>Stok Unit<span class="req">*</span></label>
                                <input type="number" name="stok_unit" class="form-control" min="0" required>
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

                        <div class="col-6">
                            <label>Nama Barang<span class="req">*</span></label>
                            <input type="text" name="nama" class="form-control" placeholder="Contoh: Blonde 14" required>

                            <div class="mt-3">
                                <label>Satuan<span class="req">*</span></label>
                                <input type="text" name="satuan" class="form-control" placeholder="Pcs/Box" required>
                            </div>

                            <div class="mt-3">
                                <label>Stok Dapat Dijual<span class="req">*</span></label>
                                <input type="number" name="stok_dapat_dijual" class="form-control" min="0" required>
                            </div>
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

<!-- =================== POPUP KONFIRMASI HAPUS =================== -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:520px;">
        <div class="modal-content" style="border-radius:10px; padding:18px; text-align:center;">
            <div style="width:44px;height:44px;border-radius:50%;border:2px solid #f06b5b;color:#f06b5b;display:inline-flex;align-items:center;justify-content:center;font-weight:700;font-size:20px;margin:0 auto 10px;">
                !
            </div>
            <h5 style="margin:0;font-size:20px;font-weight:600;color:#111;">Apakah Anda yakin?</h5>
            <p id="confirmDeleteText" style="margin:8px 0 0;font-size:12px;color:#555;">
                Data yang dihapus tidak dapat dikembalikan!
            </p>

            <div class="d-flex justify-content-center gap-3 mt-3">
                <button type="button" class="btn" id="btnConfirmDelete"
                        style="background:#e57462;color:#fff;border:none;padding:8px 18px;border-radius:4px;min-width:110px;">
                    Ya, hapus!
                </button>
                <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background:#bdbdbd;color:#fff;border:none;padding:8px 18px;border-radius:4px;min-width:100px;">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- =================== POPUP BERHASIL =================== -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="check"><i class="fa fa-check"></i></div>
            <h5 id="successTitle">Berhasil!</h5>
            <p id="successMessage">Sukses</p>
        </div>
    </div>
</div>

@endif


{{-- ===================== MODE ROW (Edit + Delete hidden form) ===================== --}}
@if(($mode ?? '') === 'row')

{{-- =================== EDIT MODAL (PER ROW) =================== --}}
<div class="modal fade modal-custom-edit" id="editModal{{ $b->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="formEditBarang{{ $b->id }}" method="POST" action="{{ route('barang.update', $b->id) }}">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-6">
                            <label>Kode Barang<span class="rep">*</span></label>
                            <input type="text" name="kode" class="form-control" placeholder="Contoh: BRG001" required>

                            <div class="mt-3">
                                <label>Nama Barang<span class="req">*</span></label>
                                <input type="text" name="kode" class="form-control" placeholder="Contoh: Blonde 14" required>

                            <div class="mt-3">
                                <label>Jenis Barang<span class="req">*</span></label>
                                <input type="text" name="jenis" class="form-control" required>
                            </div>

                            <div class="mt-3">
                                <label>Stok Unit<span class="req">*</span></label>
                                <input type="number" name="stok_unit" class="form-control" min="0" required>
                            </div>

                            <div class="mt-3">
                                <label>Gudang<span class="req">*</span></label>
                                <select name="gudang_id" class="form-control" required>
                                    <option value="">-- Pilih Gudang --</option>
                                    @foreach($gudangs as $g)
                                        <option value="{{ $g->id }}">{{ $g->nama }}</option
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <label>Nama Barang</label>
                            <input type="text" name="nama" class="form-control" value="{{ $b->nama }}" required>

                            <div class="mt-3">
                                <label>Satuan</label>
                                <input type="text" name="satuan" class="form-control" value="{{ $b->satuan }}" required>
                            </div>

                            <div class="mt-3">
                                <label>Stok dapat dijual</label>
                                <input type="number" name="stok_dapat_dijual" class="form-control" min="0" value="{{ $b->stok_dapat_dijual }}" required>
                            </div>
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


<form id="formDeleteBarang{{ $b->id }}" method="POST" action="{{ route('barang.destroy', $b->id) }}" style="display:none;">
    @csrf
    @method('DELETE')
</form>

@endif