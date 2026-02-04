<?php
/**
 * Copyright 2010 Cyrille Mahieux
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and limitations
 * under the License.
 *
 * ><)))°> ><)))°> ><)))°> ><)))°> ><)))°> ><)))°> ><)))°> ><)))°> ><)))°>
 *
 * Factory for communication with Memcache Server
 *
 * @author elijaa@free.fr
 * @since 30/03/2010
 */
namespace App\Library\Command;

use App\Library\App;
use InvalidArgumentException;

class Factory
{
    /**
     * @var array
     */
    private static $_object = [];

    /**
     * No explicit call of constructor
     */
    private function __construct()
    {}

    /**
     * No explicit call of clone()
     *
     * @return void
     */
    private function __clone()
    {}

    /**
     * Accessor to command class instance by command type
     *
     * @param string $command Type of command
     */
    public static function instance(string $command): AbstractMemcached
    {
        # Importing configuration
        $_ini = App::getInstance();

        # Instance does not exist
        if (! isset(self::$_object[$_ini->get($command)]) || ($_ini->get($command) !== 'Server')) {
            # Switching by API
            switch ($_ini->get($command)) {
                case 'Memcache':
                    # PECL Memcache API
                    require_once 'Memcache.php';
                    self::$_object['Memcache'] = new Memcache();
                    break;

                case 'Memcached':
                    # PECL Memcached API
                    require_once 'Memcached.php';
                    self::$_object['Memcached'] = new Memcached();
                    break;

                case 'Server':
                    # Server API (e.g. communicating directly with the memcache server)
                    require_once 'Server.php';
                    self::$_object['Server'] = new Server();
                    break;

                default:
                    throw new InvalidArgumentException("Unknown API supplied \"$command\".");
            }
        }
        
        return self::$_object[$_ini->get($command)];
    }

    /**
     * Accessor to command class instance by type
     */
    public static function api(string $api): AbstractMemcached
    {
        # Instance does not exist
        if (! isset(self::$_object[$api]) || ($api !== 'Server')) {
            # Switching by API
            switch ($api) {
                case 'Memcache' :
                    # PECL Memcache API
                    require_once 'Memcache.php';
                    self::$_object['Memcache'] = new Memcache();
                    break;

                case 'Memcached' :
                    # PECL Memcached API
                    require_once 'Memcached.php';
                    self::$_object['Memcached'] = new Memcached();
                    break;

                case 'Server' :
                    # Server API (e.g. communicating directly with the memcache server)
                    require_once 'Server.php';
                    self::$_object['Server'] = new Server();
                    break;

                default:
                    throw new InvalidArgumentException("Unknown API supplied \"$api\".");
            }
        }
        
        return self::$_object[$api];
    }
}
