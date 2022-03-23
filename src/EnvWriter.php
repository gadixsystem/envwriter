<?php

namespace gadixsystem\envwriter;

class EnvWriter
{
    /**
     * Change env key value.
     *
     * @param  string $key
     * @param  string $value
     * @param  bool   $trim
     * @return boolean
     */
    public static function change(
        string $key,
        string $value,
        bool $trim = true
    ): bool {
        if ($key == null || $value == null) {
            return false;
        }

        $key = str_replace(' ', '', $key);
        if ($trim) {
            $value = str_replace(' ', '', $value);
        } else {
            $value = '"' . $value . '"';
        }
        $envContent = self::reader();

        $newContent = self::readAndReplace($envContent, $key, $value, false);

        self::writer($newContent);

        return true;
    }

    /**
     * Check if exists env key value.
     *
     * @param  string $key
     * @return boolean
     */
    public static function exists(string $key): bool
    {
        $exists = false;
        $key = str_replace(' ', '', $key);

        if ($key == null) {
            return false;
        }

        $envContent = self::reader();

        foreach ($envContent as $env_line) {
            $entry = explode("=", $env_line, 2);

            if ($entry[0] == $key) {
                $exists = true;

                break;
            }
        }

        return $exists;
    }

    /**
     * Delete env key value.
     *
     * @param  string $key
     * @return boolean
     */
    public static function delete(string $key): bool
    {
        if ($key == null || !self::exists($key)) {
            return false;
        }

        $key = str_replace(' ', '', $key);

        $envContent = self::reader();

        $newContent = self::readAndReplace($envContent, $key, null, true);

        self::writer($newContent);

        return true;
    }

    /**
     * Reader the env file.
     *
     * @return array
     */
    protected static function reader(): array
    {
        $env = file_get_contents(base_path() . '/.env');

        return preg_split('/\n/', $env);
    }

    /**
     * Writer env file.
     *
     * @param  string $content
     * @return void
     */
    protected static function writer(string $content): void
    {
        file_put_contents(base_path() . '/.env', $content);
    }

    /**
     * @param  array   $env
     * @param  string  $key
     * @param  string  $value
     * @param  boolean $delete
     * @return string
     */
    protected static function readAndReplace(
        array $env,
        string $key,
        string $value,
        bool $delete
    ): string {
        $replaced = false;

        foreach ($env as $item => $env_line) {
            $entry = explode("=", $env_line, 2);

            if ($entry[0] == $key) {
                $env[$item] = $key . "=" . $value;

                if ($delete) {
                    $env[$item] = "";
                }
                $replaced = true;
            } else {
                $env[$item] = $env_line;
            }
        }
        if (!$replaced && !$delete) {
            $env['new'] = $key . "=" . $value;
        }

        return implode("\n", $env);
    }
}
