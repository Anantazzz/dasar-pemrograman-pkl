@extends('layouts.app')

@section('content')
<form action="{{ route('admin.portofolio.update', $portofolio->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <h2 class="text-2xl font-bold mb-4">Edit Portofolio</h2>

    <div class="mb-4">
        <x-label for="judul" value="Judul Portofolio" />
        <x-input name="judul" id="judul" :value="old('judul', $portofolio->judul_portofolio)" />
    </div>

    <div class="mb-4">
        <x-label for="ringkasan" value="Ringkasan Portofolio" />
        <x-input name="ringkasan" id="ringkasan" :value="old('ringkasan', $portofolio->ringkasan)" />
    </div>
<div class="mb-4">
    <x-label for="keahlian" value="Keahlian" />
    <x-select 
        name="keahlian[]" 
        multiple
        :options="[
            'Pengembangan Aplikasi Mobile' => 'Pengembangan Aplikasi Mobile',
            'Penulisan Konten' => 'Penulisan Konten',
            'Pemasaran Digital' => 'Pemasaran Digital',
            'Desain UI/UX' => 'Desain UI/UX',
            'SEO' => 'SEO'
        ]"
        :selected="old('keahlian', is_array($portofolio->keahlian) 
            ? $portofolio->keahlian 
            : explode(',', $portofolio->keahlian ?? '')
        )"
    />
</div>

    <div class="mb-4">
        <x-label for="warna_tema" value="Warna Tema Portofolio" />
        <x-input type="color" name="warna_tema" id="warna_tema" value="{{ old('warna_tema', $portofolio->warna_tema ?? '#6A0DAD') }}" />
    </div>

    <div class="mb-4">
        <x-label for="gambar" value="Upload Gambar Proyek" />
        <input type="file" name="gambar[]" accept="image/*" multiple class="mb-2">
        <small class="block text-gray-500">Max 5MB per gambar</small>

        @if(!empty($portofolio->gambar))
            <div class="mt-2 flex gap-2">
                @foreach($portofolio->gambar as $img)
                    <img src="{{ asset('storage/'.$img) }}" alt="Gambar" class="w-20 h-20 object-cover rounded">
                @endforeach
            </div>
        @endif
    </div>

    <hr class="my-4">

    <h3 class="text-lg font-semibold mb-2">Item Proyek Anda</h3>
    <div id="proyek-form" class="flex flex-col md:flex-row gap-2 mb-2">
        <div class="flex-1">
            <label for="judulProyek">Judul Proyek</label>
            <input type="text" id="judulProyek" placeholder="Nama proyek" class="form-control" />
        </div>
        <div class="flex-1">
            <label for="deskripsiProyek">Deskripsi Proyek</label>
            <input type="text" id="deskripsiProyek" placeholder="Ringkasan proyek" class="form-control" />
        </div>
        <div class="flex-1">
            <label for="urlProyek">URL Proyek</label>
            <input type="url" id="urlProyek" placeholder="https://www.example.com" class="form-control" />
        </div>
        <div class="flex items-end">
            <button type="button" class="btn btn-secondary" onclick="tambahItem()">Tambah Item</button>
        </div>
    </div>

    <table border="1" id="tabelProyek" class="w-full mb-4">
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

    <hr class="my-4">

    <h3 class="text-lg font-semibold">Lokasi Utama (Peta)</h3>
    <div class="mb-2">
        <x-label for="longitude" value="Longitude" />
        <x-input type="text" name="longitude" id="longitude" value="{{ old('longitude', $portofolio->lpl->longitude) }}" />
    </div>
    <div class="mb-2">
        <x-label for="latitude" value="Latitude" />
        <x-input type="text" name="latitude" id="latitude" value="{{ old('latitude', $portofolio->lpl->latitude) }}" />
    </div>
    <button type="button" class="btn btn-info mb-3" onclick="tampilkanLokasi()">Cek Lokasi</button>
    <p id="lokasiOutput" class="text-sm text-gray-600 mt-2"></p>

    <hr class="my-4">

    <h3 class="text-lg font-semibold">Persetujuan</h3>
    <div class="mb-2">
        <label class="flex items-center">
          <input type="checkbox" name="terbuka" {{ old('terbuka', (bool)($portofolio->lpl->terbuka ?? false)) ? 'checked' : '' }} required>
            Saya sedang terbuka untuk menerima klien baru
        </label>
    </div>

   @php
    $layananArray = json_decode($portofolio->lpl->layanan ?? '[]', true);
@endphp

<div class="mb-2">
    <x-label value="Layanan yang Ditawarkan" />
    <div class="flex flex-col md:flex-row gap-4">
        <label>
            <input type="checkbox" name="layanan[]" value="Konsultasi" {{ in_array('Konsultasi', old('layanan', $layananArray)) ? 'checked' : '' }}>
            Konsultasi
        </label>
        <label>
            <input type="checkbox" name="layanan[]" value="Maintenance" {{ in_array('Maintenance', old('layanan', $layananArray)) ? 'checked' : '' }}>
            Maintenance
        </label>
        <label>
            <input type="checkbox" name="layanan[]" value="Pelatihan" {{ in_array('Pelatihan', old('layanan', $layananArray)) ? 'checked' : '' }}>
            Pelatihan
        </label>
    </div>
</div>

    <label class="block mt-4">
        <input type="checkbox" name="setuju" {{ old('setuju', (bool)($portofolio->lpl->setuju ?? false)) ? 'checked' : '' }} required>
        Saya menyetujui <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a>.
    </label>

    <button type="submit" class="btn btn-primary mt-3">Update Portofolio</button>
</form>

<script>
   let proyekList = @json(
    $portofolio->item->map(function($item) {
        return [
            'judul' => $item->judul_proyek,
            'deskripsi' => $item->deskripsi_singkat,
            'url' => $item->url_proyek
        ];
    })
);

    function tambahItem() {
        const judul = document.getElementById('judulProyek').value;
        const deskripsi = document.getElementById('deskripsiSingkat').value;
        const url = document.getElementById('urlProyek').value;

        if (judul && deskripsi) {
            proyekList.push({ judul, deskripsi, url });
            updateTabel();
            document.getElementById('judulProyek').value = '';
            document.getElementById('deskripsiSingkat').value = '';
            document.getElementById('urlProyek').value = '';
        }
    }

    function updateTabel() {
        const tbody = document.querySelector('#tabelProyek tbody');
        tbody.innerHTML = '';
        proyekList.forEach((item, index) => {
            const row = `
                <tr>
                    <td>${item.judul}</td>
                    <td>${item.deskripsi}</td>
                    <td><a href="${item.url}" target="_blank">${item.url}</a></td>
                    <td><a href="#" onclick="hapusItem(${index})">Hapus</a></td>
                </tr>`;
            tbody.innerHTML += row;
        });
        document.getElementById('dataProyek').value = JSON.stringify(proyekList);
    }

    function hapusItem(index) {
        proyekList.splice(index, 1);
        updateTabel();
    }

    function tampilkanLokasi() {
        const lat = document.getElementById('latitude').value;
        const long = document.getElementById('longitude').value;
        document.getElementById('lokasiOutput').innerText = `Lokasi: ${lat}, ${long}`;
    }

    updateTabel();
</script>
@endsection
