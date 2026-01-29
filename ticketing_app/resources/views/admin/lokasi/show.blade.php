<!-- filepath: resources/views/admin/lokasi/show.blade.php -->
<x-layouts.admin title="Detail Lokasi">

    <div class="container mx-auto p-10">

        <!-- Flash Message -->
        @if (session('success'))
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

        <!-- Detail Lokasi Card -->
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title text-2xl mb-6">Detail Lokasi</h2>

                <form class="space-y-4" method="post" action="#" enctype="multipart/form-data">
                    @csrf
                    <!-- Nama Lokasi -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Nama Lokasi</span>
                        </label>
                        <input type="text" name="nama_lokasi" placeholder="Nama Lokasi"
                            class="input input-bordered w-full" value="{{ $lokasi->nama_lokasi }}" disabled />
                    </div>

                    <!-- Status -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Status</span>
                        </label>
                        <input type="text" name="status" class="input input-bordered w-full"
                            value="{{ $lokasi->aktif == 'Y' ? 'Aktif' : 'Tidak Aktif' }}" disabled />
                    </div>

                    <!-- Dibuat -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Dibuat Pada</span>
                        </label>
                        <input type="text" name="created_at" class="input input-bordered w-full"
                            value="{{ $lokasi->created_at->format('d-m-Y H:i') }}" disabled />
                    </div>

                </form>

                <div class="mt-6 flex gap-2">
                    <a href="{{ route('admin.lokasi.edit', $lokasi->id) }}" class="btn btn-warning">Edit</a>
                    <button class="btn btn-error" onclick="openDeleteModal(this)" data-id="{{ $lokasi->id }}">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <dialog id="delete_modal" class="modal">
        <form method="POST" class="modal-box">
            @csrf
            @method('DELETE')

            <input type="hidden" name="lokasi_id" id="delete_lokasi_id">

            <h3 class="text-lg font-bold mb-4">Hapus Lokasi</h3>
            <p>Apakah Anda yakin ingin menghapus lokasi ini?</p>
            <div class="modal-action">
                <button class="btn btn-primary" type="submit">Hapus</button>
                <button class="btn" onclick="delete_modal.close()" type="reset">Batal</button>
            </div>
        </form>
    </dialog>

    <script>
        function openDeleteModal(button) {
            const id = button.dataset.id;
            const form = document.querySelector('#delete_modal form');
            document.getElementById("delete_lokasi_id").value = id;

            // Set action dengan parameter ID
            form.action = `/admin/lokasi/${id}`;
            delete_modal.showModal();
        }
    </script>

</x-layouts.admin>
