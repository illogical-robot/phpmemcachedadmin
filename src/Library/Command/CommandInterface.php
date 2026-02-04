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
 * Interface of communication to MemCache Server
 *
 * @author elijaa@free.fr
 * @since 20/03/2010
 */
namespace App\Library\Command;

interface CommandInterface
{
    /**
     * Constructor
     *
     * @return void
     */
    function __construct();

    /**
     * Send stats command to server
     * Return the result if successful or false otherwise
     *
     * @param string $server Hostname
     * @param integer $port Hostname Port
     *
     * @return array|boolean
     */
    function stats(string $server, int $port);

    /**
     * Send stats settings command to server
     * Return the result if successful or false otherwise
     *
     * @param string $server Hostname
     * @param integer $port Hostname Port
     *
     * @return array|boolean
     */
    public function settings(string $server, int $port);

    /**
     * Retrieve slabs stats
     * Return the result if successful or false otherwise
     *
     * @param string $server Hostname
     * @param integer $port Hostname Port
     *
     * @return array|boolean
     */
    function slabs(string $server, int $port);

    /**
     * Retrieve items from a slabs
     * Return the result if successful or false otherwise
     *
     * @param string $server Hostname
     * @param integer $port Hostname Port
     * @param integer $slab Slab ID
     *
     * @return array|boolean
     */
    function items(string $server, int $port, int $slab);

    /**
     * Send get command to server to retrieve an item
     * Return the result
     *
     * @param string $server Hostname
     * @param integer $port Hostname Port
     * @param string $key Key to retrieve
     *
     * @return string|null
     */
    function get(string $server, int $port, string $key): ?string;

    /**
     * Set an item
     * Return the result
     *
     * @param string $server Hostname
     * @param integer $port Hostname Port
     * @param string $key Key to store
     * @param mixed $data Data to store
     * @param integer $duration Duration
     *
     * @return string
     */
    function set(string $server, int $port, string $key, $data, int $duration): string;

    /**
     * Delete an item
     * Return the result
     *
     * @param string $server Hostname
     * @param integer $port Hostname Port
     * @param string $key Key to delete
     *
     * @return string
     */
    function delete(string $server, int $port, string $key): string;

    /**
     * Increment the key by value
     * Return the result
     *
     * @param string $server Hostname
     * @param integer $port Hostname Port
     * @param string $key Key to increment
     * @param integer $value Value to increment
     *
     * @return string
     */
    function increment(string $server, int $port, string $key, int $value): string;

    /**
     * Decrement the key by value
     * Return the result
     *
     * @param string $server Hostname
     * @param integer $port Hostname Port
     * @param string $key Key to decrement
     * @param integer $value Value to decrement
     *
     * @return string
     */
    function decrement(string $server, int $port, string $key, int $value): string;

    /**
     * Flush all items on a server after delay
     * Return the result
     *
     * @param string $server Hostname
     * @param integer $port Hostname Port
     * @param integer $delay Delay before flushing server
     *
     * @return string
     */
    function flush_all(string $server, int $port, int $delay): string;

    /**
     * Search for item
     * Return all the items matching parameters if successful, false otherwise
     *
     * @param string $server Hostname
     * @param integer $port Hostname Port
     * @param string $search
     * @param string|null $level Level of detail
     * @param string|null $more More action
     *
     * @return array
     */
    function search(string $server, int $port, string $search, ?string $level = null, ?string $more = null): array;

    /**
     * Execute a telnet command on a server
     * Return the result
     *
     * @param string $server Hostname
     * @param integer $port Hostname Port
     * @param string $command Command to execute
     *
     * @return string
     */
    function telnet(string $server, int $port, string $command): string;
}
