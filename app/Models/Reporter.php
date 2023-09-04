<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporter extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function report()
    {
        return $this->hasMany(Report::class);
    }
}
