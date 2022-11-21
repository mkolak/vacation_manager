<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VacationRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'start_date', 'end_date', 'message', 'status', 'vacation_days', 'team_leader_response', 'team_leader_message', 'project_leader_response', 'project_leader_message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
