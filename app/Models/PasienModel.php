<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PasienModel extends Model
{
    protected $table = "pasien";

    public function registrasiPeriksa(): HasMany {
        return $this->hasMany(RegistrasiPeriksaModel::class, "no_rkm_medis", "no_rkm_medis");
    }
}
