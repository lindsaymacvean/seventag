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
 * @type {ContainerResource}
 */
var $containerResource;

/**
 * @type {Alert}
 */
var alert;

/**
 * @type {$state}
 */
var state;

/**
 * @type {$rootScope}
 */
var rootScope;

/**
 * @type {$cookiesProvider}
 */
var cookies;

/**
 * @readonly
 * @type {String}
 */
var PREVIEW_KEY = 'preview';

/**
 * @readonly
 * @type {String}
 */
var DEBUG_KEY = 'debug';

/**
 * @type {ConditionResource}
 */
var conditionResource;


/**
 * Convert params for request
 *
 * @name CurrentContainer
 */
class CurrentContainer {
    /**
     * @param {$stateParams} $stateParams
     * @param {ContainerResource} containerResource
     * @param {Alert} $alert
     * @param {$state} $state
     * @param {$rootScope} $rootScope
     * @param {$cookiesProvider} $cookies
     * @param {ConditionResource} $conditionResource
     * @param {$translate} $translate
     */
    constructor (
        $stateParams,
        containerResource,
        $alert,
        $state,
        $rootScope,
        $cookies,
        $conditionResource,
        $translate
    ) {

        stateParams = $stateParams;
        $containerResource = containerResource;
        alert = $alert;
        state = $state;
        rootScope = $rootScope;
        this.$container = undefined;
        cookies = $cookies;

        this.types = undefined;
        this.debugMode = false;
        this.previewedContainer = undefined;
        this.translate = $translate;
        conditionResource = $conditionResource;

    }

    /**
     * @param {number} containerId
     *
     * @returns {deferred.promise} promise of get current container
     */
    get (containerId) {

        containerId = this.getId(containerId);
        rootScope.currentContainerLoading = true;

        this.containerPromise = $containerResource.get(containerId).then(
            (resp) => {

                this.$container = resp;
                rootScope.currentContainerLoading = false;

                this.verifyDebugMode();

                if (this.types === undefined) {

                    this.types = this.setTypes();

                }

                return this.$container;

            }
        );

        return this.containerPromise;

    }

    /**
     * Get id of current container
     *
     * @param {number} containerId
     * @returns {number}
     */
    getId (containerId) {

        return containerId !== undefined ? containerId : stateParams.containerId;

    }


    /**
     * Get container inside promise
     */
    getContainer () {

        if (this.containerPromise === undefined) {

            return this.get();

        } else {

            return this.containerPromise;

        }

    }

    /**
     * Publish current container
     */
    publish () {

        var self = this,
            publishPromise = $containerResource.publishVersion(this.getId());

        rootScope.currentContainerLoading = true;

        return publishPromise.then(
            () => {

                alert.success('success.publish');
                self.get();
                rootScope.currentContainerLoading = false;

            },
            () => {

                alert.error('container.error');
                rootScope.currentContainerLoading = false;

            }
        );

    }

    /**
     * Check restore ability
     *
     * @returns {boolean}
     */
    canRestore () {

        var container = this.$container;

        if (container) {

            return container.publishedAt && container.hasUnpublishedChanges === true;

        }

        return false;

    }
    
    /**
     * Check if the container has unpublished changes
     *
     * @returns {boolean}
     */
    isDirty () {

        var container = this.$container;

        return container && container.hasUnpublishedChanges;

    }

    /**
     * Check publish status
     *
     * @returns {boolean}
     */
    isPublished () {

        var container = this.$container;

        if (container) {

            return container.publishedAt && container.hasUnpublishedChanges === false;

        }

        return false;

    }

    /**
     * Set Container unpublished changes to true
     *
     * @returns {boolean}
     */
    makeChanges () {

        var container = this.$container;

        if (container) {

            container.hasUnpublishedChanges = true;
            return true;

        }

    }

    /**
     * Dischard draft changes to latest published version
     */
    restore () {

        var self = this;

        var restorePromise = $containerResource.restoreVersion(this.getId());

        rootScope.currentContainerLoading = true;

        restorePromise.then(
            function () {

                alert.success('success.restore');

                self.get();

                if (state.includes('tags') || state.includes('tagEdit') || state.includes('tagCreate')) {

                    state.go('tags', {containerId: self.getId()}, {reload: true});

                } else if (
                    state.includes('triggers') ||
                    state.includes('triggerCreate') ||
                    state.includes('triggerEdit')
                ) {

                    state.go('triggers', {containerId: self.getId()}, {reload: true});

                } else {

                    state.go('containerEdit', {containerId: self.getId()}, {reload: true});

                }

                rootScope.currentContainerLoading = false;

            },
            function () {

                alert.error('container.error');

            }
        );

    }

    verifyDebugMode () {

        if (this.isDebugModeEnabled()) {

            let cookiesDebug = cookies.get(DEBUG_KEY);

            if (cookiesDebug === this.$container.id) {

                this.debugMode = true;
                this.previewedContainer = this.$container;
                var self = this;

                this
                    .translate(['Now Previewing'])
                    .then((translations) => {

                        self.previewedContainerText = translations['Now Previewing'];

                    });

            } else {

                this.disableDebugMode();

            }

        }

    }

    isDebugModeEnabled () {

        let cookiesDebug = cookies.get(DEBUG_KEY);
        let cookiesPreview = cookies.get(PREVIEW_KEY);

        return cookiesDebug !== undefined && cookiesPreview !== undefined && cookiesDebug === cookiesPreview;

    }

    /**
     * Set debug mode
     */
    enableDebugMode () {

        this.debugMode = true;
        this.previewedContainer = this.$container;
        var self = this;

        this
            .translate(['Now Previewing'])
            .then((translations) => {

                self.previewedContainerText = translations['Now Previewing'];

            });

        cookies.put(PREVIEW_KEY, this.$container.id);
        cookies.put(DEBUG_KEY, this.$container.id);

    }

    /**
     * Leave debug mode
     */
    disableDebugMode () {

        this.debugMode = false;
        this.previewedContainer = undefined;

        cookies.remove(PREVIEW_KEY);
        cookies.remove(DEBUG_KEY);

    }

    setTypes () {

        return conditionResource.query(this.getId()).then(
            (resp) => {

                let respIndex = resp.length,
                    mapped = [];

                while (respIndex--) {

                    mapped[respIndex] = {
                        name: resp[respIndex].name,
                        type: resp[respIndex].type
                    };

                }

                return mapped;

            }
        );

    }

    hasPermission (permission) {

        return this.getContainer().then((container) => {

            return container.hasPermission(permission);

        });

    }
}

export default CurrentContainer;
