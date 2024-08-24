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

class AccountUserController
{

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

    public function login(Request $request)
    {
        $request->validate(['email' => 'required|string', 'password' => 'required|string']);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->role == "siswa") {
                return redirect('/dashboardpeserta')->with('success', 'Berhasil Login');
            }
            if ($user->role == "admin") {
                return redirect('/halamanregis')->with('success', 'Berhasil Login');
            }
        }
        Auth::logout();
        return redirect()->back()->withErrors(['email' => 'Gagal login, Email atau password Anda salah.']);
    }

    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the user's session
        $request->session()->invalidate();

        // Regenerate the session token to prevent session fixation attacks
        $request->session()->regenerateToken();

        // Redirect the user to the login page (or any other page)
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }

    public function dashboardpeserta(Request $request)
    {
        $user = Auth::user();
        return view('peserta.dashboard', compact('user'));
    }
}
