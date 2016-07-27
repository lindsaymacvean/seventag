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
 * @type {$state}
 */
var state;

/**
 * @type {Alert}
 */
var $alert;

/**
 * @type {String}
 */
const BREADCRUMB_TEXT = 'Add a container';

/**
 * @name CreateController
 */
class CreateController {

    /**
     * @param {ContainerResource} containerResource
     * @param {$state} $state
     * @param {Alert} alert
     * @param {PageInfo} PageInfo
     * @param {$translate} $translate
     */
    constructor (containerResource, $state, alert, PageInfo, $translate) {

        this.container = containerResource.getEntityObject();

        state = $state;

        $alert = alert;

        this.translate = $translate;

        this
            .translate([BREADCRUMB_TEXT])
            .then((translations) => {

                PageInfo.clear()
                    .add(translations[BREADCRUMB_TEXT])
                    .broadcast();

            });

    }

    submitForm (container) {

        this.containerPromise = container.save();

        this.containerPromise.then(
            (resp) => {

                $alert.success('container.create');

                state.go('containerExplanation', {containerId: resp.id});

            },
            () => {

                $alert.error('error.invalid');

            }
        );

    }

    /**
     * Display error if form is invalid
     */
    displayInvalidFormMessage () {

        this.validateContainer = true;
        $alert.error('error.invalid');

    }

}

export default CreateController;
