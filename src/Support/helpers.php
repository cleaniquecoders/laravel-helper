<?php

use Illuminate\Support\Str;

/*
 * generate sequence
 * @return sequence based on length supplied
 */
if (! function_exists('generate_sequence')) {
    function generate_sequence($input = 1)
    {
        return str_pad($input, config('helper.sequence_length'), '0', STR_PAD_LEFT);
    }
}

/*
 * Get Abbreviation fo the given text
 */
if (! function_exists('abbrv')) {
    function abbrv($value, $unique_characters = true)
    {
        if (true === config('helper.abbrv.remove_non_alphanumeric')) {
            $value = preg_replace('/[^A-Za-z0-9 ]/', '', $value);
        }

        $value = str_replace(
            config('helper.abbrv.remove_vowels'),
            '',
            $value
        );

        if (true === config('helper.abbrv.to_uppercase')) {
            $value = strtoupper($value);
        }

        if (true == config('helper.abbrv.unique_characters') || true == $unique_characters) {
            $split = str_split($value);
            $unique_characters = [];
            foreach ($split as $character) {
                if (! in_array($character, $unique_characters)) {
                    $unique_characters[] = $character;
                }
            }

            return implode('', $unique_characters);
        }

        return $value;
    }
}

/*
 * Get Fully Qualified Class Name (FQCN) for an Object
 */
if (! function_exists('fqcn')) {
    function fqcn($object)
    {
        return get_class($object);
    }
}

/*
 * Get Slug Name for Fully Qualified Class Name (FQCN)
 */
if (! function_exists('str_slug_fqcn')) {
    function str_slug_fqcn($object)
    {
        return Str::kebab(fqcn($object));
    }
}

/*
 * Send Notification To User
 */
if (! function_exists('notify')) {
    function notify($identifier, $column = 'id')
    {
        return \CleaniqueCoders\LaravelHelper\Services\NotificationService::make($identifier, $column);
    }
}

/*
 * user() helper
 */
if (! function_exists('user')) {
    function user()
    {
        foreach (config('auth.guards') as $key => $value) {
            if (Auth::guard($key)->check()) {
                return Auth::guard($key)->user();
            }
        }

        return null;
    }
}

/*
 * Minify given HTML Content
 */
if (! function_exists('minify')) {
    function minify($value)
    {
        $replace = [
            '/<!--[^\[](.*?)[^\]]-->/s' => '',
            "/<\?php/" => '<?php ',
            "/\n([\S])/" => '$1',
            "/\r/" => '',
            "/\n/" => '',
            "/\t/" => '',
            '/ +/' => ' ',
        ];

        if (false !== strpos($value, '<pre>')) {
            $replace = [
                '/<!--[^\[](.*?)[^\]]-->/s' => '',
                "/<\?php/" => '<?php ',
                "/\r/" => '',
                "/>\n</" => '><',
                "/>\s+\n</" => '><',
                "/>\n\s+</" => '><',
            ];
        }

        return preg_replace(array_keys($replace), array_values($replace), $value);
    }
}
