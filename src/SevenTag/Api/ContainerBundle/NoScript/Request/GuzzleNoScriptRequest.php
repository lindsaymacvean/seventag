<?php
/**
 * Copyright (C) 2015 Digimedia Sp. z o.o. d/b/a Clearcode
 *
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License as published by the Free
 * Software Foundation, either version 3 of the License, or (at your option) any
 * later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace SevenTag\Api\ContainerBundle\NoScript\Request;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @package SevenTag\Api\ContainerBundle\NoScript\Request
 * @author Patryk Kala <kkallosz@gmail.com>
 */
class GuzzleNoScriptRequest implements NoScriptRequestInterface
{
    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string $uri
     * @param ParameterBag $cookies
     * @param HeaderBag $headers
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function send($uri, ParameterBag $cookies, HeaderBag $headers)
    {
        return $this->client->get($uri, [
            'cookies' => $cookies->all(),
            'headers' => $headers->all(),
            'exceptions' => false
        ]);
    }
}
