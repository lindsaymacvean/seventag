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

namespace SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Handler;

use SevenTag\Api\AppBundle\Plugin\ManifestContainerjsCodeProvider;
use SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Context;

/**
 * Class ContainerjsConfigHandler
 * @package SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Handler
 */
class ContainerjsConfigHandler implements HandlerInterface
{
    /**
     * @var ManifestContainerjsCodeProvider
     */
    private $manifestContainerjsCodeProvider;

    /**
     * @param ManifestContainerjsCodeProvider $manifestContainerjsCodeProvider
     */
    public function __construct(ManifestContainerjsCodeProvider $manifestContainerjsCodeProvider)
    {
        $this->manifestContainerjsCodeProvider = $manifestContainerjsCodeProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Context $context)
    {
        $content =  str_replace(
            '##containerJsConfig##',
            $this->manifestContainerjsCodeProvider->getCodeFromManifests(),
            $context->getContent()
        );

        $context->setContent($content);
    }
}
