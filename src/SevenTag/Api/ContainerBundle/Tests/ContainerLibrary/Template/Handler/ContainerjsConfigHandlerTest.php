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

namespace SevenTag\Api\ContainerBundle\Tests\ContainerLibrary\Template\Handler;

use Prophecy\Argument;
use SevenTag\Api\AppBundle\Plugin\ManifestContainerjsCodeProvider;
use SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Handler\ContainerjsConfigHandler;
use SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Context;

/**
 * Class ContainerjsConfigHandlerTest
 * @package SevenTag\Api\ContainerBundle\Tests\ContainerLibrary\Template\Handler
 */
class ContainerjsConfigHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itShouldHandleContentFromContainerjsConfigFiles()
    {
        $handler = new ContainerjsConfigHandler($this->getManifestContainerjsCodeProviderMock());
        $handler->handle($this->getContextMock());
    }

    /**
     * @return ManifestContainerjsCodeProvider
     */
    private function getManifestContainerjsCodeProviderMock()
    {
        $provider = $this->prophesize('SevenTag\Api\AppBundle\Plugin\ManifestContainerjsCodeProvider');
        $provider->getCodeFromManifests()->willReturn('console.log(1);console.log(2)');

        return $provider->reveal();
    }

    /**
     * @return Context
     */
    private function getContextMock()
    {
        $context = $this->prophesize('SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Context');
        $context->getContent()->willReturn('(function(sevenTag){##containerJsConfig##}(window.sevenTag));');
        $context->setContent(Argument::any())->shouldBeCalled();

        return $context->reveal();
    }
}
