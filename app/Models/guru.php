<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'guru';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function SubKriteria()
    {
        return $this->belongsToMany(Kriteria::class,'guru_has_kriteria','guru_id','kriteria_id');
    }

}
