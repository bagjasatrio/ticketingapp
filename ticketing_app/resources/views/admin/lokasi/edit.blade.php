<!-- filepath: resources/views/admin/lokasi/edit.blade.php -->
<x-layouts.admin title="Edit Lokasi">
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
                <h2 class="card-title text-2xl mb-6">Edit Lokasi</h2>

                <form method="POST" action="{{ route('admin.lokasi.update', $lokasi->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama Lokasi -->
                    <div class="form-control mb-4">
                        <label class="label"><span class="label-text font-semibold">Nama Lokasi</span></label>
                        <input type="text" name="nama_lokasi" class="input input-bordered w-full" 
                               value="{{ old('nama_lokasi', $lokasi->nama_lokasi) }}" required />
                        @error('nama_lokasi')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-control mb-4">
                        <label class="label"><span class="label-text font-semibold">Status</span></label>
                        <select name="aktif" class="select select-bordered w-full" required>
                            <option value="Y" {{ $lokasi->aktif == 'Y' ? 'selected' : '' }}>Aktif</option>
                            <option value="N" {{ $lokasi->aktif == 'N' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('aktif')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-control mt-6 flex gap-2">
                        <button type="submit" class="btn btn-primary flex-1">Simpan Perubahan</button>
                        <a href="{{ route('admin.lokasi.index') }}" class="btn btn-ghost flex-1">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
