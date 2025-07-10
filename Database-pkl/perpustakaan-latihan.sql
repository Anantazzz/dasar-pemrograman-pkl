CREATE DATABASE perpustakaan_sekolah;
  SHOW DATABASES;
    USE perpustakaan_sekolah;
    CREATE TABLE IF NOT EXISTS Buku (
        id_buku INT AUTO_INCREMENT PRIMARY KEY,
        judul VARCHAR(255) NOT NULL,
        penulis VARCHAR(255) NOT NULL,
        tahun_terbit INT,
        stok INT NOT NULL DEFAULT 1,
        tanggal_ditambahkan TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
      DESC Buku;
    CREATE TABLE IF NOT EXISTS Anggota (
        id_anggota INT AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(255) NOT NULL,
        kelas VARCHAR(50) NOT NULL,
        tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
       DESC Anggota;
    CREATE TABLE IF NOT EXISTS Peminjaman (
        id_peminjaman INT AUTO_INCREMENT PRIMARY KEY,
        id_buku INT NOT NULL,
        id_anggota INT NOT NULL,
        tanggal_pinjam DATE NOT NULL,
        tanggal_kembali DATE,
        FOREIGN KEY (id_buku) REFERENCES Buku (id_buku), ON DELETE CASCADE,
        FOREIGN KEY (id_anggota) REFERENCES Anggota(id_anggota) ON DELETE CASCADE
    );
    Desc Peminjaman;
    ALTER TABLE Buku ADD COLUMN penerbit VARCHAR(255);
    ALTER TABLE Buku MODIFY COLUMN tahun_terbit SMALLINT;
    ALTER TABLE Buku DROP COLUMN penerbit;
    INSERT INTO Buku (judul, penulis, tahun_terbit, stok) VALUES
    ('Petualangan Sherina', 'Riri Riza', 2000, 7),
    ('Laskar Pelangi', 'Andrea Hirata', 2005, 4),
    ('Ayah, Mengapa Aku Berbeda?', 'Tere Liye', 2010, 9),
    ('Harry Potter dan Batu Bertuah', 'J.K. Rowling', 1997, 2);
    INSERT INTO Anggota (nama, kelas) VALUES
    ('Bima', 'XII H'),
    ('kia', 'XI B'),
    ('Bia', 'X C'),
    ('Ken', 'XII A');
    INSERT INTO Peminjaman (id_buku, id_anggota, tanggal_pinjam, tanggal_kembali) VALUES
    (1, 3, '2025-01-26', '2025-01-30'),
    (2, 1, '2025-01-24', NULL), 
    (3, 4, '2025-02-03', NULL), 
    (4, 2, '2025-02-01', NULL);
    
    SELECT * FROM Buku;
    SELECT * FROM Anggota;
    SELECT * FROM Peminjaman;

    UPDATE Buku SET stok = 7 WHERE judul = 'Laskar Pelangi';
    SELECT judul, stok FROM Buku WHERE judul = 'Laskar pelangi';
    UPDATE Peminjaman SET tanggal_kembali = '2024-01-30' WHERE id_buku = 1 AND id_anggota = 3;
    SELECT * FROM Peminjaman WHERE id_buku = 1 AND id_anggota = 3;
    DELETE FROM Buku WHERE judul = 'Ayah, Mengapa Aku Berbeda?';
    SELECT * FROM Buku;
    DELETE FROM Peminjaman WHERE tanggal_kembali IS NOT NULL AND tanggal_kembali < '2025-02-03';
    SELECT * FROM Peminjaman;
    SELECT judul, penulis FROM Buku;
    SELECT nama FROM Anggota WHERE kelas = 'X C';
    SELECT judul, penulis, stok FROM Buku WHERE penulis = 'Andrea Hirata' AND stok > 4;
    SELECT nama, kelas FROM Anggota WHERE kelas = 'XII H' OR kelas = 'XI B';
    SELECT judul FROM Buku WHERE NOT judul = 'Harry Potter dan Batu Bertuah';
    SELECT nama, kelas FROM Anggota WHERE kelas IN ('XII A', 'X C');
    SELECT judul FROM Buku WHERE judul LIKE '%Potter%';
    SELECT DISTINCT kelas FROM Anggota;
    SELECT judul, penulis FROM Buku ORDER BY judul ASC;
    SELECT judul, penulis FROM Buku LIMIT 2;
    SELECT SUM(stok) AS total_stok_buku FROM Buku;
    SELECT kelas, COUNT(id_anggota) AS jumlah_anggota FROM Anggota GROUP BY kelas;
    SELECT kelas, COUNT(id_anggota) AS jumlah_anggota FROM Anggota GROUP BY kelas HAVING COUNT(id_anggota) > 1;
    SELECT 
         A.nama AS nama_anggota,
         B.judul AS judul_buku,
         P.tanggal_pinjam,
         P.tanggal_kembali
    FROM Peminjaman AS P INNER JOIN Anggota AS A ON P.id_anggota = A.id_anggota INNER JOIN Buku AS B ON P.id_buku = B.id_buku;
    SELECT
         A.nama AS nama_anggota,
         B.judul AS judul_buku,
         P.tanggal_pinjam
    FROM Anggota AS A LEFT JOIN Peminjaman AS P ON A.id_anggota = P.id_anggota LEFT JOIN Buku AS B ON P.id_buku = B.id_buku;
    SELECT
         B.judul AS judul_buku,
         A.nama AS nama_anggota,
         P.tanggal_pinjam
        FROM Buku AS B RIGHT JOIN Peminjaman AS P ON B.id_buku = P.id_buku RIGHT JOIN Anggota AS A ON P.id_anggota = A.id_anggota;
    SELECT
         B1.judul AS judul_buku_1,
         B1.penulis,
         B2.judul AS judul_buku_2
        FROM Buku AS B1 INNER JOIN Buku AS B2 ON B1.penulis = B2.penulis WHERE B1.id_buku < B2.id_buku;