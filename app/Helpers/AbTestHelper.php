<?php

namespace App\Helpers;

use App\Models\AbTest;

class AbTestHelper
{
    public static function assignVariant(AbTest $abTest)
    {
        if ($abTest->variants->isEmpty()) {
            return null;
        }

        $totalRatio = $abTest->variants->sum('ratio');

        if ($totalRatio <= 0) {
            return null;
        }

        $random = mt_rand(1, $totalRatio);
        $cumulativeRatio = 0;

        foreach ($abTest->variants as $variant) {
            $cumulativeRatio += $variant->ratio;
            if ($random <= $cumulativeRatio) {
                return $variant;
            }
        }

        return null;
    }
}