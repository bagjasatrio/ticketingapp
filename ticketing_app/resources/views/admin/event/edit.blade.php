<x-layouts.admin title="{{ isset($event) ? 'Edit Event' : 'Tambah Event' }}">
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
                <h2 class="card-title text-2xl mb-6">{{ isset($event) ? 'Edit Event' : 'Tambah Event' }}</h2>

                <form method="POST" 
                      action="{{ isset($event) ? route('admin.events.update', $event->id) : route('admin.events.store') }}" 
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($event)) @method('PUT') @endif

                    <!-- Judul Event -->
                    <div class="form-control mb-4">
                        <label class="label"><span class="label-text font-semibold">Judul Event</span></label>
                        <input type="text" name="judul" class="input input-bordered w-full" 
                               value="{{ old('judul', $event->judul ?? '') }}" required />
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-control mb-4">
                        <label class="label"><span class="label-text font-semibold">Deskripsi</span></label>
                        <textarea name="deskripsi" class="textarea textarea-bordered h-24 w-full" required>{{ old('deskripsi', $event->deskripsi ?? '') }}</textarea>
                    </div>

                    <!-- Tanggal & Waktu -->
                    <div class="form-control mb-4">
                        <label class="label"><span class="label-text font-semibold">Tanggal & Waktu</span></label>
                        <input type="datetime-local" name="tanggal_waktu" class="input input-bordered w-full" 
                               value="{{ isset($event) ? $event->tanggal_waktu->format('Y-m-d\TH:i') : old('tanggal_waktu') }}" required />
                    </div>

                    <!-- Lokasi (dropdown dari seed lokasi) -->
                    <div class="form-control mb-4">
                        <label class="label"><span class="label-text font-semibold">Lokasi</span></label>
                        <select name="lokasi_id" class="select select-bordered w-full" required>
                            <option value="" disabled {{ !isset($event) ? 'selected' : '' }}>Pilih Lokasi</option>
                            @foreach($lokasi as $loc)
                                <option value="{{ $loc->id }}" 
                                    {{ isset($event) && $event->lokasi_id == $loc->id ? 'selected' : '' }}>
                                    {{ $loc->nama_lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kategori (dropdown dari seed kategori) -->
                    <div class="form-control mb-4">
                        <label class="label"><span class="label-text font-semibold">Kategori</span></label>
                        <select name="kategori_id" class="select select-bordered w-full" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ isset($event) && $event->kategori_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Gambar Event -->
                    <div class="form-control mb-4">
                        <label class="label"><span class="label-text font-semibold">Gambar Event</span></label>
                        <input type="file" name="gambar" class="file-input file-input-bordered w-full" />
                        <span class="text-sm text-gray-500">Format: JPG, PNG, max 5MB</span>

                        @if(isset($event) && $event->gambar)
                            <div class="mt-2">
                                <label class="label"><span class="label-text font-semibold">Preview Gambar</span></label>
                                <img src="{{ asset('images/events/' . $event->gambar) }}" class="rounded-lg w-48" alt="Gambar Event">
                            </div>
                        @endif
                    </div>

                    <div class="form-control mt-6">
                        <button class="btn btn-primary">{{ isset($event) ? 'Simpan Perubahan' : 'Tambah Event' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
