<?php

namespace DDTrace\Http;


class Headers
{
    public static function headersMapToColonSeparatedValues($headers)
    {
        $colonSeparatedValues = [];

        foreach ($headers as $key => $value) {
            $colonSeparatedValues[] = "$key: $value";
        }

        return $colonSeparatedValues;
    }
}
