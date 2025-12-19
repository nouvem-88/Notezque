# 📝 Notezque - Aplikasi Manajemen Catatan & Tugas

<p align="center">
  <strong>Aplikasi web modern untuk mengelola catatan, tugas, kalender aktivitas, dan materi pembelajaran</strong>
</p>

---

## 🎯 Apa itu Notezque?

**Notezque** adalah aplikasi manajemen produktivitas berbasis web yang dirancang untuk membantu mahasiswa dan profesional dalam mengorganisir kehidupan mereka. Dengan Notezque, Anda dapat:

- ✅ **Mengelola Tugas** - Buat, kelola, dan tandai tugas sebagai selesai dengan sistem prioritas (low, medium, high)
- 📔 **Membuat Catatan** - Tulis dan kategorisasi catatan untuk kuliah, pekerjaan, atau pribadi
- 📅 **Kalender Aktivitas** - Jadwalkan dan lacak aktivitas harian dengan pengingat
- 📂 **Manajemen Materi** - Upload, organisir, dan kelola file materi dalam folder terstruktur
- 🌙 **Dark Mode** - Kenyamanan mata dengan mode gelap yang dapat diaktifkan/nonaktifkan
- 🔐 **Autentikasi Aman** - Login dengan Laravel Sanctum untuk keamanan data

---

## 🚀 Fitur Utama

### 1. **Manajemen Tugas (Tasks)**
- Buat tugas dengan judul, deskripsi, dan tanggal jatuh tempo
- Atur prioritas: Low, Medium, High
- Status: Pending atau Completed
- Tandai tugas sebagai selesai dengan satu klik

### 2. **Catatan (Notes)**
- Buat catatan dengan judul dan konten
- Kategorisasi catatan (personal, kuliah, pekerjaan, dll)
- Edit dan hapus catatan kapan saja

### 3. **Kalender Aktivitas**
- Tampilan kalender bulanan dengan aktivitas
- Tambah aktivitas dengan tanggal, waktu, dan deskripsi
- Status aktivitas: Pending atau Selesai
- Pengingat aktivitas

### 4. **Manajemen Materi (Folders & Files)**
- Buat folder dan subfolder untuk organisasi materi
- Upload file (PDF, DOC, DOCX, XLS, XLSX, gambar)
- Download dan preview file
- Maksimal ukuran file: 10MB

### 5. **Fitur Tambahan**
- 🌙 **Dark Mode** - Mode gelap untuk kenyamanan mata
- 📊 **Dashboard** - Statistik dan ringkasan aktivitas
- 👤 **Profile Management** - Kelola profil pengguna
- 📱 **Responsive Design** - Bekerja di desktop dan mobile

---

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 12** - PHP Framework
- **Laravel Sanctum** - API Authentication
- **PHP 8.2+** - Programming Language
- **MySQL/SQLite** - Database

### Frontend
- **Tailwind CSS 4** - CSS Framework
- **Vite** - Build Tool
- **Blade Templates** - Templating Engine
- **Lucide Icons** - Icon Library
- **Font Awesome** - Additional Icons

### Development Tools
- **Pest** - Testing Framework
- **Laravel Pint** - Code Style Fixer
- **Laravel Sail** - Docker Development Environment

---

## 📦 Instalasi

### Persyaratan Sistem
- PHP >= 8.2
- Composer
- Node.js >= 18.x
- NPM atau Yarn
- MySQL atau SQLite

### Langkah-langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/nouvem-88/Notezque.git
   cd Notezque
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi database**
   
   Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=notezque
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan migrasi database**
   ```bash
   php artisan migrate
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Jalankan aplikasi**
   ```bash
   php artisan serve
   ```

   Akses aplikasi di: `http://127.0.0.1:8000`

### Development Mode

Untuk development dengan hot reload:

```bash
composer run dev
```

Atau jalankan secara terpisah:
```bash
# Terminal 1 - Laravel Server
php artisan serve

# Terminal 2 - Queue Worker
php artisan queue:listen

# Terminal 3 - Vite Dev Server
npm run dev
```

---

## 📖 Dokumentasi

### Dokumentasi API
Lihat [API_DOCS.md](API_DOCS.md) untuk dokumentasi lengkap REST API, termasuk:
- Authentication endpoints (Register, Login, Logout)
- Tasks API
- Notes API
- Activities/Calendar API
- Folders & Files API

### Dokumentasi Fitur
- [DARK_MODE_FEATURE.md](DARK_MODE_FEATURE.md) - Panduan fitur Dark Mode
- [OPTIMASI_KOMPONEN.md](OPTIMASI_KOMPONEN.md) - Dokumentasi komponen Blade
- [RINGKASAN_OPTIMASI_KOMPONEN.md](RINGKASAN_OPTIMASI_KOMPONEN.md) - Ringkasan optimasi komponen

---

## 🧪 Testing

Jalankan test suite:

```bash
composer test
```

Atau dengan Pest langsung:

```bash
./vendor/bin/pest
```

---

## 🎨 Struktur Proyek

```
Notezque/
├── app/
│   ├── Http/
│   │   ├── Controllers/    # Controllers untuk web & API
│   │   └── Middleware/     # Middleware
│   ├── Models/            # Model Database
│   │   ├── Activity.php   # Model Aktivitas
│   │   ├── File.php       # Model File
│   │   ├── Folder.php     # Model Folder
│   │   ├── Note.php       # Model Catatan
│   │   ├── Task.php       # Model Tugas
│   │   └── User.php       # Model User
│   └── Providers/         # Service Providers
├── config/
│   └── components.php     # Konfigurasi komponen UI
├── database/
│   ├── migrations/        # Database migrations
│   └── seeders/          # Database seeders
├── resources/
│   └── views/
│       ├── admin/         # Views admin
│       ├── auth/          # Views autentikasi
│       ├── components/    # Blade components
│       ├── landing/       # Landing page
│       ├── layouts/       # Layout templates
│       └── pages/         # Halaman aplikasi
├── routes/
│   ├── api.php           # API routes
│   └── web.php           # Web routes
└── tests/                # Test files
```

---

## 🔑 Fitur Keamanan

- ✅ **Laravel Sanctum** untuk API authentication
- ✅ **CSRF Protection** di semua form
- ✅ **Password Hashing** dengan bcrypt
- ✅ **XSS Protection** melalui Blade escaping
- ✅ **SQL Injection Protection** melalui Eloquent ORM
- ✅ **File Upload Validation** (tipe dan ukuran file)

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Jika Anda ingin berkontribusi:

1. Fork repository ini
2. Buat branch fitur (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -m 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

---

## 📝 License

Proyek ini menggunakan lisensi [MIT License](https://opensource.org/licenses/MIT).

---

## 👨‍💻 Developer

Dikembangkan dengan ❤️ menggunakan Laravel dan Tailwind CSS

---

## 📞 Support

Jika Anda memiliki pertanyaan atau menemukan bug, silakan buat [issue](https://github.com/nouvem-88/Notezque/issues) di GitHub.

---

<p align="center">
  <sub>Built with <a href="https://laravel.com">Laravel</a> • Styled with <a href="https://tailwindcss.com">Tailwind CSS</a></sub>
</p>
