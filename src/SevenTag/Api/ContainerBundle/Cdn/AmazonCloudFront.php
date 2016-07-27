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

use Aws\CloudFront\CloudFrontClient;
use SevenTag\Component\Container\Model\ContainerInterface;

/**
 * Class AmazonCloudFront
 * @package SevenTag\Api\ContainerBundle\Cdn
 */
class AmazonCloudFront implements CdnInterface
{
    /**
     * @var CloudFrontClient
     */
    private $client;

    /**
     * @var array
     */
    private $distributions;

    /**
     * @param CloudFrontClient $client
     * @param array $distributions
     */
    public function __construct(CloudFrontClient $client, array $distributions)
    {
        $this->client = $client;
        $this->distributions = $distributions;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function invalidate(ContainerInterface $container)
    {
        foreach ($this->distributions as $distributionId) {
            $this->client->createInvalidation(
                [
                    'DistributionId' => $distributionId,
                    'Paths' => [
                        'Quantity' => 1,
                        'Items' => [sprintf('/containers/%s.js', $container->getAccessId())],
                    ],
                    'CallerReference' => sha1(uniqid(mt_rand(), true))
                ]
            );
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getKey()
    {
        return 'amazon_cloudfront';
    }
}
