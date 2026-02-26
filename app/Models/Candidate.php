<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory; use SoftDeletes;
      // Allow mass assignment
    protected $fillable = [
        'name',
        'party',
        'image'
    ];
    // Candidate receives many votes
public function votes()
{
    return $this->hasMany(Vote::class);
}
}
