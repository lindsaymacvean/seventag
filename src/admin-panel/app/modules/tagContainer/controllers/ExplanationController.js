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

/**
 * @type {$stateParams}
 */
var stateParams;

/**
 * @type {String}
 * @readOnly
 */
var PAGE_TITLE = 'Container created successfully';

/**
 * @name ExplanationController
 */
class ExplanationController {

    /**
     * @param {ContainerResource} containerResource
     * @param {$stateParams} $stateParams
     * @param {PageInfo} PageInfo
     * @param {CurrentContainer} CurrentContainer
     * @param {$translate} $translate
     */
    constructor (
        containerResource,
        $stateParams,
        PageInfo,
        CurrentContainer,
        $translate
    ) {

        CurrentContainer.makeChanges();

        this.translate = $translate;

        this
            .translate([PAGE_TITLE])
            .then((translations) => {

                PageInfo.clear()
                    .add(translations[PAGE_TITLE])
                    .broadcast();

            });

        stateParams = $stateParams;
        this.container = containerResource.getEntityObject();

        this.containerPromise = containerResource.get(stateParams.containerId);

        this.containerPromise.then((resp) => {

            this.container = resp;

        });

    }

}

export default ExplanationController;
