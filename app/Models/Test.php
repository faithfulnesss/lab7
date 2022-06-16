<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $table = 'tests_done';

    protected $primaryKey = 'id';

    public $timestamps = true;

//    protected $dateFormat = "H:i";

    protected $fillable = [
        'user_id',
        'user_name',
        'wpm',
        'missed',
        'mistakes',
    ];
}
