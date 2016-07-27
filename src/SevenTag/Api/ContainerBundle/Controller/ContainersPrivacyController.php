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

namespace SevenTag\Api\ContainerBundle\Controller;

use JMS\Serializer\SerializationContext;
use SevenTag\Component\Container\Model\ContainerInterface;
use SevenTag\Api\ContainerBundle\ContainerLibrary\Template\Context;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ContainersPrivacyController
 * @package SevenTag\Api\ContainerBundle\Controller
 */
class ContainersPrivacyController extends Controller
{
    /**
     * @ParamConverter(
     *      "container",
     *      class="SevenTagContainerBundle:Container",
     *      converter="versionable_converter"
     * )
     *
     * @Route(
     *  "/containers/{id}/privacy",
     *  name="get_privacy_optout_snippet",
     *  requirements={"id" = "\d+"}
     * )
     */
    public function getPrivacyOptOutSnippetAction(ContainerInterface $container)
    {
        $code = $this->get('seven_tag_container.privacy.code_provider.snippet');

        return new JsonResponse([
            'code' => $code->getCode($container)
        ]);
    }

    /**
     * @ParamConverter(
     *      "container",
     *      class="SevenTagContainerBundle:Container",
     *      converter="versionable_converter"
     * )
     *
     * @Route(
     *  "/containers/{id}/privacy-script.js",
     *  name="get_privacy_optout_iframe",
     *  requirements={"id" = "\d+", "_format" = "js"}
     * )
     */
    public function getPrivacyOptOutIframeAction(ContainerInterface $container)
    {
        $response = $this->render('SevenTagContainerBundle:privacy:script.js.twig', [
            'container' => $container
        ]);
        $response->headers->set('Content-Type', 'text/javascript');

        return $response;
    }
}
