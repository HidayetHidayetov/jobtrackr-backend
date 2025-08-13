<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Factories\HasFactory, Model};
use App\Enums\ApplicationStatusEnum;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'company_phone',
        'job_title',
        'apply_link',
        'applied_at',
        'cv_sent',
        'status',
        'contact_person',
        'notes',
    ];

    protected $casts = [
        'status' => ApplicationStatusEnum::class,
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
