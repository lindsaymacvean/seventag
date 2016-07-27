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
use SevenTag\Api\ContainerBundle\ModeResolver\ModeResolverInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ContainersLibraryController
 * @package SevenTag\Api\ContainerBundle\Controller
 */
class ContainersLibraryController extends Controller
{
    /**
     * @ParamConverter(
     *      "container",
     *      class="SevenTagContainerBundle:Container",
     *      converter="versionable_converter"
     * )
     *
     * @Route(
     *  "/containers/tagtree/{id}.jsonp",
     *  requirements={"id" = "\d+"}
     * )
     */
    public function getContainerTagTreeAction(ContainerInterface $container)
    {
        $generator = $this->get('seven_tag_container.tag_tree_builder');
        $modeResolver = $this->get('seven_tag_container.mode_resolver');
        $variableManager = $this->get('seven_tag_variable.variable_manager');
        $request = $this->get('request');

        $response = new Response();

        $serializationContext = SerializationContext::create()->setGroups(['containerVariable']);

        $response->setContent($request->query->get('callback') . '(' . $this->get('jms_serializer')->serialize([
            'tagtree' => $generator->buildTree($container),
            'debug' => [
                'enabled' => true,
                'containerName' => $container->getName()
            ],
            'variables' => $variableManager->getVariables($container)
        ], 'json', $serializationContext) . ');');

        $response->headers->set('Content-Type', 'application/javascript');

        return $response;
    }

    /**
     * @ParamConverter(
     *      "container",
     *      class="SevenTagContainerBundle:Container",
     *      converter="previewmode_converter"
     * )
     * @Route("/containers/{id}.js", name="get_container_javascript")
     * @param ContainerInterface $container
     * @return Response
     */
    public function getContainerJavascriptAction(ContainerInterface $container)
    {
        $response = new Response();
        $response->setExpires(new \DateTime('Tue, 1 Jan 1980 00:00:00 GMT'));

        $headers = $response->headers;
        $headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $headers->set('Pragma', 'no-cache');
        $headers->set('Content-Type', 'application/javascript');

        $generator = $this->get('seven_tag_container.container_library.generator');
        $response->setContent($generator->generate(new Context($container), true));

        return $response;
    }
}
