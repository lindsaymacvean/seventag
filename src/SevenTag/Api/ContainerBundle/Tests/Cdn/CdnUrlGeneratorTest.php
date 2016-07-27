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

namespace SevenTag\Api\ContainerBundle\Tests\Cdn;

use Prophecy\Argument;
use SevenTag\Api\ContainerBundle\Cdn\CdnUrlGenerator;

class CdnUrlGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itShouldGenerateContainerUrlFromTemplateForCDN()
    {
        $urlGenerator = $this->prophesize('Symfony\Component\Routing\Generator\UrlGeneratorInterface');

        $cdnUrlGenerator = new CdnUrlGenerator(
            $urlGenerator->reveal(),
            '//yourcdnhostname.com/containers/@id@.js'
        );

        $this->assertEquals('//yourcdnhostname.com/containers/44.js', $cdnUrlGenerator->generate(CdnUrlGenerator::JAVASCRIPT_ROUTE, ['id' => 44]));
    }

    /**
     * @test
     */
    public function itShouldGenerateContainerNoScriptUrl()
    {
        $urlGenerator = $this->prophesize('Symfony\Component\Routing\Generator\UrlGeneratorInterface');
        $urlGenerator->generate(CdnUrlGenerator::NO_SCRIPT_ROUTE, ["id" => 44], false)
            ->shouldBeCalled()
            ->willReturn('//yourcdnhostname.com/containers/44/noscript.html');

        $cdnUrlGenerator = new CdnUrlGenerator(
            $urlGenerator->reveal(),
            '//yourcdnhostname.com/containers/@id@.js'
        );

        $this->assertEquals('//yourcdnhostname.com/containers/44/noscript.html', $cdnUrlGenerator->generate(CdnUrlGenerator::NO_SCRIPT_ROUTE, ['id' => 44]));
    }

    /**
     * @test
     * @expectedException \Symfony\Component\Routing\Exception\InvalidParameterException
     */
    public function itShouldThrowExceptionForNonContainerRoutes()
    {
        $urlGenerator = $this->prophesize('Symfony\Component\Routing\Generator\UrlGeneratorInterface');

        $cdnUrlGenerator = new CdnUrlGenerator(
            $urlGenerator->reveal(),
            '//yourcdnhostname.com/containers/@id@.js'
        );

        $this->assertEquals(
            '//yourcdnhostname.com/containers/44.js',
            $cdnUrlGenerator->generate('seventag_api_container_containerslibrary_getcontainertagtree', ['id' => 44])
        );
    }

    /**
     * @test
     * @expectedException \Symfony\Component\Routing\Exception\MissingMandatoryParametersException
     */
    public function itShouldThrowExceptionIfMandatoryParameterDoesNotExists()
    {
        $urlGenerator = $this->prophesize('Symfony\Component\Routing\Generator\UrlGeneratorInterface');

        $cdnUrlGenerator = new CdnUrlGenerator(
            $urlGenerator->reveal(),
            '//yourcdnhostname.com/containers/@id@.js'
        );

        $this->assertEquals('//yourcdnhostname.com/containers/44/noscript.html', $cdnUrlGenerator->generate(CdnUrlGenerator::JAVASCRIPT_ROUTE));
    }
}
