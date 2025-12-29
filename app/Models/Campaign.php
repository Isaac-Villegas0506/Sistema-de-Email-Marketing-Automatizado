<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function emailJobs()
    {
        return $this->hasMany(EmailJob::class);
    }

    public function emailLogs()
    {
        return $this->hasMany(EmailLog::class);
    }
}
