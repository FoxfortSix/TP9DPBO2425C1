# Tugas Praktikum - Desain Pemrograman Berorientasi Objek (Arsitektur MVP)

Saya **Mochamad Azka Basria** dengan NIM **2405170** mengerjakan Tugas Praktikum dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak akan melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

_Repository_ ini merupakan implementasi arsitektur **MVP (Model-View-Presenter)** menggunakan bahasa pemrograman **PHP Native**. Proyek ini bertema pengelolaan data balapan Formula 1 yang mencakup data **Pembalap** dan **Sirkuit**. Program ini mendemonstrasikan pemisahan _concern_ antara logika bisnis (Model), tampilan antarmuka (View), dan penghubung alur aplikasi (Presenter), serta koneksi ke database MySQL.

---

## Fitur Utama

### **PHP (Aplikasi Web)**

- **CRUD Data Pembalap & Sirkuit:** Memungkinkan pengguna untuk Menambah, Membaca, Mengubah, dan Menghapus data pembalap dan sirkuit.
- **Pemisahan Layer MVP:** Kode terstruktur rapi memisahkan logika database, logika tampilan, dan logika kontrol.
- **Koneksi Database MySQL:** Menggunakan PDO (_PHP Data Objects_) untuk keamanan dan fleksibilitas akses data.
- **Interface/Kontrak:** Penggunaan _Interface_ untuk menjamin konsistensi metode yang harus diimplementasikan oleh setiap komponen MVP.

---

## 🛠 Konsep OOP & MVP pada Diagram

### 1. **Model (Data & Logic)**

Bagian ini menangani logika bisnis dan interaksi langsung dengan database.

- **`DB`**: Kelas dasar (Parent Class) yang menangani koneksi ke database MySQL dan eksekusi query.
- **`Pembalap` & `Sirkuit`**: Kelas POJO (_Plain Old Java Object_) atau Entity yang merepresentasikan struktur data objek.
- **`TabelPembalap` & `TabelSirkuit`**: Mewarisi kelas `DB`. Bertugas melakukan operasi SQL (SELECT, INSERT, UPDATE, DELETE) spesifik untuk tabel masing-masing.
- **`KontrakModel`**: Interface yang memastikan setiap Model memiliki standar method CRUD.

### 2. **View (Tampilan)**

Bagian ini berfungsi untuk menampilkan data ke pengguna (HTML) tanpa memproses logika bisnis.

- **`ViewPembalap` & `ViewSirkuit`**: Kelas yang merender kode HTML. Kelas ini menggabungkan data dari Presenter dengan template HTML (`skin.html`, `form.html`).
- **`KontrakView`**: Interface yang menjamin View memiliki metode untuk menampilkan daftar data dan form input.

### 3. **Presenter (Penghubung)**

Bagian ini bertindak sebagai "otak" yang mengambil data dari Model, memprosesnya jika perlu, dan memberikannya ke View.

- **`PresenterPembalap` & `PresenterSirkuit`**: Mengimplementasikan logika alur program. Menerima input dari pengguna (via `index.php` atau `sirkuit.php`), memanggil Model untuk manipulasi data, lalu memanggil View untuk menampilkan hasilnya.
- **`KontrakPresenter`**: Interface yang mendefinisikan metode interaksi yang harus ada pada Presenter.

---

## 📂 Struktur Proyek

---

```

MVP/
├── mvp\_db.sql
├── project/
│   ├── index.php
│   ├── sirkuit.php
│   ├── models/
│   │   ├── DB.php
│   │   ├── Pembalap.php
│   │   ├── Sirkuit.php
│   │   ├── TabelPembalap.php
│   │   ├── TabelSirkuit.php
│   │   ├── KontrakModel.php
│   │   └── KontrakModelSirkuit.php
│   ├── views/
│   │   ├── ViewPembalap.php
│   │   ├── ViewSirkuit.php
│   │   ├── KontrakView.php
│   │   └── KontrakViewSirkuit.php
│   ├── presenters/
│   │   ├── PresenterPembalap.php
│   │   ├── PresenterSirkuit.php
│   │   ├── KontrakPresenter.php
│   │   └── KontrakPresenterSirkuit.php
│   └── template/
│       ├── skin.html
│       ├── skin\_sirkuit.html
│       ├── form.html
│       └── form\_sirkuit.html
└── README.md

```

---

## 📌 Desain dan Alur Kerja

### **Desain Class Utama**

- **`DB` (Base Class):**

  - **Atribut:** `$host`, `$db_name`, `$username`, `$password`, `$conn`.
  - **Method:** `__construct()`, `connect()`, `executeQuery()`, `getAllResult()`, `close()`.

- **`TabelPembalap` (Extends `DB`, Implements `KontrakModel`):**

  - **Method:** `getAllPembalap()`, `addPembalap()`, `updatePembalap()`, `deletePembalap()`.

- **`Pembalap` (Entity):**

  - **Atribut:** `id`, `nama`, `tim`, `negara`, `poinMusim`, `jumlahMenang`.
  - **Method:** _Getter_ dan _Setter_ untuk setiap atribut.

- **`PresenterPembalap` (Implements `KontrakPresenter`):**
  - **Atribut:** Objek `$tabelPembalap` (Model), Objek `$viewPembalap` (View).
  - **Method:** `tampilkanPembalap()`, `tambahPembalap()`, `ubahPembalap()`, `hapusPembalap()`.

### **Alur Kerja (Workflow)**

1.  **Request User:** Pengguna mengakses `index.php` (untuk Pembalap) atau `sirkuit.php` (untuk Sirkuit).
2.  **Inisialisasi:** File utama menginstansiasi objek `Tabel` (Model), `View`, dan `Presenter`. Presenter menerima Model dan View melalui _Dependency Injection_.
3.  **Routing Action:**
    - Jika tidak ada aksi, Presenter meminta Model mengambil semua data, lalu menyuruh View menampilkannya.
    - Jika user mengklik "Tambah" atau "Edit", Presenter menyuruh View menampilkan form.
    - Jika user mengirim data (POST), Presenter menerima data tersebut dan menyuruh Model untuk menyimpannya ke database.
4.  **Respon:** Halaman HTML hasil render View dikirimkan kembali ke browser pengguna.

---

# Dokumentasi Program

Berikut adalah dokumentasi tampilan antarmuka program.

### Tampilan Daftar Pembalap

\*jika tidak muncul didalam readme, silahkan cek di folder dokumentasi
![Daftar Pembalap](Dokumentasi/dokumentasi.mp4)
