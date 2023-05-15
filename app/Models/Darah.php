<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Response;

class Darah extends Model
{
    use HasFactory;
    protected $fillable =[
        'nama',
        'no_telp',
        'email',
        'umur',
        'berat',
        'foto',
        'darah',
    ];
    public function response()
    {
        return $this->hasOne(Response::class);
    }
}
