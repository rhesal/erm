<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class ProsedurModel extends Model
{
    protected $table = "icd9";

    public function prosedurPasien(): HasMany {
        return $this->hasMany(ProsedurPasienModel::class, "no_rawat", "kode");
    }
}
