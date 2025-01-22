<?php

/**
 * Utility class
 * 
 * A collection of helper functions. Very useful!
 * 
 * To use, just require this file at the top of any page you want it to work on and use the methods.
 * 
 * You do not need to instantiate this class to use its methods.
 * 
 * For example (in the file you want to the use the class):
 * Utility::redirect('https://example.com');
 * 
 * This should be useful for most projects. 
 * I will be back... To add more functions.
 * 
 * Whenever I make a project that needs a new helper I deem useful, I will add it here.
 * 
 * This is a very useful class. You should use it.
 * 
 * GLHF! 
 * 
 * - Past Henry
 * D.O.C 22/1/2025
 * 
 */
class Utility
{
    /**
     * Get the base path
     * 
     * @param string $path
     * @return string
     */
    public static function basePath($path = '')
    {
        return __DIR__ . "/" . $path;
    }

    /**
     * Inspect a value(s)
     * 
     * @param mixed $value
     * @return void
     */
    public static function inspect($value)
    {
        echo '<pre>';
        var_dump($value);
        echo '</pre>';
    }

    /**
     * Inspect a value(s) and terminate the script
     * 
     * @param mixed $value
     * @return void
     */
    public static function inspectAndDie($value)
    {
        echo '<pre>';
        die(var_dump($value));
        echo '</pre>';
    }

    /**
     * Format salary
     *
     * @param string $salary
     * @return string Formatted salary
     */
    public static function formatSalary($salary)
    {
        return '£' . number_format(floatval($salary));
    }

    /**
     * Sanitize data
     * 
     * @param string $dirty
     * @return string
     */
    public static function sanitise($dirty)
    {
        return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
    }

    /**
     * Redirect to a given URL
     * 
     * @param string $url
     * @return void
     */
    public static function redirect($url)
    {
        header("Location: {$url}");
        exit;
    }

    /**
     * Generate a random string
     * 
     * @param int $length
     * @return string
     */
    public static function randomString($length = 16)
    {
        return bin2hex(random_bytes($length / 2));
    }

    /**
     * Check if a value is JSON
     * 
     * @param string $string
     * @return bool
     */
    public static function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * Format a date
     * 
     * @param string $date
     * @param string $format
     * @return string
     */
    public static function formatDate($date, $format = 'Y-m-d')
    {
        return date($format, strtotime($date));
    }

    /**
     * Log debug messages
     * 
     * @param string $message
     * @param string $file
     * @return void
     */
    public static function logDebug($message, $file = 'debug.log')
    {
        $time = date('Y-m-d H:i:s');
        file_put_contents($file, "[$time] $message" . PHP_EOL, FILE_APPEND);
    }

    /**
     * Check if a string contains a substring
     * 
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    public static function contains($haystack, $needle)
    {
        return strpos($haystack, $needle) !== false;
    }

    /**
     * Sanitize an array of data
     * 
     * @param array $data
     * @return array
     */
    public static function sanitiseArray(array $data)
    {
        return array_map([self::class, 'sanitise'], $data);
    }

    /**
     * Pluralize a word based on count
     * 
     * @param string $word
     * @param int $count
     * @return string
     */
    public static function pluralize($word, $count)
    {
        return $count === 1 ? $word : $word . 's';
    }
}
