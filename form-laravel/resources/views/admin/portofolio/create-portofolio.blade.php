@extends('layouts.app')

@section('content')
<form action="{{ route('admin.portofolio.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <h2 class="text-2xl font-bold mb-4">Portofolio Saya</h2>

    <div class="mb-4">
        <x-label for="judul" value="Judul Portofolio" />
        <x-input type="text" name="judul" id="judul" required />
    </div>

    <div class="mb-4">
        <x-label for="ringkasan" value="Ringkasan Portofolio" />
        <x-textarea name="ringkasan" id="ringkasan" rows="6" />
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
        />
    </div>

    <div class="mb-4">
        <x-label for="warna_tema" value="Warna Tema Portofolio" />
        <x-input type="color" name="warna_tema" value="#6A0DAD" />
    </div>

    <div class="mb-4">
        <x-label for="gambar" value="Upload Gambar Proyek" />
        <input type="file" name="gambar[]" accept="image/*" multiple class="mb-2">
        <small class="block text-gray-500">Max 5MB per gambar</small>
    </div>

    <hr class="my-4">

    <h3 class="text-lg font-semibold mb-2">Item Proyek Anda</h3>

    <div id="proyek-form" class="flex flex-col md:flex-row gap-2 mb-2">
        <div class="flex-1">
            <x-label for="judulProyek" value="Judul Proyek" />
            <x-input type="text" name="judulProyek" id="judulProyek" placeholder="Nama proyek" />
        </div>
        <div class="flex-1">
            <x-label for="deskripsiProyek" value="Deskripsi Proyek" />
            <x-input type="text" name="deskripsiProyek" id="deskripsiProyek" placeholder="Ringkasan proyek" />
        </div>
        <div class="flex-1">
            <x-label for="urlProyek" value="URL Proyek" />
            <x-input type="url" name="urlProyek" id="urlProyek" placeholder="https://www.example.com" />
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
        <x-input type="text" name="longitude" id="longitude" value="106.8456000" />
    </div>
    <div class="mb-2">
        <x-label for="latitude" value="Latitude" />
        <x-input type="text" name="latitude" id="latitude" value="-6.2088000" />
    </div>
    <button type="button" class="btn btn-info mb-3" onclick="tampilkanLokasi()">Cek Lokasi</button>
    <p id="lokasiOutput" class="text-sm text-gray-600 mt-2"></p>

    <hr class="my-4">

    <h3 class="text-lg font-semibold">Persetujuan</h3>
    <div class="mb-2">
        <label class="flex items-center">
            <input type="checkbox" name="terbuka" value="1" class="mr-2">
            Saya sedang terbuka untuk menerima klien baru
        </label>
    </div>

    <div class="mb-2">
        <x-label value="Layanan yang Ditawarkan" />
        <div class="flex flex-col md:flex-row gap-4">
            <label><input type="checkbox" name="layanan[]" value="Konsultasi"> Konsultasi</label>
            <label><input type="checkbox" name="layanan[]" value="Maintenance"> Maintenance</label>
            <label><input type="checkbox" name="layanan[]" value="Pelatihan"> Pelatihan</label>
        </div>
    </div>

    <label class="block mt-4">
        <input type="checkbox" name="setuju" required>
        Saya menyetujui <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a>.
    </label>

    <button type="submit" class="btn btn-primary mt-3">Simpan Portofolio</button>
</form>

<script>
    let proyekList = [];

    function tambahItem() {
        const judul = document.getElementById('judulProyek').value;
        const deskripsi = document.getElementById('deskripsiProyek').value;
        const url = document.getElementById('urlProyek').value;

        if (judul && deskripsi) {
            proyekList.push({ judul, deskripsi, url });
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
</script>
@endsection
