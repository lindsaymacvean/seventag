<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
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

        if (0 === strpos($pathinfo, '/a')) {
            if (0 === strpos($pathinfo, '/api')) {
                // nelmio_api_doc_index
                if (0 === strpos($pathinfo, '/api/doc') && preg_match('#^/api/doc(?:/(?P<view>[^/]++))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_nelmio_api_doc_index;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'nelmio_api_doc_index')), array (  '_controller' => 'Nelmio\\ApiDocBundle\\Controller\\ApiDocController::indexAction',  'view' => 'default',));
                }
                not_nelmio_api_doc_index:

                // get_triggersseventag_api_triggers_get
                if (0 === strpos($pathinfo, '/api/containers') && preg_match('#^/api/containers/(?P<id>\\d+)/triggers(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_get_triggersseventag_api_triggers_get;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_triggersseventag_api_triggers_get')), array (  '_controller' => 'SevenTag\\Api\\TriggerBundle\\Controller\\TriggerRestController::getTriggersAction',  '_format' => 'json',));
                }
                not_get_triggersseventag_api_triggers_get:

                // get_trigger
                if (0 === strpos($pathinfo, '/api/triggers') && preg_match('#^/api/triggers/(?P<id>\\d+)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_get_trigger;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_trigger')), array (  '_controller' => 'SevenTag\\Api\\TriggerBundle\\Controller\\TriggerRestController::getTriggerAction',  '_format' => 'json',));
                }
                not_get_trigger:

                // post_triggerseventag_api_triggers_post
                if (0 === strpos($pathinfo, '/api/containers') && preg_match('#^/api/containers/(?P<id>\\d+)/triggers(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_post_triggerseventag_api_triggers_post;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'post_triggerseventag_api_triggers_post')), array (  '_controller' => 'SevenTag\\Api\\TriggerBundle\\Controller\\TriggerRestController::postTriggerAction',  '_format' => 'json',));
                }
                not_post_triggerseventag_api_triggers_post:

                if (0 === strpos($pathinfo, '/api/triggers')) {
                    // put_triggerseventag_api_triggers_update
                    if (preg_match('#^/api/triggers/(?P<id>\\d+)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PUT') {
                            $allow[] = 'PUT';
                            goto not_put_triggerseventag_api_triggers_update;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'put_triggerseventag_api_triggers_update')), array (  '_controller' => 'SevenTag\\Api\\TriggerBundle\\Controller\\TriggerRestController::putTriggerAction',  '_format' => 'json',));
                    }
                    not_put_triggerseventag_api_triggers_update:

                    // delete_triggerseventag_api_triggers_delete
                    if (preg_match('#^/api/triggers/(?P<id>\\d+)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_delete_triggerseventag_api_triggers_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'delete_triggerseventag_api_triggers_delete')), array (  '_controller' => 'SevenTag\\Api\\TriggerBundle\\Controller\\TriggerRestController::deleteTriggerAction',  '_format' => 'json',));
                    }
                    not_delete_triggerseventag_api_triggers_delete:

                    // post_delete_trigger_remove
                    if (preg_match('#^/api/triggers/(?P<id>\\d+)/remove(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_post_delete_trigger_remove;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'post_delete_trigger_remove')), array (  '_controller' => 'SevenTag\\Api\\TriggerBundle\\Controller\\TriggerRestController::postDeleteTriggerAction',  '_format' => 'json',));
                    }
                    not_post_delete_trigger_remove:

                }

                if (0 === strpos($pathinfo, '/api/containers')) {
                    // get_condition_types
                    if (preg_match('#^/api/containers/(?P<id>[^/]++)/conditions(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_condition_types;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_condition_types')), array (  '_controller' => 'SevenTag\\Api\\TriggerBundle\\Controller\\ConditionRestController::getConditionTypesAction',  '_format' => 'json',));
                    }
                    not_get_condition_types:

                    // get_websites
                    if (preg_match('#^/api/containers/(?P<id>[^/]++)/websites(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_websites;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_websites')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersWebsitesRestController::getWebsitesAction',  '_format' => 'json',));
                    }
                    not_get_websites:

                    // put_websites
                    if (preg_match('#^/api/containers/(?P<id>[^/]++)/websites(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PUT') {
                            $allow[] = 'PUT';
                            goto not_put_websites;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'put_websites')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersWebsitesRestController::putWebsitesAction',  '_format' => 'json',));
                    }
                    not_put_websites:

                    // publish_container_by_id
                    if (preg_match('#^/api/containers/(?P<id>\\d+)/version\\-publish(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_publish_container_by_id;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'publish_container_by_id')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersRestController::publishContainerByIdAction',  '_format' => 'json',));
                    }
                    not_publish_container_by_id:

                    // restore_container_by_id
                    if (preg_match('#^/api/containers/(?P<id>\\d+)/version\\-restore(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_restore_container_by_id;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'restore_container_by_id')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersRestController::restoreContainerByIdAction',  '_format' => 'json',));
                    }
                    not_restore_container_by_id:

                    // get_containers_by_id
                    if (preg_match('#^/api/containers/(?P<id>\\d+)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_containers_by_id;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_containers_by_id')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersRestController::getContainersByIdAction',  '_format' => 'json',));
                    }
                    not_get_containers_by_id:

                    // get_last_published_container_by_id
                    if (preg_match('#^/api/containers/(?P<id>\\d+)/version\\-published(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_last_published_container_by_id;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_last_published_container_by_id')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersRestController::getLastPublishedContainerByIdAction',  '_format' => 'json',));
                    }
                    not_get_last_published_container_by_id:

                    // put_containers
                    if (preg_match('#^/api/containers/(?P<id>\\d+)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PUT') {
                            $allow[] = 'PUT';
                            goto not_put_containers;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'put_containers')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersRestController::putContainersAction',  '_format' => 'json',));
                    }
                    not_put_containers:

                    // put_containers_permissions
                    if (preg_match('#^/api/containers/(?P<id>\\d+)/permissions(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PUT') {
                            $allow[] = 'PUT';
                            goto not_put_containers_permissions;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'put_containers_permissions')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersRestController::putContainersPermissionsAction',  '_format' => 'json',));
                    }
                    not_put_containers_permissions:

                    // get_containers_permissions
                    if (preg_match('#^/api/containers/(?P<id>\\d+)/permissions(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_containers_permissions;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_containers_permissions')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersRestController::getContainersPermissionsAction',  '_format' => 'json',));
                    }
                    not_get_containers_permissions:

                    // delete_containers
                    if (preg_match('#^/api/containers/(?P<id>\\d+)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_delete_containers;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'delete_containers')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersRestController::deleteContainersAction',  '_format' => 'json',));
                    }
                    not_delete_containers:

                    // post_delete_containers_remove
                    if (preg_match('#^/api/containers/(?P<id>\\d+)/remove(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_post_delete_containers_remove;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'post_delete_containers_remove')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersRestController::postDeleteContainersAction',  '_format' => 'json',));
                    }
                    not_post_delete_containers_remove:

                    // get_containers
                    if (preg_match('#^/api/containers(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_containers;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_containers')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersRestController::getContainersAction',  '_format' => 'json',));
                    }
                    not_get_containers:

                    // post_containers
                    if (preg_match('#^/api/containers(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_post_containers;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'post_containers')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersRestController::postContainersAction',  '_format' => 'json',));
                    }
                    not_post_containers:

                }

                if (0 === strpos($pathinfo, '/api/users')) {
                    if (0 === strpos($pathinfo, '/api/users/me')) {
                        // others_settings
                        if (0 === strpos($pathinfo, '/api/users/me/others-settings') && preg_match('#^/api/users/me/others\\-settings(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_others_settings;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'others_settings')), array (  '_controller' => 'SevenTag\\Api\\UserBundle\\Controller\\UserRestController::othersSettingsAction',  '_format' => 'json',));
                        }
                        not_others_settings:

                        // change_password
                        if (0 === strpos($pathinfo, '/api/users/me/change-password') && preg_match('#^/api/users/me/change\\-password(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_change_password;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'change_password')), array (  '_controller' => 'SevenTag\\Api\\UserBundle\\Controller\\UserRestController::changePasswordAction',  '_format' => 'json',));
                        }
                        not_change_password:

                    }

                    // reset_password_users
                    if (preg_match('#^/api/users/(?P<id>[^/]++)/reset\\-password(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_reset_password_users;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'reset_password_users')), array (  '_controller' => 'SevenTag\\Api\\UserBundle\\Controller\\UserRestController::resetPasswordUsersAction',  '_format' => 'json',));
                    }
                    not_reset_password_users:

                    if (0 === strpos($pathinfo, '/api/users/me')) {
                        // get_users_me
                        if (preg_match('#^/api/users/me(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_get_users_me;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_users_me')), array (  '_controller' => 'SevenTag\\Api\\UserBundle\\Controller\\UserRestController::getUsersMeAction',  '_format' => 'json',));
                        }
                        not_get_users_me:

                        // put_users_me
                        if (preg_match('#^/api/users/me(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_put_users_me;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'put_users_me')), array (  '_controller' => 'SevenTag\\Api\\UserBundle\\Controller\\UserRestController::putUsersMeAction',  '_format' => 'json',));
                        }
                        not_put_users_me:

                    }

                    // delete_users_remove
                    if (preg_match('#^/api/users/(?P<id>[^/]++)/remove(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_delete_users_remove;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'delete_users_remove')), array (  '_controller' => 'SevenTag\\Api\\UserBundle\\Controller\\UserRestController::deleteUsersAction',  '_format' => 'json',));
                    }
                    not_delete_users_remove:

                    // delete_users
                    if (preg_match('#^/api/users/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_delete_users;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'delete_users')), array (  '_controller' => 'SevenTag\\Api\\UserBundle\\Controller\\UserRestController::deleteUsersAction',  '_format' => 'json',));
                    }
                    not_delete_users:

                    // get_users
                    if (preg_match('#^/api/users(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_users;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_users')), array (  '_controller' => 'SevenTag\\Api\\UserBundle\\Controller\\UserRestController::getUsersAction',  '_format' => 'json',));
                    }
                    not_get_users:

                    // post_users
                    if (preg_match('#^/api/users(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_post_users;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'post_users')), array (  '_controller' => 'SevenTag\\Api\\UserBundle\\Controller\\UserRestController::postUsersAction',  '_format' => 'json',));
                    }
                    not_post_users:

                    // put_users
                    if (preg_match('#^/api/users/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PUT') {
                            $allow[] = 'PUT';
                            goto not_put_users;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'put_users')), array (  '_controller' => 'SevenTag\\Api\\UserBundle\\Controller\\UserRestController::putUsersAction',  '_format' => 'json',));
                    }
                    not_put_users:

                    // get_users_by_id
                    if (preg_match('#^/api/users/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_users_by_id;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_users_by_id')), array (  '_controller' => 'SevenTag\\Api\\UserBundle\\Controller\\UserRestController::getUsersByIdAction',  '_format' => 'json',));
                    }
                    not_get_users_by_id:

                }

                if (0 === strpos($pathinfo, '/api/reset-password')) {
                    // reset_password_token
                    if (0 === strpos($pathinfo, '/api/reset-password/token') && preg_match('#^/api/reset\\-password/token/(?P<token>[^/\\.]++)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_reset_password_token;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'reset_password_token')), array (  '_controller' => 'SevenTag\\Api\\UserBundle\\Controller\\ResettingPasswordRestController::resetPasswordTokenAction',  '_format' => 'json',));
                    }
                    not_reset_password_token:

                    // reset_password_request
                    if (0 === strpos($pathinfo, '/api/reset-password/request') && preg_match('#^/api/reset\\-password/request(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_reset_password_request;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'reset_password_request')), array (  '_controller' => 'SevenTag\\Api\\UserBundle\\Controller\\ResettingPasswordRestController::resetPasswordRequestAction',  '_format' => 'json',));
                    }
                    not_reset_password_request:

                }

                if (0 === strpos($pathinfo, '/api/tags')) {
                    // get_tags_by_id
                    if (preg_match('#^/api/tags/(?P<id>\\d+)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_tags_by_id;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_tags_by_id')), array (  '_controller' => 'SevenTag\\Api\\TagBundle\\Controller\\TagsRestController::getTagsByIdAction',  '_format' => 'json',));
                    }
                    not_get_tags_by_id:

                    // put_tags
                    if (preg_match('#^/api/tags/(?P<id>\\d+)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PUT') {
                            $allow[] = 'PUT';
                            goto not_put_tags;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'put_tags')), array (  '_controller' => 'SevenTag\\Api\\TagBundle\\Controller\\TagsRestController::putTagsAction',  '_format' => 'json',));
                    }
                    not_put_tags:

                    // delete_tags
                    if (preg_match('#^/api/tags/(?P<id>\\d+)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_delete_tags;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'delete_tags')), array (  '_controller' => 'SevenTag\\Api\\TagBundle\\Controller\\TagsRestController::deleteTagsAction',  '_format' => 'json',));
                    }
                    not_delete_tags:

                    // post_delete_tags_remove
                    if (preg_match('#^/api/tags/(?P<id>\\d+)/remove(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_post_delete_tags_remove;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'post_delete_tags_remove')), array (  '_controller' => 'SevenTag\\Api\\TagBundle\\Controller\\TagsRestController::postDeleteTagsAction',  '_format' => 'json',));
                    }
                    not_post_delete_tags_remove:

                }

                if (0 === strpos($pathinfo, '/api/containers')) {
                    // get_containers_tags
                    if (preg_match('#^/api/containers/(?P<id>\\d+)/tags(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_containers_tags;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_containers_tags')), array (  '_controller' => 'SevenTag\\Api\\TagBundle\\Controller\\TagsRestController::getContainersTagsAction',  '_format' => 'json',));
                    }
                    not_get_containers_tags:

                    // post_containers_tags
                    if (preg_match('#^/api/containers/(?P<id>\\d+)/tags(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_post_containers_tags;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'post_containers_tags')), array (  '_controller' => 'SevenTag\\Api\\TagBundle\\Controller\\TagsRestController::postContainersTagsAction',  '_format' => 'json',));
                    }
                    not_post_containers_tags:

                }

                // logout
                if (0 === strpos($pathinfo, '/api/users/me/logout') && preg_match('#^/api/users/me/logout(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_logout;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'logout')), array (  '_controller' => 'SevenTag\\Api\\SecurityBundle\\Controller\\SecurityRestController::logoutAction',  '_format' => 'json',));
                }
                not_logout:

                // token
                if (0 === strpos($pathinfo, '/api/oauth/v2/token') && preg_match('#^/api/oauth/v2/token(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_token;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'token')), array (  '_controller' => 'SevenTag\\Api\\SecurityBundle\\Controller\\TokenRestController::tokenAction',  '_format' => 'json',));
                }
                not_token:

                if (0 === strpos($pathinfo, '/api/integration')) {
                    // get_integration
                    if (preg_match('#^/api/integration/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_integration;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_integration')), array (  '_controller' => 'SevenTag\\Api\\SecurityBundle\\Controller\\IntegrationRestController::getIntegrationAction',  '_format' => 'json',));
                    }
                    not_get_integration:

                    // post_integrationseventag_api_integration_post
                    if (preg_match('#^/api/integration(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_post_integrationseventag_api_integration_post;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'post_integrationseventag_api_integration_post')), array (  '_controller' => 'SevenTag\\Api\\SecurityBundle\\Controller\\IntegrationRestController::postIntegrationAction',  '_format' => 'json',));
                    }
                    not_post_integrationseventag_api_integration_post:

                    // put_integrationseventag_api_integration_put
                    if (preg_match('#^/api/integration/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PUT') {
                            $allow[] = 'PUT';
                            goto not_put_integrationseventag_api_integration_put;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'put_integrationseventag_api_integration_put')), array (  '_controller' => 'SevenTag\\Api\\SecurityBundle\\Controller\\IntegrationRestController::putIntegrationAction',  '_format' => 'json',));
                    }
                    not_put_integrationseventag_api_integration_put:

                    // delete_integration_remove
                    if (preg_match('#^/api/integration/(?P<id>[^/]++)/remove(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_delete_integration_remove;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'delete_integration_remove')), array (  '_controller' => 'SevenTag\\Api\\SecurityBundle\\Controller\\IntegrationRestController::deleteIntegrationAction',  '_format' => 'json',));
                    }
                    not_delete_integration_remove:

                    // delete_integrationseventag_api_integration_delete
                    if (preg_match('#^/api/integration/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_delete_integrationseventag_api_integration_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'delete_integrationseventag_api_integration_delete')), array (  '_controller' => 'SevenTag\\Api\\SecurityBundle\\Controller\\IntegrationRestController::deleteIntegrationAction',  '_format' => 'json',));
                    }
                    not_delete_integrationseventag_api_integration_delete:

                    // get_integrations
                    if (preg_match('#^/api/integration(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_integrations;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_integrations')), array (  '_controller' => 'SevenTag\\Api\\SecurityBundle\\Controller\\IntegrationRestController::getIntegrationsAction',  '_format' => 'json',));
                    }
                    not_get_integrations:

                }

                if (0 === strpos($pathinfo, '/api/variables')) {
                    // get_variable
                    if (preg_match('#^/api/variables/(?P<id>\\d+)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_variable;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_variable')), array (  '_controller' => 'SevenTag\\Api\\VariableBundle\\Controller\\VariableRestController::getVariableAction',  '_format' => 'json',));
                    }
                    not_get_variable:

                    // put_variable
                    if (preg_match('#^/api/variables/(?P<id>\\d+)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PUT') {
                            $allow[] = 'PUT';
                            goto not_put_variable;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'put_variable')), array (  '_controller' => 'SevenTag\\Api\\VariableBundle\\Controller\\VariableRestController::putVariableAction',  '_format' => 'json',));
                    }
                    not_put_variable:

                    // delete_variable
                    if (preg_match('#^/api/variables/(?P<id>\\d+)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_delete_variable;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'delete_variable')), array (  '_controller' => 'SevenTag\\Api\\VariableBundle\\Controller\\VariableRestController::deleteVariableAction',  '_format' => 'json',));
                    }
                    not_delete_variable:

                    // post_delete_variable_remove
                    if (preg_match('#^/api/variables/(?P<id>[^/]++)/remove(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_post_delete_variable_remove;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'post_delete_variable_remove')), array (  '_controller' => 'SevenTag\\Api\\VariableBundle\\Controller\\VariableRestController::postDeleteVariableAction',  '_format' => 'json',));
                    }
                    not_post_delete_variable_remove:

                }

                if (0 === strpos($pathinfo, '/api/containers')) {
                    // post_variable_for_container
                    if (preg_match('#^/api/containers/(?P<id>\\d+)/variables(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_post_variable_for_container;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'post_variable_for_container')), array (  '_controller' => 'SevenTag\\Api\\VariableBundle\\Controller\\VariableRestController::postVariableForContainerAction',  '_format' => 'json',));
                    }
                    not_post_variable_for_container:

                    // get_containers_variables
                    if (preg_match('#^/api/containers/(?P<id>\\d+)/variables(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_containers_variables;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_containers_variables')), array (  '_controller' => 'SevenTag\\Api\\VariableBundle\\Controller\\VariableRestController::getContainersVariablesAction',  '_format' => 'json',));
                    }
                    not_get_containers_variables:

                    // get_containers_available_variables
                    if (preg_match('#^/api/containers/(?P<id>\\d+)/available\\-variables(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_containers_available_variables;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_containers_available_variables')), array (  '_controller' => 'SevenTag\\Api\\VariableBundle\\Controller\\VariableRestController::getContainersAvailableVariablesAction',  '_format' => 'json',));
                    }
                    not_get_containers_available_variables:

                }

                // get_variables_types
                if (0 === strpos($pathinfo, '/api/variable-types') && preg_match('#^/api/variable\\-types(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_get_variables_types;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_variables_types')), array (  '_controller' => 'SevenTag\\Api\\VariableBundle\\Controller\\VariableTypeRestController::getVariablesTypesAction',  '_format' => 'json',));
                }
                not_get_variables_types:

            }

            // seventag_api_app_admintools_update
            if ($pathinfo === '/admin-tools/update') {
                return array (  '_controller' => 'SevenTag\\Api\\AppBundle\\Controller\\AdminToolsController::updateAction',  '_route' => 'seventag_api_app_admintools_update',);
            }

            // fos_oauth_server_token
            if ($pathinfo === '/api/oauth/v2/token') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fos_oauth_server_token;
                }

                return array (  '_controller' => 'fos_oauth_server.controller.token:tokenAction',  '_route' => 'fos_oauth_server_token',);
            }
            not_fos_oauth_server_token:

        }

        // fos_reset_password
        if (0 === strpos($pathinfo, '/reset') && preg_match('#^/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_reset_password')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',));
        }

        // fos_oauth_server_authorize
        if ($pathinfo === '/api/oauth/v2/auth') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_fos_oauth_server_authorize;
            }

            return array (  '_controller' => 'FOS\\OAuthServerBundle\\Controller\\AuthorizeController::authorizeAction',  '_route' => 'fos_oauth_server_authorize',);
        }
        not_fos_oauth_server_authorize:

        if (0 === strpos($pathinfo, '/containers')) {
            // seventag_api_container_containerslibrary_getcontainertagtree
            if (0 === strpos($pathinfo, '/containers/tagtree') && preg_match('#^/containers/tagtree/(?P<id>\\d+)\\.jsonp$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'seventag_api_container_containerslibrary_getcontainertagtree')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersLibraryController::getContainerTagTreeAction',));
            }

            // get_container_javascript
            if (preg_match('#^/containers/(?P<id>[^/\\.]++)\\.js$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_container_javascript')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersLibraryController::getContainerJavascriptAction',));
            }

            // get_privacy_optout_snippet
            if (preg_match('#^/containers/(?P<id>\\d+)/privacy$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_privacy_optout_snippet')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersPrivacyController::getPrivacyOptOutSnippetAction',));
            }

            // get_privacy_optout_iframe
            if (preg_match('#^/containers/(?P<id>\\d+)/privacy\\-script\\.js$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_privacy_optout_iframe')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersPrivacyController::getPrivacyOptOutIframeAction',));
            }

            // get_no_script
            if (preg_match('#^/containers/(?P<id>\\d+)/noscript\\.html(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_no_script;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_no_script')), array (  '_controller' => 'SevenTag\\Api\\ContainerBundle\\Controller\\ContainersNoScriptController::getNoScriptAction',  '_format' => 'json',));
            }
            not_get_no_script:

        }

        if (0 === strpos($pathinfo, '/api/translations')) {
            // index
            if (preg_match('#^/api/translations(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_index;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'index')), array (  '_controller' => 'SevenTag\\Api\\AppBundle\\Controller\\TranslationsController::indexAction',  '_format' => 'json',));
            }
            not_index:

            // get
            if (preg_match('#^/api/translations/(?P<lang>[^/\\.]++)(?:\\.(?P<_format>json|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'get')), array (  '_controller' => 'SevenTag\\Api\\AppBundle\\Controller\\TranslationsController::getAction',  '_format' => 'json',));
            }
            not_get:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
