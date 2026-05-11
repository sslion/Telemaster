<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

/**
 * A convenience method for accessing the settings instance,
 * or an item that has been set in the settings.
 *
 * Examples:
 *    settings()->set('foo', 'bar');
 *    $foo = settings('bar');
 *
 * @param string $val
 *
 * @return \App\Libraries\Settings
 */
function settings(?string $key = null)
{
    $settings = \App\Libraries\Settings::getInstance();

    if (is_string($key)) return $settings->get($key);

    return $settings;
}

function getTelegram()
{
    return \App\Libraries\Telegram::getInstance();
}

/**
 * Удаелляет из строки все символы кроме цифр
 *
 * Examples:
 *    $normalizedPhone = normalizePhone('+7 (999) 888 77 66'); // 79998887766
 *
 * @param string $phone
 *
 * @return string
 */
function normalizePhone(string  $phone): string {
    return preg_replace("/[^0-9]/", '', $phone);
}
