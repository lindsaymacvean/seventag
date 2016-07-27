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

namespace SevenTag\Api\ContainerBundle\NoScript\Consumer;

use SevenTag\Api\ContainerBundle\NoScript\Request\NoScriptRequestInterface;
use Sonata\NotificationBundle\Consumer\ConsumerEvent;
use Sonata\NotificationBundle\Consumer\ConsumerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @package SevenTag\Api\ContainerBundle\NoScript\Consumer
 * @author Patryk Kala <kkallosz@gmail.com>
 */
class NoScriptConsumer implements ConsumerInterface
{
    /**
     * @var NoScriptRequestInterface
     */
    private $request;

    /**
     * @param NoScriptRequestInterface $clientRequest
     */
    public function __construct(NoScriptRequestInterface $clientRequest)
    {
        $this->request = $clientRequest;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ConsumerEvent $event)
    {
        try {
            $request = $this->getRequestFromEvent($event);
            $this->request->send($this->getUriFromEvent($event), $request->cookies, $request->headers);
        } catch (\Exception $e) {
        }
    }

    /**
     * @param ConsumerEvent $event
     * @return Request
     */
    private function getRequestFromEvent(ConsumerEvent $event)
    {
        $body = $event->getMessage()->getBody();

        return $body['request'];
    }

    /**
     * @param ConsumerEvent $event
     * @return string
     */
    private function getUriFromEvent(ConsumerEvent $event)
    {
        $body = $event->getMessage()->getBody();

        return $body['uri'];
    }
}
