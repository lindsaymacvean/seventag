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

(function(sevenTag, MODULE_NAME) {

    var ListenersHandler = function (Element, $eventHandler, $utils, $documentElement, $callbackFactory) {

        var touchStarted= false,
            currX = 0,
            currY = 0,
            cachedX = 0,
            cachedY = 0,
            pointer = {};

        var getPointer = function (event) {

            return event.targetTouches ? event.targetTouches[0] : event;

        };

        var getTargetElement = function (event) {

            return typeof event.target !== 'undefined' ? event.target : event.srcElement;

        };

        this.handle = function(dataLayer) {

            $eventHandler.addListener('click', $documentElement, function (event) {

                var target = getTargetElement(event);

                // TODO: need to move this to global event handler in element
                if ( !event.which && target !== undefined ) {
                    event.which = ( target && 1 ? 1 : ( target && 2 ? 3 : ( target && 4 ? 2 : 0 ) ) );
                }

                if (event.which === 1) {

                    dataLayer.push({
                        'event': 'stg.click',
                        'eventCallback': $callbackFactory.get('click', event),
                        'element': target,
                        'elementId': target.id,
                        'elementClasses': target.className,
                        'elementUrl': target.href
                    });

                }

            });

            $eventHandler.addListener('touchstart', $documentElement, function (event) {

                var target = getTargetElement(event);

                pointer = getPointer(event);

                cachedX = currX = pointer.pageX;
                cachedY = currY = pointer.pageY;

                touchStarted = true;

                setTimeout(function (){
                    if ((cachedX === currX) && !touchStarted && (cachedY === currY)) {
                        dataLayer.push({
                            'event': 'stg.click',
                            'eventCallback': $callbackFactory.get('click', event),
                            'element': target,
                            'elementId': target.id,
                            'elementClasses': target.className,
                            'elementUrl': target.action
                        });

                    }
                }, 200);

            });

            $eventHandler.addListener('touchend', $documentElement, function (event) {
                touchStarted = false;
            });

            $eventHandler.addListener('touchmove', $documentElement, function (event) {

                pointer = getPointer(event);

                currX = pointer.pageX;
                currY = pointer.pageY;

            });

            $eventHandler.addListener('submit', $documentElement, function (event) {

                var target = getTargetElement(event);

                dataLayer.push({
                    'event': 'stg.formSubmit',
                    'eventCallback': $callbackFactory.get('submit', event),
                    'element': target,
                    'elementId': target.id,
                    'elementClasses': target.className,
                    'elementUrl': target.action
                });

            });

            $eventHandler.addListener('load', $documentElement, function () {

                dataLayer.push({
                    'event': 'stg.load',
                    'start': new Date().getTime()
                });

            });

            $eventHandler.run();
        };

        return this;
    };

    ListenersHandler.$inject = [
        'Element',
        '$eventHandler',
        '$utils',
        '$documentElement',
        '$callbackFactory'
    ];

    sevenTag.service(MODULE_NAME, ListenersHandler);

})(window.sevenTag, '$listenersHandler');
