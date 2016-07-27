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

namespace SevenTag\Api\TriggerBundle\Listener;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\UnitOfWork;
use SevenTag\Api\TagBundle\Entity\Tag;
use SevenTag\Api\TriggerBundle\Entity\Condition;
use SevenTag\Api\TriggerBundle\Entity\Trigger;

/**
 * Class ConditionUpdatedAtChainListener
 * @package SevenTag\Api\TriggerBundle\Listener
 */
class ConditionUpdatedAtChainListener
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UnitOfWork
     */
    private $unitOfWork;

    /**
     * @var \Doctrine\ORM\Mapping\ClassMetadataFactory
     */
    private $metadataFactory;

    public function onFlush(OnFlushEventArgs $eventArgs)
    {
        $this->entityManager = $eventArgs->getEntityManager();
        $this->unitOfWork = $this->entityManager->getUnitOfWork();
        $this->metadataFactory = $this->entityManager->getMetadataFactory();

        $this->onUpdateConditions($this->unitOfWork->getScheduledEntityUpdates());
        $this->onUpdateTriggers($this->unitOfWork->getScheduledEntityUpdates());
        $this->onUpdateTag($this->unitOfWork->getScheduledEntityUpdates());

    }

    /**
     * @param array $entities
     */
    private function onUpdateConditions(array $entities)
    {
        foreach ($entities as $entity) {
            if ($entity instanceof Condition) {
                $trigger = $entity->getTrigger();
                $trigger->getUpdatedAt();

                $className = get_class($trigger);

                if ($this->metadataFactory->hasMetadataFor($className)) {
                    $trigger->setUpdatedAt($entity->getUpdatedAt());

                    $this->unitOfWork->recomputeSingleEntityChangeSet(
                        $this->metadataFactory->getMetadataFor($className),
                        $trigger
                    );

                }
            }
        }
    }

    /**
     * @param array $entities
     */
    private function onUpdateTriggers(array $entities)
    {
        foreach ($entities as $entity) {
            if ($entity instanceof Trigger) {
                $container = $entity->getContainer();
                $container->getUpdatedAt();
                $className = get_class($container);

                if ($this->metadataFactory->hasMetadataFor($className)) {
                    $container->setUpdatedAt($entity->getUpdatedAt());

                    $this->unitOfWork->recomputeSingleEntityChangeSet(
                        $this->metadataFactory->getMetadataFor($className),
                        $container
                    );

                }

                /** @var Tag $tag */
                foreach ($entity->getTags() as $tag) {
                    $tag->getUpdatedAt();
                    $className = get_class($tag);

                    if ($this->metadataFactory->hasMetadataFor($className)) {
                        $tag->setUpdatedAt($entity->getUpdatedAt());

                        $this->unitOfWork->recomputeSingleEntityChangeSet(
                            $this->metadataFactory->getMetadataFor($className),
                            $tag
                        );
                    }
                }
            }
        }
    }

    /**
     * @param array $entities
     */
    private function onUpdateTag(array $entities)
    {
        foreach ($entities as $entity) {
            if ($entity instanceof Tag) {
                $container = $entity->getContainer();
                $container->getUpdatedAt();
                $className = get_class($container);

                if ($this->metadataFactory->hasMetadataFor($className)) {
                    $container->setUpdatedAt($entity->getUpdatedAt());

                    $this->unitOfWork->recomputeSingleEntityChangeSet(
                        $this->metadataFactory->getMetadataFor(get_class($container)),
                        $container
                    );

                }
            }
        }
    }
}
