<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class RegistrasiPeriksaModel extends Model
{
    protected $table = "reg_periksa";
    protected $primaryKey = "no_rawat";
    protected $keyType = "string";
    // protected $fillable = ['status_lanjut'];
    public $incrementing = false;
    public $timestamps = false;

    protected static function booted(): void
    {
        static::addGlobalScope('pasienRalanPeriksa', function (Builder $builder) {
            $builder->where('stts', '!=', 'Batal')
                ->where('status_lanjut', 'Ralan');
        });
    }

    protected function nomorRawat(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                return Str::toBase64($this->no_rawat);
                // return Str::toBase64(Crypt::encrypt($this->no_rawat));
            }
        );
    }

    protected function waktuRegistrasi(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                return date('d-m-Y H:i', strtotime($this->tgl_registrasi . ' ' . $this->jam_reg));
            }
        );
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(PasienModel::class, 'no_rkm_medis', 'no_rkm_medis');
    }

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(DokterModel::class, 'kd_dokter', 'kd_dokter');
    }

    public function penjab(): BelongsTo
    {
        return $this->belongsTo(PenjabModel::class, 'kd_pj', 'kd_pj');
    }

    public function poliklinik(): BelongsTo
    {
        return $this->belongsTo(PoliklinikModel::class, 'kd_poli', 'kd_poli');
    }
}
