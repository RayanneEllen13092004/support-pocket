<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'municipality_id',
        'name',
        'path',
    ];
}
