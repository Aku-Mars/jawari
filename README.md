# Proyek Tari

Dokumentasi untuk proyek Laravel Tari.

---

## Implementasi Repository Pattern

Untuk memisahkan logika bisnis dan query database dari controller, kita telah mengimplementasikan Repository Pattern.

### Apa yang Telah Dilakukan (Otomatis)

1.  **Struktur Direktori Dibuat**:
    - `app/Repositories/Interfaces`
    - `app/Repositories/Eloquent`

2.  **Repository untuk Model `Kesenian` Dibuat**:
    - **Interface**: `app/Repositories/Interfaces/KesenianRepositoryInterface.php` telah dibuat sebagai "kontrak" untuk repository.
    - **Implementasi**: `app/Repositories/Eloquent/KesenianRepository.php` telah dibuat untuk menampung semua query Eloquent terkait model `Kesenian`.

3.  **Service Provider Dibuat**:
    - `app/Providers/RepositoryServiceProvider.php` telah dibuat dan dikonfigurasi untuk me-register (binding) interface dengan implementasi konkretnya.

### Apa yang Harus Anda Lakukan Selanjutnya

1.  **Daftarkan Service Provider**:
    Agar Laravel mengenali `RepositoryServiceProvider` yang baru, buka file `config/app.php` dan tambahkan baris berikut ke dalam array `providers`:
    ```php
    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\VoltServiceProvider::class,

        // Daftarkan Repository Service Provider di sini
        App\Providers\RepositoryServiceProvider::class,
    ])->toArray(),
    ```

2.  **Refactor Controller Anda**:
    Ubah controller yang ada untuk menggunakan repository, bukan model Eloquent secara langsung. Ini dilakukan dengan *dependency injection* melalui *constructor*.

    **Contoh pada `KesenianController`**:
    ```php
    <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    // 1. Ganti pemanggilan model dengan interface repository
    use App\Repositories\Interfaces\KesenianRepositoryInterface;

    class KesenianController extends Controller
    {
        private $kesenianRepository;

        // 2. Inject interface di constructor
        public function __construct(KesenianRepositoryInterface $kesenianRepository)
        {
            $this->kesenianRepository = $kesenianRepository;
        }

        public function index()
        {
            // 3. Gunakan method dari repository
            $kesenians = $this->kesenianRepository->all();

            return view('kesenian.index', compact('kesenians'));
        }

        public function show($id)
        {
            $kesenian = $this->kesenianRepository->findById($id);
            return view('kesenian.show', compact('kesenian'));
        }

        // ... method lainnya (store, update, destroy) juga harus menggunakan repository
    }
    ```

3.  **Ulangi untuk Model Lain**:
    Terapkan pola yang sama untuk model lain seperti `Artikel`, `Galeri`, dan `User`.
    - Buat `ArtikelRepositoryInterface` dan `ArtikelRepository`.
    - Tambahkan binding-nya di `RepositoryServiceProvider`.
    - Refactor `ArtikelController` untuk menggunakan `ArtikelRepository`.
    - Dan seterusnya untuk model lainnya.

---

Test Aja