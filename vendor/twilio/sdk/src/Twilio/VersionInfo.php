<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = "7";
    const MINOR = "13";
    const PATCH = "1";

    public static function string() {
        return implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
    }
}
