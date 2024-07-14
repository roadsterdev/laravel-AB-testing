<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AbVariant extends Model
{
    use HasFactory;

    protected $fillable = ['ab_test_id', 'name', 'ratio'];

    protected $casts = [
        'ab_test_id' => 'integer',
        'ratio' => 'integer',
    ];

    public function abTest(): BelongsTo
    {
        return $this->belongsTo(AbTest::class);
    }

    protected $table = 'ab_test_variants';
}
