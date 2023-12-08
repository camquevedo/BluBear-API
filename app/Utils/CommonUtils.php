<?php
use Carbon\Carbon;

function paginate($foundEntities): stdClass
{
    $pagination = new stdClass();
    $pagination->currentPage = $foundEntities->currentPage();
    $pagination->perPage = $foundEntities->perPage();
    $pagination->lastPage = $foundEntities->lastPage();
    $pagination->total = $foundEntities->total();
    return $pagination;
}

function arrayToObject(array $array): object
{
    return json_decode(json_encode($array), false);
}

function entityToString($entity): string
{
    return json_encode($entity);
}

function formatCleanText(string $text): string
{
    $cleanText = preg_replace('/<[\s\S]+?>/', '', $text);

    return preg_replace('/[^A-Za-z0-9\- ]/', '', $cleanText);
}

function normalizeString($string)
{
    $normalized = mb_strtolower($string, 'UTF-8');
    $normalized = str_replace(
        ['à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'],
        ['a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y'],
        $normalized
    );
    return $normalized;
}

function removeSpecialCharacters($string)
{
    return preg_replace('/[^a-zA-Z0-9\s]/', '', $string);
}

function formatDocument(string $document): string
{
    return str_replace(['.', '-', ' '], '', $document);
}

function formatHour($hour)
{
    if (!$hour) {
        return null;
    }

    return Carbon::parse($hour)->format('h:i A');
}
function formatTime($time)
{
    if (!$time) {
        return null;
    }

    return Carbon::parse($time)->format('d-m-Y h:i A');
}
function formatDate($date)
{
    if (!preg_match('/^(19|20)\d{2}-(0[1-9]|1[0-2])-([0-2][1-9]|3[01])$/', $date)) {
        return null;
    }

    try {
        $formatDate = Carbon::createFromFormat('Y-m-d', $date);
        return $formatDate->format('Y-m-d');
    } catch (Exception $e) {
        return null;
    }
}


function decamelize(string $string): string
{
    return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $string));
}