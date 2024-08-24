<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmAccountMail;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\AccountUser;
use App\Models\City;
use App\Models\RankGamifikasi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Mail\DemoMail;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AdminController
{
    public function dashboardadmin()
    {
        // Logika lain yang diperlukan sebelum mengarahkan ke view, jika ada
        return view('admin.dashboard');
    }
    public function editpengguna($user_id)
    {
        // Mengambil data pengguna berdasarkan user_id
        $account = AccountUser::find($user_id);

        // Jika pengguna tidak ditemukan, kembalikan ke halaman sebelumnya dengan pesan error
        if (!$account) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        // Mengembalikan data ke view editpengguna
        return view('admin.editpengguna', compact('account'));
    }

    public function updatepengguna(Request $request, $userId)
    {
        try {
            // Validasi data input
            $validatedData = $request->validate([
                'email' => 'required|string|email|min:10',
                'password' => 'nullable|string|min:5', // Password bisa kosong
                'phone_number' => 'required|numeric|digits_between:9,20',
                'nisn' => 'required|numeric|digits_between:5,20',
            ]);

            // Cari akun berdasarkan userId
            $account = AccountUser::findOrFail($userId);

            // Siapkan data untuk diupdate
            $updateData = [
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
                'nisn' => $validatedData['nisn'],
            ];

            // Update password hanya jika ada input password baru
            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($validatedData['password']);
            }

            // Update data ke database
            $account->update($updateData);

            // Redirect ke halaman sebelumnya dengan pesan sukses
            return redirect('/listakunpengguna')->with('success', 'Akun pengguna berhasil diperbarui');
        } catch (ValidationException $e) {
            // Tangkap error validasi
            return back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            // Tangkap error SQL (misalnya, constraint violation) dan ambil pesan error
            $errorMessage = $e->getMessage();
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $errorMessage);
        } catch (\Exception $e) {
            // Tangkap error umum
            return back()->with('error', 'Terjadi kesalahan yang tidak terduga. Silakan coba lagi.');
        }
    }



    public function listakunpengguna(Request $request)
    {
        // Ambil parameter filter, sorting, dan pencarian dari request
        $statusFilter = $request->input('status_daftar', ''); // Default empty string jika tidak ada filter
        $searchTerm = $request->input('search', ''); // Default empty string jika tidak ada pencarian
        $sortBy = $request->input('sort_by', 'email'); // Default sort by 'email'
        $sortOrder = $request->input('sort_order', 'asc'); // Default sort order 'asc'

        // Validasi sortBy agar hanya kolom yang valid
        $validSortColumns = ['email', 'nisn', 'phone_number', 'status_daftar'];
        if (!in_array($sortBy, $validSortColumns)) {
            $sortBy = 'email'; // Atur ke default jika kolom tidak valid
        }

        // Validasi sortOrder agar hanya 'asc' atau 'desc'
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'asc'; // Atur ke default jika nilai tidak valid
        }

        // Query untuk mengambil data
        $query = AccountUser::where('role', 'siswa');

        // Terapkan filter jika ada
        if ($statusFilter) {
            $query->where('status_daftar', $statusFilter);
        }

        // Terapkan pencarian jika ada
        if ($searchTerm) {
            $query->where('email', 'like', "%{$searchTerm}%");
        }

        // Terapkan sorting
        $accounts = $query->orderBy($sortBy, $sortOrder)->get();

        // Kirim data ke view
        return view('admin.listakunpengguna', [
            'accounts' => $accounts,
            'statusFilter' => $statusFilter,
            'searchTerm' => $searchTerm,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ]);
    }


    public function daftar(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|min:10|unique:users',
                'password' => 'required|string|min:8',
                'phone_number' => 'required|string|min:9',
                'city' => 'required|string|max:100',
                'address' => 'required|string|max:255',
                'id_kelas' => 'required|exists:kelas,id_kelas', // Validasi id_kelas
            ]);

            // Siapkan data untuk pengguna baru
            $userData = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'phone_number' => $validatedData['phone_number'],
                'city' => $validatedData['city'],
                'address' => $validatedData['address'],
                'id_kelas' => $validatedData['id_kelas'], // Tambahkan id_kelas
            ];

            // Buat pengguna baru
            AccountUser::create($userData);

            // Redirect ke route '/' dengan pesan sukses
            return Redirect::to('/')->with('success', 'Anda berhasil terdaftar');
        } catch (ValidationException $e) {
            // Tangkap error validasi
            return back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            // Tangkap error SQL (misalnya, constraint violation)
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        } catch (\Exception $e) {
            // Tangkap error umum
            return back()->with('error', 'Terjadi kesalahan yang tidak terduga. Silakan coba lagi.');
        }
    }

    public function regispeserta(Request $request)
    {
        try {
            // Validasi data input
            $validatedData = $request->validate([
                'email' => 'required|string|email|min:10|unique:account_users',
                'password' => 'required|string|min:5',
                'phone_number' => 'required|numeric|digits_between:9,20|unique:account_users',
                'nisn' => 'required|numeric|digits_between:5,20|unique:account_users',
            ]);

            // Siapkan data untuk disimpan
            $userData = [
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'phone_number' => $validatedData['phone_number'],
                'nisn' => $validatedData['nisn'],
                'role' => "siswa",
                'status_daftar' => "belum melengkapi",
                'message_status_daftar' => "Silahkan Lengkapi Data Anda",
            ];

            // Insert data ke database menggunakan query builder
            DB::table('account_users')->insert($userData);

            // Redirect ke route '/' dengan pesan sukses
            return Redirect::to('/')->with('success', 'Anda berhasil terdaftar sebagai pendaftar siswa');
        } catch (ValidationException $e) {
            // Tangkap error validasi
            return back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            // Tangkap error SQL (misalnya, constraint violation) dan ambil pesan error
            $errorMessage = $e->getMessage();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $errorMessage);
        } catch (\Exception $e) {
            // Tangkap error umum
            return back()->with('error', 'Terjadi kesalahan yang tidak terduga. Silakan coba lagi.');
        }
    }
}
