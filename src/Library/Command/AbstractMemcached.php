<?php

namespace App\Library\Command;

use Exception;

abstract class AbstractMemcached
{
    /**
     * @throws Exception
     */
    protected function validateKey(string $key)
    {
        if (!preg_match('/^[^\x00-\x1F\x7F\s]{1,250}$/', $key)) {
            throw new Exception(
                'Key must be a string up to 250 symbols long, and not containing control and whitespace characters.'
            );
        }
    }
}
