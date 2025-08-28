<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">Edit Sertifikat</h1>

        <form action="{{ route('sertifikat.update', $sertifikat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium mb-1">Jenis Sertifikat</label>
                <input type="text" name="jenis_sertifikat" value="{{ old('jenis_sertifikat', $sertifikat->jenis_sertifikat) }}" 
                       class="w-full border rounded-lg p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Judul Sertifikat</label>
                <input type="text" name="judul_sertifikat" value="{{ old('judul_sertifikat', $sertifikat->judul_sertifikat) }}" 
                       class="w-full border rounded-lg p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Tanggal Diraih</label>
                <input type="date" name="tanggal_diraih" value="{{ old('tanggal_diraih', $sertifikat->tanggal_diraih) }}" 
                       class="w-full border rounded-lg p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Foto Sertifikat (Opsional)</label>
                <input type="file" name="foto_sertifikat" class="w-full border rounded-lg p-2">
                @if($sertifikat->foto_sertifikat)
                    <img src="{{ Storage::url($sertifikat->foto_sertifikat) }}" class="h-32 mt-2">
                @endif
            </div>

            <div class="flex space-x-3">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan Perubahan</button>
                <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-300 rounded-lg">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
