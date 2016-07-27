<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * appInstallUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appInstallUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes = array(
        'index' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'SevenTag\\InstallerBundle\\Controller\\MainController::checkEnvironmentAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'database' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'SevenTag\\InstallerBundle\\Controller\\ConfigurationController::databaseAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/configuration/database',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'configuration' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'SevenTag\\InstallerBundle\\Controller\\ConfigurationController::showAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/configuration/show',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'admin' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'SevenTag\\InstallerBundle\\Controller\\UserController::createAdminAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/create',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'start' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'SevenTag\\InstallerBundle\\Controller\\MainController::finishAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/finish',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
    );

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context, LoggerInterface $logger = null)
    {
        $this->context = $context;
        $this->logger = $logger;
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
