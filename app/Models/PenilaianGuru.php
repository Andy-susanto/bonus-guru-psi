<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianGuru extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alternatif';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function guru()
    {
        return $this->belongsTo(guru::class);
    }

    public function penilaian()
    {
        return $this->hasOne(Penilaian::class,'alternatif_id','id');
    }

}
