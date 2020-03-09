<?php

/**
 * Petite classe pour un peu de mise en forme des messages de tests
 */
class Test
{
    /**
     * @param string $test
     * @param bool $cond
     */
    public static function assert(string $test, bool $cond): void
    {
        if ($cond) {
            self::success('[OK] ' . $test);
        } else {
            self::error('[KO] ' . $test);
        }
    }

    /**
     * @param string $msg
     */
    public static function success(string $msg): void
    {
        $green = "\033[0;32m";
        $default = "\033[0m";
        echo $green . $msg . $default . PHP_EOL;
    }

    /**
     * @param string $msg
     */
    public static function error(string $msg): void
    {
        $green = "\033[0;31m";
        $default = "\033[0m";
        echo $green . $msg . $default . PHP_EOL;
    }
}
