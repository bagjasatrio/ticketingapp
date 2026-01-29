<!-- filepath: resources/views/admin/lokasi/index.blade.php -->
<x-layouts.admin title="Manajemen Lokasi">
    <div class="container mx-auto p-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Manajemen Lokasi</h1>
            <a href="{{ route('admin.lokasi.create') }}" class="btn btn-primary">Tambah Lokasi</a>
        </div>

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

        <div class="overflow-x-auto rounded-box bg-white p-5 shadow-xs">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lokasi</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lokasi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_lokasi }}</td>
                            <td>
                                <span class="badge {{ $item->aktif == 'Y' ? 'badge-success' : 'badge-error' }}">
                                    {{ $item->aktif == 'Y' ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                            <td class="flex gap-2">
                                <!-- Detail -->
                                <a href="{{ route('admin.lokasi.show', $item->id) }}" class="btn btn-sm btn-info">Detail</a>
                                <!-- Edit -->
                                <a href="{{ route('admin.lokasi.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <!-- Delete -->
                                <button class="btn btn-sm btn-error" onclick="openDeleteModal(this)" data-id="{{ $item->id }}">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
            form.action = `/admin/lokasi/${id}`;
            delete_modal.showModal();
        }
    </script>
</x-layouts.admin>
