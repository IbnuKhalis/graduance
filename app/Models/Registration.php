<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    public function teacher()
    {
        return $this->belongsTo(User::class);
    }
}
