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
'use strict';

(function (sevenTag, MODULE_NAME) {

    // TODO: {@link https://jira.clearcode.cc/browse/TM-1097} Tags Handler has too many responsibilities need to be split to services
    var TagsHandler = function (Element, $utils, $variablesManager, $resolver, $debugger, $renderer, DELAY) {

        var delayCallback = function (enableDelay, dataLayer) {

            if (enableDelay) {

                $utils.timeout(
                    dataLayer.eventCallback,
                    parseInt(dataLayer.eventCallbackTimeout === undefined ? DELAY : dataLayer.eventCallbackTimeout)
                );

                return;

            }

            dataLayer.eventCallback();
        };

        this.handle = function (tagTree, dataLayer) {

            var bodyElement = new Element(document.body),
                hasClickEventAttached,
                hasSubmitEventAttached,
                hasHrefAttribute,
                element;

            for (; dataLayer.length > 0;) {

                var state = {}, contextId = $utils.guid();

                state.dataLayer = dataLayer.shift();

                var variableCollection = $variablesManager.handle(state, contextId);

                var tags = $resolver.resolve(tagTree, variableCollection);

                $debugger.push({
                    'dataLayerElement': $utils.clone(state.dataLayer),
                    'variableCollection': $utils.clone(variableCollection),
                    'tags': $utils.clone(tags)
                });

                $debugger.debug();

                var enableDelay = false;

                for (var tagIdx in tags) {

                    if (tags[tagIdx].resolved) {

                        if ($debugger.isEnabled() && tags[tagIdx].disableInDebugMode) {

                            continue;

                        }

                        enableDelay = true;
                        $renderer.render(bodyElement, tags[tagIdx], variableCollection, contextId);

                    }
                }

                if (state.dataLayer.eventCallback !== undefined) {

                    if ($debugger.breakpoints.isEnabled()) {

                        continue;

                    }

                    element = state.dataLayer.element;
                    hasClickEventAttached = (element.onclick !== undefined) ? element.onclick !== null : false;
                    hasSubmitEventAttached = (element.onclick !== undefined) ? element.onsubmit !== null : false;
                    hasHrefAttribute = element.href !== "";

                    if (
                        hasHrefAttribute ||
                        (hasClickEventAttached && hasSubmitEventAttached)
                    ) {

                        delayCallback(enableDelay, state.dataLayer);

                    }

                }

            }
        };

        return this;
    };

    TagsHandler.$inject = [
        'Element',
        '$utils',
        '$variablesManager',
        '$resolver',
        '$debugger',
        '$renderer',
        'DELAY'
    ];

    sevenTag.service(MODULE_NAME, TagsHandler);

})(window.sevenTag, '$tagsHandler');
