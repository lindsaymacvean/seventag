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

namespace SevenTag\Api\ContainerBundle\Tests\NoScript\Handler;

use SevenTag\Api\ContainerBundle\Entity\Container;
use SevenTag\Api\ContainerBundle\NoScript\Handler\NoScriptHandler;
use Sonata\NotificationBundle\Backend\BackendInterface;
use Symfony\Component\HttpFoundation\Request;

class NoScriptHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itShouldHandleData()
    {
        $request = new Request();
        $container = new Container();

        $handler = new NoScriptHandler($this->getBackendMock($request, $container), 'noScript');
        $handler->handle($request, $container);
    }

    /**
     * @param Request $request
     * @param Container $container
     * @return BackendInterface
     */
    private function getBackendMock(Request $request, Container $container)
    {
        /** @var BackendInterface $mock */
        $mock = $this->prophesize('Sonata\NotificationBundle\Backend\BackendInterface');
        $mock
            ->createAndPublish('noScript', [
                'request' => $request,
                'container' => $container
            ])
            ->shouldBeCalledTimes(1);

        return $mock->reveal();
    }
}
