<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Session as LaravelSession;
use Illuminate\Support\Carbon;

use App\Models\AbTest;
use App\Helpers\AbTestHelper;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read EloquentCollection<int, Event> $events
 */
class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'ab_test_variant',
    ];

    protected static function booted()
    {
        static::creating(function ($session) {
            $activeAbTest = AbTest::where('is_active', true)->first();
            if ($activeAbTest) {
                $variant = AbTestHelper::assignVariant($activeAbTest);
                $session->ab_test_variant = $variant ? $variant->name : null;
            }
        });
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
