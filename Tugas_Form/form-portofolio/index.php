<link rel="stylesheet" href="style.css">

<form action="simpan_portofolio.php" method="POST" enctype="multipart/form-data">
    <h2>Portofolio Saya</h2>

    <label>Judul Portofolio:</label>
    <input type="text" name="judul" required>

    <label>Ringkasan Portofolio (WYSIWYG):</label>
    <textarea name="ringkasan" rows="6" cols="50"></textarea>

    <label>Keahlian:</label>
    <select name="keahlian[]" multiple required>
        <option value="Pengembangan Aplikasi Mobile">Pengembangan Aplikasi Mobile</option>
        <option value="Penulisan Konten">Penulisan Konten</option>
        <option value="Pemasaran Digital">Pemasaran Digital</option>
        <option value="Desain UI/UX">Desain UI/UX</option>
        <option value="SEO">SEO</option>
    </select>

    <label>Warna Tema Portofolio:</label>
    <input type="color" name="warna_tema" value="#6A0DAD">

    <label>Upload Gambar Proyek:</label>
    <input type="file" name="gambar[]" accept="image/*" multiple>
    <small>Max 5MB per gambar</small>

    <hr>

    <h3>Item Proyek Anda</h3>
    <div id="proyek-form">
        <input type="text" id="judulProyek" placeholder="Nama proyek">
        <input type="text" id="deskripsiProyek" placeholder="Ringkasan proyek">
        <input type="url" id="urlProyek" placeholder="https://www.example.com">
        <button type="button" onclick="tambahItem()">Tambah Item Proyek</button>
    </div>

    <table border="1" id="tabelProyek" style="margin-top: 15px; width: 100%;">
        <thead>
            <tr>
                <th>JUDUL</th>
                <th>DESKRIPSI</th>
                <th>URL</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <input type="hidden" name="data_proyek" id="dataProyek">

    <hr>

    <h3>Lokasi Utama (Peta)</h3>
    <label>Longitude:</label>
    <input type="text" name="longitude" id="longitude" value="106.8456000">
    <label>Latitude:</label>
    <input type="text" name="latitude" id="latitude" value="-6.2088000">
    <button type="button" onclick="tampilkanLokasi()">Cek & Tampilkan Lokasi</button>
    <p id="lokasiOutput"></p>

    <hr>

    <h3>Persetujuan</h3>
    <label>
        <input type="checkbox" name="terbuka" value="1">
        Saya sedang terbuka untuk menerima klien baru
    </label>

    <label>Layanan yang Ditawarkan:</label><br>
    <input type="checkbox" name="layanan[]" value="Konsultasi"> Konsultasi
    <input type="checkbox" name="layanan[]" value="Maintenance"> Maintenance
    <input type="checkbox" name="layanan[]" value="Pelatihan"> Pelatihan

    <br><br>
    <label>
        <input type="checkbox" name="setuju" required>
        Saya menyetujui <a href="#">Syarat & Ketentuan</a> serta <a href="#">Kebijakan Privasi</a>.
    </label>

    <br><br>
    <button type="submit">Simpan Portofolio</button>
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
            </tr>
        `;
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
    document.getElementById('lokasiOutput').innerText = `Lokasi yang ditampilkan: ${lat}, ${long}`;
}
</script>
