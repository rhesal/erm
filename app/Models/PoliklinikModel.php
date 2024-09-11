<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PoliklinikModel extends Model
{
    protected $table = "poliklinik";

    public function registrasiPeriksa() : HasMany {
        return $this->hasMany(RegistrasiPeriksaModel::class, "kd_poli", "kd_poli");
    }
}
