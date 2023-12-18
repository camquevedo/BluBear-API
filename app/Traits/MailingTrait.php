<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

use App\Models\Api\V1\Logs\Log;
use Illuminate\Support\Str;
use stdClass;

trait MailingTrait
{
    private static function sendMail(
        $entity,
        array $emails = [],
        array $elements = [],
        int $cityId = null
    ): bool | String {
        $config = config('constants.mailing');
        if (!$config['sendMails'] || !$emails) {
            return false;
        }

        $city = self::getCityById($cityId ?? null);
        if (!$city) {
            self::saveLogMail(
                'SEND_EMAIL_GET_CITY',
                [__FUNCTION__, (string) $entity, 'getCityById', $cityId],
                'City not found'
            );
            return false;
        }

        try {
            Mail::to($emails)->send(new $entity($config, $city, $elements));
        } catch (\Exception $e) {
            self::saveLogMail(
                'SEND_EMAIL',
                [__FUNCTION__, (string) $entity, 'send', $cityId],
                $e->getMessage()
            );
            return false;
        }

        return true;
    }

    private static function getCityById()
    {
        $city = new stdClass();
        $city->name = "Camilo Quevedo";
        $city->city_email = "test@mail.com";
        $city->address = "My home";
        $city->numbers = [];
        $city->bannerImage = "https://www.pngall.com/wp-content/uploads/2/Digimon-Logo-PNG-Clipart.png";
        $city->bannerLink = "https://digimon-api.com/";

        return $city;
    }

    private static function saveLogMail(
        string $action,
        array $context,
        string $error
    ) {
        DB::beginTransaction();

        try {
            $limitCharsDb = 252;

            $log = new Log();
            $log->action = $action;
            $log->context = Str::limit(json_encode($context), $limitCharsDb);
            $log->error = Str::limit($error, $limitCharsDb);
            $log->save();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
        }
    }
}
