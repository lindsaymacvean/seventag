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

use Prophecy\Argument;
use SevenTag\Api\ContainerBundle\NoScript\Consumer\NoScriptConsumer;
use SevenTag\Api\ContainerBundle\NoScript\Request\NoScriptRequestInterface;
use Sonata\NotificationBundle\Consumer\ConsumerEvent;
use Sonata\NotificationBundle\Model\Message;
use Symfony\Component\HttpFoundation\Request;

class NoScriptConsumerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider getValidUriList
     * @param $uri
     */
    public function itShouldProcessData($uri)
    {
        $message = new Message();
        $message->setBody([
            'request' => new Request(),
            'uri' => $uri
        ]);
        $event = new ConsumerEvent($message);

        $consumer = new NoScriptConsumer($this->getNoScriptRequestMock($uri));
        $consumer->process($event);
    }

    /**
     * @param string $url
     * @return NoScriptRequestInterface
     */
    private function getNoScriptRequestMock($url)
    {
        $mock = $this->prophesize('SevenTag\Api\ContainerBundle\NoScript\Request\NoScriptRequestInterface');
        $mock
            ->send($url, Argument::any(), Argument::any())
            ->shouldBeCalledTimes(1)
            ->willReturn($this->getRequestResponseMock());

        return $mock->reveal();
    }

    /**
     * @return object
     */
    private function getRequestResponseMock()
    {
        $mock = $this->prophesize('GuzzleHttp\Message\ResponseInterface');

        return $mock->reveal();
    }

    /**
     * @return array
     */
    public function getValidUriList()
    {
        return [
            ['http://www.example.com'],
            ['http://example.com']
        ];
    }
}
