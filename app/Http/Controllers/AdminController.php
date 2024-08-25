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
use App\Models\Agama;
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

    public function hapusPengguna($user_id)
    {
        try {
            // Temukan pengguna berdasarkan user_id
            $account = AccountUser::findOrFail($user_id);

            // Hapus data pengguna
            $account->delete();

            // Redirect ke halaman list akun pengguna dengan pesan sukses
            return redirect()->route('listakunpengguna')->with('success', 'Pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            // Tangkap error jika terjadi
            return back()->with('error', 'Terjadi kesalahan saat menghapus pengguna: ' . $e->getMessage());
        }
    }

    public function formvalidasi($user_id)
    {
        // Fetch the user with the given user_id
        $account = AccountUser::findOrFail($user_id);

        // Fetch related data using Eloquent models
        $provinces = DB::select('SELECT * FROM provinces');
        $cities = DB::select('SELECT * FROM cities');
        $agamas = DB::select('SELECT * FROM agama');

        return view('admin.validasipendaftar', compact('account', 'provinces', 'cities', 'agamas'));
    }

    public function terimaValidasi($user_id)
    {
        try {
            // Temukan pendaftar berdasarkan user_id
            $account = AccountUser::findOrFail($user_id);

            // Update status pendaftar dan message_status_daftar
            $account->update([
                'status_daftar' => 'tervalidasi',
                'message_status_daftar' => 'Data Kamu Telah divalidasi',
            ]);

            // Redirect ke halaman list akun pengguna dengan pesan sukses
            return redirect()->route('listakunpengguna')->with('success', 'Pendaftar berhasil divalidasi.');
        } catch (\Exception $e) {
            // Tangkap error jika terjadi
            return back()->with('error', 'Terjadi kesalahan saat memvalidasi pendaftar: ' . $e->getMessage());
        }
    }

    public function tolakValidasi($user_id)
    {
        try {
            // Temukan pendaftar berdasarkan user_id
            $accountUser = AccountUser::findOrFail($user_id);

            // Hapus file dari storage jika ada
            if ($accountUser->foto && Storage::exists('public/foto/' . $accountUser->foto)) {
                Storage::delete('public/foto/' . $accountUser->foto);
            }

            if ($accountUser->video && Storage::exists('public/video/' . $accountUser->video)) {
                Storage::delete('public/video/' . $accountUser->video);
            }

            // Update status pendaftar dan kosongkan data yang relevan
            $accountUser->update([
                'status_daftar' => 'belum melengkapi',
                'message_status_daftar' => 'Lengkapi Kembali Data Kamu Dengan Benar',
                'nama_lengkap' => null,
                'address_ktp' => null,
                'address_now' => null,
                'kecamatan' => null,
                'province_id' => null,
                'city_id' => null,
                'telp_number' => null,
                'tgl_lahir' => null,
                'kewarganegaraan' => null,
                'nama_kewarganegaraan' => null,
                'tempat_lahir' => null,
                'province_id_lahir' => null,
                'city_id_lahir' => null,
                'negara_lahir' => null,
                'jenis_kelamin' => null,
                'status_menikah' => null,
                'agama_id' => null,
                'foto' => null,
                'video' => null,
            ]);

            // Redirect ke halaman list akun pengguna dengan pesan sukses
            return redirect()->route('listakunpengguna')->with('success', 'Pendaftar berhasil ditolak dan data telah dikosongkan.');
        } catch (\Exception $e) {
            // Tangkap error jika terjadi
            return back()->with('error', 'Terjadi kesalahan saat memproses pendaftar: ' . $e->getMessage());
        }
    }



    public function updatependaftar(Request $request, $user_id)
    {
        // Validate the request data
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'address_ktp' => 'required|string',
            'address_now' => 'required|string',
            'kecamatan' => 'required|string|max:50',
            'province_id' => 'required|string|max:10',
            'city_id' => 'required|string|max:10',
            'telp_number' => 'required|string|max:20',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'tgl_lahir' => 'required|date',
            'kewarganegaraan' => 'required|string',
            'nama_kewarganegaraan' => 'nullable|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'province_id_lahir' => 'string|max:10',
            'city_id_lahir' => 'string|max:10',
            'negara_lahir' => 'nullable|string|max:255',
            'jenis_kelamin' => 'required|string',
            'status_menikah' => 'required|string',
            'agama_id' => 'required|string|max:10',
            'foto' => 'mimes:jpg,jpeg,png|max:2048',
            'video' => 'mimes:mp4,avi,mov|max:20480',
        ]);

        // Mendapatkan data pengguna berdasarkan ID, atau gagal jika tidak ditemukan
        $accountUser = AccountUser::where('user_id', $user_id)->firstOrFail();

        // Initialize data array
        $data = [
            'nama_lengkap' => $request->input('nama_lengkap'),
            'address_ktp' => $request->input('address_ktp'),
            'address_now' => $request->input('address_now'),
            'kecamatan' => $request->input('kecamatan'),
            'province_id' => $request->input('province_id'),
            'city_id' => $request->input('city_id'),
            'telp_number' => $request->input('telp_number'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'tgl_lahir' => $request->input('tgl_lahir'),
            'kewarganegaraan' => $request->input('kewarganegaraan'),
            'status_menikah' => $request->input('status_menikah'),
            'agama_id' => $request->input('agama_id'),
        ];

        // Check the value of kewarganegaraan
        $kewarganegaraan = $request->input('kewarganegaraan');

        // dd($kewarganegaraan);

        // Check the value of kewarganegaraan
        $kewarganegaraan = $request->input('kewarganegaraan');

        // Check the value of kewarganegaraan
        $kewarganegaraan = $request->input('kewarganegaraan');

        if ($kewarganegaraan === 'wna') {
            $data['nama_kewarganegaraan'] = $request->input('nama_kewarganegaraan');
            $data['negara_lahir'] = $request->input('negara_lahir');
            $data['tempat_lahir'] = null; // Use null to allow database to handle it
            $data['province_id_lahir'] = null; // Use null to allow database to handle it
            $data['city_id_lahir'] = null; // Use null to allow database to handle it
        } else {
            $data['nama_kewarganegaraan'] = null;
            $data['negara_lahir'] = null;
            $data['tempat_lahir'] = $request->input('tempat_lahir');
            $data['province_id_lahir'] = $request->input('province_id_lahir');
            $data['city_id_lahir'] = $request->input('city_id_lahir');
        }

        // Handle file uploads
        if ($request->hasFile('foto')) {
            // Get old photo file name
            $oldFoto = $accountUser->foto;

            // Remove old photo file if it exists
            if ($oldFoto && Storage::exists('public/foto/' . $oldFoto)) {
                Storage::delete('public/foto/' . $oldFoto);
            }

            // Store new photo file
            $file = $request->file('foto');
            $filename = time() . '-' . md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto', $filename);
            $data['foto'] = $filename;
        }

        if ($request->hasFile('video')) {
            // Get old video file name
            $oldVideo = $accountUser->video;

            // Remove old video file if it exists
            if ($oldVideo && Storage::exists('public/video/' . $oldVideo)) {
                Storage::delete('public/video/' . $oldVideo);
            }

            // Store new video file
            $file = $request->file('video');
            $filename = time() . '-' . md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/video', $filename);
            $data['video'] = $filename;
        }

        // Update the account user
        $accountUser->update($data);

        return redirect('/listakunpengguna')->with('success', 'Data Pendaftaran Berhasil Dirubah');
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
            return Redirect::to('/listakunpengguna')->with('success', 'Anda Berhasil Mendaftarkan Calon Pendfatar');
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
