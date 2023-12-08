<?php

namespace App\Traits;

use App\Models\Api\V1\Logs\Log;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

trait LogsTrait
{
    public static function saveLog(
        string $action,
        array $context,
        string $error
    ) {
        try {
            $limitCharsDb = 777;

            $log = new Log();
            $log->action = $action;
            $log->context = Str::limit(json_encode($context), $limitCharsDb);
            $log->error = Str::limit($error, $limitCharsDb);
            $log->save();
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}