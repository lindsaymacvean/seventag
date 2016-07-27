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

use SevenTag\Api\TagBundle\Entity\TagRepository;
use SevenTag\Component\Container\Model\ContainerInterface;
use SevenTag\Component\Tag\Model\TagInterface;
use Sonata\NotificationBundle\Backend\BackendInterface;
use Sonata\NotificationBundle\Consumer\ConsumerEvent;
use Sonata\NotificationBundle\Consumer\ConsumerInterface;

/**
 * @package SevenTag\Api\ContainerBundle\NoScript\Consumer
 * @author Patryk Kala <kkallosz@gmail.com>
 */
class RequestConsumer implements ConsumerInterface
{
    /**
     * @var TagRepository
     */
    private $tagRepository;
    /**
     * @var BackendInterface
     */
    private $backend;
    /**
     * @var string
     */
    private $consumerName;

    /**
     * @param TagRepository $tagRepository
     * @param BackendInterface $backend
     * @param $consumerName
     */
    public function __construct(TagRepository $tagRepository, BackendInterface $backend, $consumerName)
    {
        $this->tagRepository = $tagRepository;
        $this->backend = $backend;
        $this->consumerName = $consumerName;
    }

    /**
     * Process a ConsumerEvent
     *
     * @param ConsumerEvent $event
     */
    public function process(ConsumerEvent $event)
    {
        $noScriptTags = $this->tagRepository->findNoScriptTagsForContainer($this->getContainerFromEvent($event));

        /** @var TagInterface $tag */
        foreach ($noScriptTags as $tag) {
            $this->backend->createAndPublish($this->consumerName, [
                'uri' => $tag->getNoScriptUri(),
                'request' => $this->getRequestFromEvent($event)
            ]);
        }
    }

    /**
     * @param ConsumerEvent $event
     * @return object
     */
    private function getRequestFromEvent(ConsumerEvent $event)
    {
        $body = $event->getMessage()->getBody();

        return $body['request'];
    }

    /**
     * @param ConsumerEvent $event
     * @return ContainerInterface
     */
    private function getContainerFromEvent(ConsumerEvent $event)
    {
        $body = $event->getMessage()->getBody();

        return $body['container'];
    }
}
