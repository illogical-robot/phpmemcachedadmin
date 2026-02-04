# PHPMemcachedAdmin #

## Fork

Forked the original implementation from https://github.com/elijaa/phpmemcachedadmin to provide additional features, like key search and listing.

## Installation

### As a standalone PHP PHAR script

All the assets and scripts are embed into the PHAR file.

1. Download the file `phpmemcachedadmin.phar` from the latest release https://github.com/AlexeyPlodenko/phpmemcachedadmin/releases
2. Rename `phpmemcachedadmin.phar` to `phpmemcachedadmin.php`
3. Create a file `.config.php` next to the `phpmemcachedadmin.php` script and put your configuration there:
    ```php
    <?php
    return [
        'servers' =>[
            'Default' => [
                'localhost-server' => [
                    'hostname' => '127.0.0.1',
                    'port' => '11211',
                ],
            ],
        ],
    ];
    ```
4. Upload `phpmemcachedadmin.php` and `.config.php` to your server to the same directory
5. Access the script at http://YOUR-DOMAIN-GOES-HERE/phpmemcachedadmin.php

### As a standalone PHP scripts

1. Clone the repository.
2. Create the file `/.config.php` and put your configuration there:
    ```php
    <?php
    return [
        'servers' =>[
            'Default' => [
                'localhost-server' => [
                    'hostname' => '127.0.0.1',
                    'port' => '11211',
                ],
            ],
        ],
    ];
    ```
3. In your console, navigate to the root of the project and execute `composer install` to install the PHP Composer packages.
4. Deploy all code to your server one level above your website directory.
5. The `/src/public/` directory should be configured as your website root directory.

### As a Docker container

1. Clone the repository.
2. Create the file `/.config.php` and put your configuration there:
    ```php
    <?php
    return [
        'servers' =>[
            'Default' => [
                'docker-server' => [
                    'hostname' => 'host.docker.internal',
                    'port' => '11211',
                ],
            ],
        ],
    ];
    ```
3. In your console, navigate to the root of the project...
   1. ...and execute `composer install` to install the PHP Composer packages.
   2. ...and execute `docker compose up` to start the Docker containers.
4. Now you can access the `phpmemcachedadmin` at http://localhost

#### If you need to modify the `docker-compose.yml` configuration

Do not edit the original file, but rather create `/docker-compose.override.yml` and put your configuration there. That is the official Docker way.

## Graphic stand-alone administration for Memcached to monitor and debug purpose

This program allows to see in **real-time** (top-like) or from the start of the server, **stats for get, set, delete, increment, decrement, evictions, reclaimed, cas command**, as well as **server stats** (network, items, server version) with Google Charts and  **server internal configuration**

You can go further to **see each server slabs, occupation, memory wasted and items** (**key & value**).

Another part can execute commands to any memcached server : get, set, delete, flush\_all, as well as execute any commands (like stats) with telnet

## Feature list

<h4>Statistics</h4>
<ul><li>Stats for each or all memcached servers, items, evicted, reclaimed ...<br>
</li><li>Stats for every command : set, get, delete, incr, decr, cas ...<br>
</li><li>Slabs stats (Memory, pages, memory wasted, items)<br>
</li><li>Items stats (View items in slabs, then data for each key)<br>
</li><li>Network stats (Traffic, bandwidth)</li></ul>

<h4>Commands</h4>
<ul><li>Execute commands : get, set, delete, flush_all on servers to administrate or debug it<br>
</li><li>Get data with key on servers<br>
</li><li>Delete keys on servers<br>
</li><li>Flush servers<br>
</li><li>Execute telnet command directly from phpMemcachedAdmin<br>
</li><li>Search for specific pattern into all keys</li></ul>

<h4>Live Stats</h4>
<ul><li>Top-like real time stats with configurable alerts</li></ul>

<h4>Configuration</h4>
<ul><li>Edit configuration directly from web page<br>
</li><li>phpMemcachedAdmin can use socket communication, PECL Memcache or Memcached API<br>
</li><li>Organize your servers into cluster</li></ul>

## Security

phpMemcachedAdmin does not provide any security system, you need to add this feature by yourself.
