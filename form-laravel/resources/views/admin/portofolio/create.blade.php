@extends('layouts.app')
<link href="{{ asset('css/proyek.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- FilePond core CSS -->
<link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet" />
<!-- FilePond image preview plugin CSS -->
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet" />

@section('content')
<div class="payment-container">
    <div class="form-box">
        <h2 class="form-title">Portofolio Saya</h2>

        <form action="{{ route('admin.portofolio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <x-input label="Judul Portofolio" name="judul" type="text" :value="old('judul', $portofolio->judul ?? '')" required />
            @error('judul')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror

            <x-textarea label="Ringkasan Portofolio" name="ringkasan" rows="5">{{ old('ringkasan', $portofolio->ringkasan ?? '') }}</x-textarea>
            @error('ringkasan')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror

            <div class="form-group mt-3">
                <label class="block mb-1 font-medium">Keahlian</label>
                <select name="keahlian[]" class="select2 w-full border rounded p-2" multiple>
                    @foreach(['Pengembangan Aplikasi Mobile','Penulisan Konten','Pemasaran Digital','Desain UI/UX','SEO'] as $skill)
                        <option value="{{ $skill }}" {{ in_array($skill, old('keahlian', $portofolio->keahlian ?? [])) ? 'selected' : '' }}>
                            {{ $skill }}
                        </option>
                    @endforeach
                </select>
            </div>

            <x-input label="Warna Tema" name="warna_tema" type="color" :value="old('warna_tema', $portofolio->warna_tema ?? '#6A0DAD')" />

           <div class="mt-3">
                <label for="gambar" class="font-medium">Upload Gambar</label>
                <input type="file" name="gambar[]" id="gambar" multiple>
                <small class="text-gray-500">Maksimal 5 file, masing-masing 5MB</small>
                @error('gambar')<small class="text-red-500">{{ $message }}</small>@enderror
            </div>

            <h3 class="form-subtitle mt-4">Item Proyek</h3>
            <div class="flex flex-col md:flex-row gap-2 mb-2">
                <x-input placeholder="Judul Proyek" id="judulProyek" />
                <x-input placeholder="Deskripsi Proyek" id="deskripsiProyek" />
                <x-input placeholder="URL Proyek" type="url" id="urlProyek" />
                <div class="flex items-end">
                    <button type="button" class="btn btn-secondary" onclick="tambahItem()">Tambah Item</button>
                </div>
            </div>

            <table class="table table-bordered w-full mb-4" id="tabelProyek">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>URL</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <input type="hidden" name="data_proyek" id="dataProyek">

            <h3 class="form-subtitle mt-4">Lokasi Utama (Peta)</h3>
            <x-input label="Longitude" name="longitude" :value="old('longitude', $portofolio->longitude ?? '106.8456000')" />
            <x-input label="Latitude" name="latitude" :value="old('latitude', $portofolio->latitude ?? '-6.2088000')" />
            <button type="button" class="btn btn-info mb-3" onclick="tampilkanLokasi()">Cek Lokasi</button>
            <p id="lokasiOutput" class="text-sm text-gray-600 mt-2"></p>

            <h3 class="form-subtitle mt-4">Persetujuan</h3>
            <label class="flex items-center mb-2">
                <input type="checkbox" name="terbuka" value="1" class="mr-2" {{ old('terbuka', $portofolio->terbuka ?? false) ? 'checked' : '' }}>
                Saya terbuka menerima klien baru
            </label>

            <div class="form-group">
                <label class="block mb-1 font-medium">Layanan yang Ditawarkan</label>
                <select name="layanan[]" class="select2 w-full border rounded p-2" multiple>
                    @foreach(['Konsultasi','Maintenance','Pelatihan'] as $layanan)
                        <option value="{{ $layanan }}" {{ in_array($layanan, old('layanan', $portofolio->layanan ?? [])) ? 'selected' : '' }}>
                            {{ $layanan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <label class="block mt-4">
                <input type="checkbox" name="setuju" required> Saya menyetujui <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a>.
            </label>

            <button type="submit" class="btn-submit mt-3">Simpan Portofolio</button>
        </form>
    </div>
</div>

{{-- JS --}}
{{-- JS --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- FilePond core JS -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<!-- FilePond image preview plugin JS -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
<!-- (opsional) plugin validate type -->
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script>

<script>
    $(function () {
        // Register plugin
        FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateType);

        // Buat instance
        FilePond.create(document.querySelector('#gambar'), {
            acceptedFileTypes: ['image/*'],
            allowMultiple: true,
            maxFiles: 5,
            storeAsFile: true,
            labelIdle: 'Drag & Drop gambar atau <span class="filepond--label-action">Pilih</span>'
        });
    });

    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Pilih opsi",
            allowClear: true,
            width: '100%'
        });
    });
</script>

<script>
let proyekList = [];
function tambahItem() {
    const judul = document.getElementById('judulProyek').value;
    const deskripsi = document.getElementById('deskripsiProyek').value;
    const url = document.getElementById('urlProyek').value;

    if(judul && deskripsi){
        proyekList.push({judul, deskripsi, url});
        updateTabel();
        document.getElementById('judulProyek').value = '';
        document.getElementById('deskripsiProyek').value = '';
        document.getElementById('urlProyek').value = '';
    }
}

function updateTabel() {
    const tbody = document.querySelector('#tabelProyek tbody');
    tbody.innerHTML = '';
    proyekList.forEach((item, index) => {
        tbody.innerHTML += `
        <tr>
            <td>${item.judul}</td>
            <td>${item.deskripsi}</td>
            <td><a href="${item.url}" target="_blank">${item.url}</a></td>
            <td><a href="#" onclick="hapusItem(${index})">Hapus</a></td>
        </tr>`;
    });
    document.getElementById('dataProyek').value = JSON.stringify(proyekList);
}

function hapusItem(index){
    proyekList.splice(index, 1);
    updateTabel();
}

function tampilkanLokasi(){
    const lat = document.getElementById('latitude').value;
    const long = document.getElementById('longitude').value;
    document.getElementById('lokasiOutput').innerText = `Lokasi: ${lat}, ${long}`;
}
</script>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush