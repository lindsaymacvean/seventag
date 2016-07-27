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
 * @name BaseController
 */
class BaseController {

    /**
     * @param {VariableResource} $variableResource
     * @param {VariableTypeResource} $typeResource
     * @param {PageInfo} PageInfo
     * @param $scope
     * @param {VariableFormProvider} $variableFormProvider
     * @param {CurrentContainer} currentContainer
     * @param {$stateParams} $stateParams
     * @param {Alert} $alert
     * @param {$state} $state
     * @param {$translate} $translate
     */
    constructor (
        $variableResource,
        $typeResource,
        $PageInfo,
        $scope,
        $variableFormProvider,
        currentContainer,
        $stateParams,
        $alert,
        $state,
        $translate,
        $condition
        ) {

        this.variable = $variableResource.getEntityObject();

        this.typeResource = $typeResource;

        $scope.$on('pageInfo.reload', (event, args) => {

            $translate([this.getBreadcrumbText()]).then((translations) => {

                $PageInfo.clear()
                    .add(args.name, 'tags', {
                        containerId: args.id
                    })
                    .add(translations[this.getBreadcrumbText()], 'variables', {
                        containerId: args.id
                    })
                    .broadcast();

            });

        });

        this.variableFormProvider = $variableFormProvider;

        this.currentContainer = currentContainer;
        this.condition = $condition;
        this.stateParams = $stateParams;
        this.alert = $alert;
        this.state = $state;
        this.translate = $translate;

        this.formTouched = false;

    }

    getVariableTypes() {

        this.typesPromise = this.typeResource.query();

        this.typesPromise.then(
                resp => {

                this.types = resp.data;

                if (this.variable.type && this.variable.type.id === undefined) {

                    for (let i = 0; i < this.types.length; i++) {
                        if (this.variable.type === this.types[i].id) {
                            this.variable.type = this.types[i];
                            this.formTouched = true;
                            break;
                        }
                    }

                }


            }
        );

    }

    /**
     * @param {VariableType} type
     */
    setVariableType (type) {

        this.variable.type = type;
        this.variable.value = '';

        this.formTouched = true;
    }

    /**
     * @returns {String} url for active type
     */
    getConfigurationTemplate () {

        let typeId = (this.variable.type.id !== undefined) ? this.variable.type.id : this.variable.type;

        return this.variableFormProvider.getType(typeId).templateUrl;

    }

    /**
     * Handle form submit action
     *
     * @param {Variable} variable
     */
    submitForm (variable) {

        this.variablePromise = variable.save(this.stateParams.containerId);

        this.variablePromise.then(
            () => {

                this.currentContainer.makeChanges();
                this.condition.refresh();
                this.alert.success(this.getAlertType());

                this.state.go('variables', {
                    containerId: this.stateParams.containerId
                });

            },
            () => {

                this.alert.error('error.invalid');

            }
        );

    }

    /**
     * Display error if form is invalid
     */
    displayInvalidFormMessage () {

        this.validateVariable = true;
        this.alert.error('error.invalid');

    }

}

export default BaseController;
