<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podes18Map extends Model
{
    protected $table = 'podes18_maps';
    use HasFactory;
    protected $fillable = [
        'kode_wilayah',
        'nama_desa',
        'nama_kec',
        'nama_kab',
        'nama_provinsi',
        'jenis_permukaan_jalan',
        'topografi',
        'sumber_penghasilan_utama',
        'ketersediaan_listrik',
        'sd_mi',
        'smp_mts',
        'smu_ma_smk',
        'akademi_perguruantinggi',
        'sektor_pendidikan',
        'rumah_sakit',
        'puskesmas',
        'poliklinik',
        'sektor_kesehatan',
        'sentra_industri',
        'koperasi',
        'pertokoan_lebihdari10',
        'pasar',
        'minimarket',
        'restoran_siapsaji',
        'hotel',
        'hostel_motel_losmen_wisma',
        'sektor_perekonomian',
        'jumlah_bank_pemerintah',
        'jumlah_bank_umum_swasta',
        'jumlah_bank_perkreditan_rakyat',
        'perbankan',
        'jumlah_poi',
        'sarana_prasarana_rekreasi_wisata',
        'bumdes',
        'konsumsi_telekomunikasi_perkotaan_prov',
        'konsumsi_telekomunikasi_perdesaan_prov',
        'total_pengeluaran_rt_prov',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [

    ];
}
