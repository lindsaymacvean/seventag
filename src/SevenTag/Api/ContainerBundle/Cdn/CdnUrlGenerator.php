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

namespace SevenTag\Api\ContainerBundle\Cdn;

use SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Context;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RequestContext;

class CdnUrlGenerator implements UrlGeneratorInterface
{
    const JAVASCRIPT_ROUTE = 'get_container_javascript';
    const NO_SCRIPT_ROUTE = 'get_no_script';

    /**
     * @var string
     */
    private $seventagJavascriptUrlTemplate;

    /**
     * @var Context
     */
    private $context;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * CdnUrlGenerator constructor.
     * @param UrlGeneratorInterface $urlGenerator
     * @param string $seventagJavascriptUrlTemplate
     */
    public function __construct(UrlGeneratorInterface $urlGenerator, $seventagJavascriptUrlTemplate)
    {
        $this->urlGenerator = $urlGenerator;
        $this->seventagJavascriptUrlTemplate = $seventagJavascriptUrlTemplate;
    }

    /**
     * {@inheritdoc}
     */
    public function setContext(RequestContext $context)
    {
        $this->context = $context;
    }

    /**
     * {@inheritdoc}
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @parent
     */
    public function generate($name, $parameters = [], $referenceType = self::ABSOLUTE_PATH)
    {
        if (self::JAVASCRIPT_ROUTE === $name) {
            if (!isset($parameters['id']) || empty($parameters['id'])) {
                throw new MissingMandatoryParametersException(sprintf('id parameters is mandatory.'));
            }

            return strtr($this->seventagJavascriptUrlTemplate, [
                '@id@' => $parameters['id']
            ]);
        }

        if (self::NO_SCRIPT_ROUTE === $name) {
            return $this->urlGenerator->generate($name, $parameters, $referenceType);
        }

        throw new InvalidParameterException(
            sprintf(
                '%s might be used only to %s routes.',
                get_class($this),
                implode(',', [self::JAVASCRIPT_ROUTE, self::NO_SCRIPT_ROUTE])
            )
        );
    }
}
