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

namespace SevenTag\Api\ContainerBundle\Tests\NoScript\Consumer;

use SevenTag\Api\ContainerBundle\Entity\Container;
use SevenTag\Api\ContainerBundle\NoScript\Consumer\RequestConsumer;
use SevenTag\Api\TagBundle\Entity\Tag;
use SevenTag\Api\TagBundle\Entity\TagRepository;
use Sonata\NotificationBundle\Backend\BackendInterface;
use Sonata\NotificationBundle\Consumer\ConsumerEvent;
use Sonata\NotificationBundle\Model\Message;
use Symfony\Component\HttpFoundation\Request;

class RequestConsumerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itShouldProcessData()
    {
        $request = new Request();
        $containerObject = new Container();
        $message = new Message();
        $message->setBody([
            'request' => $request,
            'container' => $containerObject
        ]);
        $event = new ConsumerEvent($message);

        $consumer = new RequestConsumer(
            $this->getTagRepositoryMock($containerObject),
            $this->getBackendMock($request),
            'request'
        );
        $consumer->process($event);
    }

    /**
     * @param Container $containerObject
     * @return TagRepository
     */
    private function getTagRepositoryMock(Container $containerObject)
    {
        $mock = $this->prophesize('SevenTag\Api\TagBundle\Entity\TagRepository');
        $mock
            ->findNoScriptTagsForContainer($containerObject)
            ->shouldBeCalledTimes(1)
            ->willReturn([new Tag(), new Tag()]);

        return $mock->reveal();
    }

    /**
     * @param Request $request
     * @return BackendInterface
     */
    private function getBackendMock(Request $request)
    {
        /** @var BackendInterface $mock */
        $mock = $this->prophesize('Sonata\NotificationBundle\Backend\BackendInterface');
        $mock
            ->createAndPublish('request', [
                'uri' => null,
                'request' => $request
            ])
            ->shouldBeCalledTimes(2);

        return $mock->reveal();
    }
}
