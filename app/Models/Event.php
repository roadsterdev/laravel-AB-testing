<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $session_id
 * @property string $url
 * @property string $type
 * @property array<string, mixed> $data
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Session $session
 */
class Event extends Model
{
    use HasFactory;

    protected $fillable = ['session_id', 'url', 'type', 'data'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'session_id' => 'integer',
        'data' => 'array',
    ];

    /**
     * @return BelongsTo<Session, Event>
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }
}
