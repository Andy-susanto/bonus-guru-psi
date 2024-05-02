<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kriteria';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function tipe()
    {
        return $this->belongsTo(Tipe::class);
    }

    public function subkriteria()
    {
        return $this->hasMany(SubKriteria::class);
    }
}
