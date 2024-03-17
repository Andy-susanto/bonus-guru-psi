<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penilaian';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }

    public function subKriteria()
    {
        return $this->belongsTo(SubKriteria::class);
    }
}
