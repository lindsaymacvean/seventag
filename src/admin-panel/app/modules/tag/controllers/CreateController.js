/**
 * Copyright (C) 2015 Digimedia Sp. z.o.o. d/b/a Clearcode
 *
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License as published by the Free
 * Software Foundation, either version 3 of the License, or (at your option) any
 * later version.
 *
 * This program is distrubuted in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

import BaseController from './BaseController.js';

/**
 * @name CreateController
 */
class CreateController extends BaseController {

    /**
     * @param {TagResource} $tagResource
     * @param {TriggerResource} $triggerResource
     * @param {VariableResource} $variableResource
     * @param {$state} $state
     * @param {$stateParams} $stateParams
     * @param {Alert} $alert
     * @param {$scope} $scope
     * @param {ngTableParams} $TableParams
     * @param {paramConverter} $paramConverter
     * @param {currentContainer} CurrentContainer
     * @param {PageInfo} PageInfo
     * @param {Templates} TemplatesStorage
     * @param {$translate} $translate
     */
    constructor (
        $tagResource,
        $triggerResource,
        $variableResource,
        $state,
        $stateParams,
        $alert,
        $scope,
        $TableParams,
        $paramConverter,
        CurrentContainer,
        PageInfo,
        TemplatesStorage,
        $translate
    ) {

        super($tagResource, $triggerResource, $variableResource, $state, $stateParams, $alert, $scope, $TableParams, $paramConverter, CurrentContainer, PageInfo, TemplatesStorage, $translate);

    }

    /**
     * Get breadcrumb text
     *
     */
    getBreadcrumbText () {

        return 'Add a new tag';

    }

    /**
     * Get alert type
     *
     */
    getAlertType () {

        return 'success.create';

    }
}

export default CreateController;
