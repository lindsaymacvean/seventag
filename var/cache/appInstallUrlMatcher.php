<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appInstallUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appInstallUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // index
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'index');
            }

            return array (  '_controller' => 'SevenTag\\InstallerBundle\\Controller\\MainController::checkEnvironmentAction',  '_route' => 'index',);
        }

        if (0 === strpos($pathinfo, '/configuration')) {
            // database
            if ($pathinfo === '/configuration/database') {
                return array (  '_controller' => 'SevenTag\\InstallerBundle\\Controller\\ConfigurationController::databaseAction',  '_route' => 'database',);
            }

            // configuration
            if ($pathinfo === '/configuration/show') {
                return array (  '_controller' => 'SevenTag\\InstallerBundle\\Controller\\ConfigurationController::showAction',  '_route' => 'configuration',);
            }

        }

        // admin
        if ($pathinfo === '/admin/create') {
            return array (  '_controller' => 'SevenTag\\InstallerBundle\\Controller\\UserController::createAdminAction',  '_route' => 'admin',);
        }

        // start
        if ($pathinfo === '/finish') {
            return array (  '_controller' => 'SevenTag\\InstallerBundle\\Controller\\MainController::finishAction',  '_route' => 'start',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
