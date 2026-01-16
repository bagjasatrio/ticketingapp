<x-layouts.admin title="Edit Kategori">
    <div class="container mx-auto p-10">
        <div class="max-w-2xl">
            <h1 class="text-3xl font-semibold mb-6">Edit Kategori</h1>

            <div class="card bg-base-100 shadow-lg">
                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-medium">Nama Kategori</span>
                            </label>
                            <input
                                type="text"
                                name="nama"
                                placeholder="Masukkan nama kategori"
                                class="input input-bordered w-full @error('nama') input-error @enderror"
                                value="{{ old('nama', $category->nama) }}"
                                required
                            />
                            @error('nama')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control mt-6 flex flex-row gap-2">
                            <button type="submit" class="btn btn-primary flex-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Perbarui
                            </button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost flex-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
