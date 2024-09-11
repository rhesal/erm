<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class PenyakitModel extends Model
{
    protected $table = "penyakit";

    public function diagnosaPasien(): HasMany {
        return $this->hasMany(DiagnosaModel::class, "no_rawat", "kd_penyakit");
    }
}
