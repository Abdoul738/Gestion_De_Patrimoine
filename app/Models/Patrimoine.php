<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrimoine extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'id',
        'nompat',
        'descpat',
        'typepat',
        'entrealpat',
        'chefequipepat',
        'imgpath',
        'planpath',
        'payspath',
        'villepath',
        'latpat',
        'longpat',
        'datedebut',
        'datefin',
    ];
}
