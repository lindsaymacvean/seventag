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
     * @param {Templates} templatesStorage
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
        templatesStorage,
        $translate
    ) {
        const BREADCRUMB_GLOBAL = 'Tags';

        this.alert = $alert;
        this.state = $state;
        this.stateParams = $stateParams;
        this.triggerResource = $triggerResource;
        this.TableParams = $TableParams;
        this.paramConverter = $paramConverter;
        this.currentContainer = CurrentContainer;

        this.tag = $tagResource.getEntityObject();

        this.tagPromise = undefined;

        this.triggers = [];
        this.chosenTriggers = [];
        this.triggerPromise = undefined;
        this.formTouched = false;
        this.templatesStorage = templatesStorage;
        this.templates = templatesStorage.getAll();
        this.template = undefined;
        this.translate = $translate;
        this.variables = [];

        this.textEditorConfig = {};
        this.isCodeEditorFocused = false;

        $variableResource.queryAllAvailable(this.stateParams.containerId).then( resp => {

            this.variables = resp.data;

        });

        this.textEditorConfig.onLoad = cm => {

            cm.options.variables = this.variables;

            $scope.insertVariableIntoCode = variable => {

                cm.doc.replaceSelection(`{{ ${variable.name} }}`);

                cm.focus();

            };

            cm.on('focus', () => {

                this.isCodeEditorFocused = true;

            });

            cm.on('blur', () => {

                this.isCodeEditorFocused = false;

            });

        };

        $scope.$on('trigger.add', (event, resp) => {

            this.tag.addTrigger(resp);
            this.showTriggerForm = false;
            this.validateTriggers = false;

        });

        $scope.$on('trigger.edit', (event, resp) => {

            this.tag.editTrigger(resp);
            this.editTriggerForm = false;
            this.validateTriggers = false;

        });

        this.translate(['Place the code']).then((translations) => {

            this.textEditorConfig.placeholder = translations['Place the code'];

        });

        this.currentContainer.getContainer().then(() => {

            if (this.currentContainer.$container.hasPermission('noaccess')) {

                $state.go('container');

            }

            this
                .translate([this.getBreadcrumbText(), BREADCRUMB_GLOBAL])
                .then((translations) => {

                    PageInfo.clear()
                        .add(this.currentContainer.$container.name, 'tags', {
                            containerId: this.currentContainer.$container.id
                        })
                        .add(translations[BREADCRUMB_GLOBAL], 'tags', {
                            containerId: this.currentContainer.$container.id
                        })
                        .add(translations[this.getBreadcrumbText()])
                        .broadcast();

                });

        });

        $scope.$on('pageInfo.reload', (event, args) => {

            this
                .translate([this.getBreadcrumbText(), BREADCRUMB_GLOBAL])
                .then((translations) => {

                    PageInfo.clear()
                        .add(args.name, 'tags', {
                            containerId: args.id
                        })
                        .add(translations[BREADCRUMB_GLOBAL], 'tags', {
                            containerId: args.id
                        })
                        .add(translations[this.getBreadcrumbText()])
                        .broadcast();

                });

        });

    }

    hasVariables () {

        return angular.isArray(this.variables) && this.variables.length > 0;

    }

    /**
     *
     * @param {string} id
     */
    setTagTemplate (id) {

        if (this.tag.template === id) {

            this.template = undefined;
            this.tag.template = null;
            this.formTouched = false;

            return false;

        }

        this.tag.template = id;

        if (this.tag.template) {

            this.template = this.templatesStorage.get(id);
            this.tag.code = undefined;

            if (this.template.types.length === 0) {

                this.setTemplateType(id);


            } else {

                this.formTouched = false;

            }

        } else {

            this.formTouched = true;

        }

    }

    /**
     * @param {string} id
     * @param {object} options
     */
    initTagTemplate (id, options) {

        this.tag.template = id;

        if (this.tag.template) {

            this.template = this.templatesStorage.get(id);
            this.tag.code = undefined;

            if (this.template.types.length === 0) {

                this.templateFields = this.templatesStorage.getOptions(id);
                this.template.templateUrl = this.templatesStorage.getTemplateUrl(id);
                this.tag.templateOptions = options;

            } else {

                this.templateFields = this.templatesStorage.getOptions(id, options.type);
                this.tag.templateOptions.type = options.type;
                this.template.templateUrl = this.templatesStorage.getTemplateUrl(id, options.type);

            }

        }

        this.formTouched = true;

    }

    setTemplateType (id, type) {

        if (this.tag.templateOptions.type !== undefined && this.tag.templateOptions.type === type) {

            return false;

        }

        this.templateFields = this.templatesStorage.getOptions(id, type);

        this.setOptions();
        this.tag.templateOptions.type = type;
        this.template.templateUrl = this.templatesStorage.getTemplateUrl(id, type);

        this.formTouched = true;

    }

    setOptions () {

        let fieldsLength = this.templateFields.length;

        this.tag.templateOptions = {};

        while (fieldsLength--) {

            this.tag.templateOptions[this.templateFields[fieldsLength].name] = this.templateFields[fieldsLength].hasOwnProperty('value') ?
                this.templateFields[fieldsLength].value : undefined;

        }

    }

    /**
     * @desc Show existing triggers
     */
    showExistingTriggers () {

        this.chosenTriggers = [];
        this.prepareExistingTriggersList();
        this.showListTriggersForm = true;

    }

    /**
     * @desc Prepare existing triggers list
     */
    prepareExistingTriggersList () {

        this.triggers = [];

        this.types = [
            'Page View',
            'Click',
            'Event',
            'Form submission'
        ];

        this.existingTable = new this.TableParams({
            page: 1,
            count: 10,
            sorting: {
                name: 'asc'
            }
        }, {
            total: 0,
            getData: ($defer, params) => {

                var parameters = this.paramConverter.list(params.url());

                parameters['exclude[]'] = this.tag.triggers.map(trigger => trigger.id);

                this.triggerResource.query(this.currentContainer.$container.id, parameters).then(
                    (resp) => {

                        params.total(resp.total);
                        $defer.resolve(resp.data);

                    }
                );

            }
        });

    }

    /**
     * @desc Function provides adding existing triggers
     */
    addExistingTriggers () {

        var chosenLength = this.chosenTriggers.length;

        while (chosenLength--) {

            this.tag.triggers.push(this.chosenTriggers[chosenLength]);

        }

    }

    submitForm (tag) {

        this.tagPromise = tag.save(this.stateParams.containerId);

        this.tagPromise.then(
            () => {

                this.alert.success(this.getAlertType(this.stateParams.tagId));

                this.currentContainer.makeChanges();

                this.state.go('tags', {containerId: this.stateParams.containerId});

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

        this.validateTag = true;
        this.alert.error('error.invalid');

    }

}

export default BaseController;
