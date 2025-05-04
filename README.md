# TP9DPBO2025C1

## Janji
Saya Jihan Aqilah Hartono dengan NIM 2306827 mengerjakan Tugas Praktikum 9 dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Desain Program
Program ini dibangun dengan menggunakan pola arsitektur MVP (Model-View-Presenter):

1. **Model**: Representasi data dan logika bisnis
   - DB.class.php: Kelas untuk mengelola koneksi database
   - Mahasiswa.class.php: Kelas untuk menyimpan data mahasiswa
   - TabelMahasiswa.class.php: Kelas untuk operasi CRUD pada tabel mahasiswa

2. **View**: Tampilan untuk pengguna
   - TampilMahasiswa.php: Kelas untuk menampilkan data mahasiswa
   - Template.class.php: Kelas untuk mengelola template HTML
  
3. **Presenter**: Penghubung antara Model dan View
   - ProsesMahasiswa.php: Kelas untuk memproses data mahasiswa
   - KontrakPresenter.php: Interface atau gambaran dari presenter akan seperti apa
  
4. **Templates**
   - skin.html: Template utama untuk tampilan tabel mahasiswa
   - form_add.html: Template form untuk menambah data mahasiswa
   - form_update.html: Template form untuk mengedit data mahasiswa

## Alur Program
1. Program akan menampilkan daftar mahasiswa dengan informasi lengkap.
2. Pengguna dapat menambahkan data mahasiswa baru melalui tombol "Tambah Mahasiswa".
3. Pengguna dapat mengedit data mahasiswa yang sudah ada dengan menekan tombol "Edit".
4. Pengguna dapat menghapus data mahasiswa dengan menekan tombol "Hapus".

## Dokumentasi Program
https://drive.google.com/file/d/1tv_Ssv8YBl5tT7J1uMyEStsZbGpAHpYn/view?usp=sharing
