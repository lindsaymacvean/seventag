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

namespace SevenTag\Api\ContainerBundle\NoScript\Handler;

use SevenTag\Component\Container\Model\ContainerInterface;
use Sonata\NotificationBundle\Backend\BackendInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @package SevenTag\Api\ContainerBundle\NoScript\Handler
 * @author Patryk Kala <kkallosz@gmail.com>
 */
class NoScriptHandler
{
    /**
     * @var BackendInterface
     */
    private $backend;
    /**
     * @var string
     */
    private $consumerName;

    /**
     * @param BackendInterface $backend
     * @param string $consumerName
     */
    public function __construct(BackendInterface $backend, $consumerName)
    {
        $this->backend = $backend;
        $this->consumerName = $consumerName;
    }

    /**
     * @param Request $request
     * @param ContainerInterface $container
     */
    public function handle(Request $request, ContainerInterface $container)
    {
        $this->backend->createAndPublish($this->consumerName, [
            'request' => $request,
            'container' => $container
        ]);
    }
}
