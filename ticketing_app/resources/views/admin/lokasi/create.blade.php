<!-- filepath: resources/views/admin/lokasi/create.blade.php -->
<x-layouts.admin title="{{ isset($lokasi) ? 'Edit Lokasi' : 'Tambah Lokasi' }}">
    <div class="container mx-auto p-10">

        <!-- Flash Message -->
        @if(session('success'))
            <div class="toast toast-bottom toast-center z-50">
                <div class="alert alert-success">
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            <script>
                setTimeout(() => {
                    document.querySelector('.toast')?.remove()
                }, 3000)
            </script>
        @endif

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title text-2xl mb-6">{{ isset($lokasi) ? 'Edit Lokasi' : 'Tambah Lokasi' }}</h2>

                <form method="POST" 
                      action="{{ isset($lokasi) ? route('admin.lokasi.update', $lokasi->id) : route('admin.lokasi.store') }}">
                    @csrf
                    @if(isset($lokasi)) @method('PUT') @endif

                    <!-- Nama Lokasi -->
                    <div class="form-control mb-4">
                        <label class="label"><span class="label-text font-semibold">Nama Lokasi</span></label>
                        <input type="text" name="nama_lokasi" class="input input-bordered w-full" 
                               value="{{ old('nama_lokasi', $lokasi->nama_lokasi ?? '') }}" required />
                    </div>

                    <!-- Status -->
                    <div class="form-control mb-4">
                        <label class="label"><span class="label-text font-semibold">Status</span></label>
                        <select name="aktif" class="select select-bordered w-full" required>
                            <option value="" disabled {{ !isset($lokasi) ? 'selected' : '' }}>-- Pilih Status --</option>
                            <option value="Y" {{ isset($lokasi) && $lokasi->aktif == 'Y' ? 'selected' : '' }}>Aktif</option>
                            <option value="N" {{ isset($lokasi) && $lokasi->aktif == 'N' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="form-control mt-6">
                        <button class="btn btn-primary">{{ isset($lokasi) ? 'Simpan Perubahan' : 'Tambah Lokasi' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
