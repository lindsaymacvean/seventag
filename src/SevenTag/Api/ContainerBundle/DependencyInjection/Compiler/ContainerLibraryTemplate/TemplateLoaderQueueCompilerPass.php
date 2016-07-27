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

namespace SevenTag\Api\ContainerBundle\DependencyInjection\Compiler\ContainerLibraryTemplate;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class TemplateLoaderQueueCompilerPass
 * @package SevenTag\Api\ContainerBundle\DependencyInjection\Compiler\ContainerLibraryTemplate
 */
class TemplateLoaderQueueCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('seven_tag_container.container_library.template_loader')) {
            return;
        }

        $definition = $container->getDefinition('seven_tag_container.container_library.template_loader');

        $taggedServices = $container->findTaggedServiceIds(
            'seven_tag_container_library_template_loader'
        );
        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'add',
                [new Reference($id), $tags[0]['priority']]
            );
        }
    }
}
