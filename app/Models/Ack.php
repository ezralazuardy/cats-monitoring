<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ack extends Model
{
    use HasFactory;

    protected $table = 'acks';

    protected $fillable = ['ip'];
}
