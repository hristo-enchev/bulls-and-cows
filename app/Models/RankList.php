<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankList extends Model
{
    use HasFactory;

    public $table = 'rank_list';

    protected $fillable = [
        'nickname',
        'attempts',
        'time',
    ];
}
