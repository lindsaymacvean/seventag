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

namespace SevenTag\Api\ContainerBundle\TagTree\Handler;

use SevenTag\Api\TriggerBundle\TriggerType\Type\TypeInterface;
use SevenTag\Api\TriggerBundle\VariableType\VariableTypeInterface;

/**
 * Class ConditionsHandler
 * @package SevenTag\Api\ContainerBundle\TagTree\Handler
 */
class ConditionsHandler extends ChainOfResponsibilityHandler
{
    const EVENT_PAGE_VIEW = 'stg.pageView';
    const EVENT_CLICK = 'stg.click';
    const EVENT_FORM_SUBMISSION = 'stg.formSubmit';

    /**
     * @var array
     */
    protected $conditions = [];

    /**
     * @var array
     */
    protected $eventTypes = [
        TypeInterface::TYPE_PAGE_VIEW => self::EVENT_PAGE_VIEW,
        TypeInterface::TYPE_CLICK => self::EVENT_CLICK,
        TypeInterface::TYPE_FORM_SUBMISSION => self::EVENT_FORM_SUBMISSION
    ];

    /**
     * {@inheritdoc}
     */
    public function handle($data)
    {
        $this->conditions = [];

        $this->addConditionForKnownTriggerType($data);
        $this->addConditionsForAlwaysStrategy($data);

        return $this->conditions;
    }

    private function addConditionForKnownTriggerType($data)
    {
        if (!isset($this->eventTypes[$data['type']])) {
            return;
        }

        $this->conditions[] = [
            'variable' => VariableTypeInterface::TYPE_EVENT,
            'action' => TypeInterface::ACTION_EQUALS,
            'value' => $this->eventTypes[$data['type']]
        ];
    }

    /**
     * @param $data
     * @return void
     */
    private function addConditionsForAlwaysStrategy($data)
    {
        if (!isset($data['conditions']) || TypeInterface::STRATEGY_CONDITIONS !== $data['strategy']) {
            return;
        }

        foreach ($data['conditions'] as $condition) {
            $this->conditions[] = [
                'variable' => $condition['variable'],
                'action' => $condition['condition'],
                'value' => $condition['value']
            ];
        }
    }
}
