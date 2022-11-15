<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VacationRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'start_date', 'end_date', 'message', 'status', 'vacation_days'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
