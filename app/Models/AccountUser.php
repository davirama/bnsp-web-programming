<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class AccountUser extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    protected $table = 'account_users';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'nisn',
        'province_id',
        'city_id',
        'province_id_lahir',
        'city_id_lahir',
        'kecamatan',
        'agama_id',
        'nama_lengkap',
        'role',
        'email',
        'password',
        'phone_number',
        'telp_number',
        'address_ktp',
        'address_now',
        'kewarganegaraan',
        'nama_kewarganegaraan',
        'tgl_lahir',
        'tempat_lahir',
        'negara_lahir',
        'jenis_kelamin',
        'status_menikah',
        'status_daftar',
        'message_status_daftar',
        'foto',
        'video',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }

    public function provinceLahir()
    {
        return $this->belongsTo(Province::class, 'province_id_lahir', 'province_id');
    }

    public function cityLahir()
    {
        return $this->belongsTo(City::class, 'city_id_lahir', 'city_id');
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama_id', 'agama_id');
    }
}
