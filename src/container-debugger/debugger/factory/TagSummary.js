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

/**
 * @name TagSummary
 */
class TagSummary {

    constructor() {
        this.id = undefined;
        this.$name = '';
        this.$code = '';
        this.$fired = 0;
        this.$respectVisitorsPrivacy = false;
        this.$disableInDebugMode = false;
        this.$triggers = [];
        this.$dataLayerStates = [];
    }

    /**
     * @returns {string}
     */
    get name() {
        return this.$name;
    }

    /**
     * @param {string} name
     */
    set name(name) {
        this.$name = name;

        return this;
    }

    /**
     * Returns
     *
     * @returns {string}
     */
    get code() {
        return this.$code;
    }

    /**
     *
     * @param {string} code
     */
    set code(code) {
        this.$code = code;

        return this;
    }

    /**
     * Returns
     *
     * @returns {string}
     */
    get disableInDebugMode() {
        return this.$disableInDebugMode;
    }

    /**
     *
     * @param {string} disableInDebugMode
     */
    set disableInDebugMode(disableInDebugMode) {
        this.$disableInDebugMode = disableInDebugMode;

        return this;
    }

    /**
     * Returns
     *
     * @returns {boolean}
     */
    get respectVisitorsPrivacy() {
        return this.$respectVisitorsPrivacy;
    }

    /**
     *
     * @param {boolean} respectVisitorsPrivacy
     */
    set respectVisitorsPrivacy(respectVisitorsPrivacy) {
        this.$respectVisitorsPrivacy = respectVisitorsPrivacy;

        return this;
    }

    /**
     * Count of how many times tag is fired
     *
     * @returns {number}
     */
    get firedCount() {
        return this.$fired;
    }

    /**
     * Returns array of triggers related to tag
     *
     * @returns {Array}
     */
    get triggers() {

        return this.$triggers;

    }

    /**
     * @returns {Array}
     */
    get firedTriggers() {
        var results = [];

        for (let index in this.$triggers) {
            if (this.$triggers[index].resolved) {
                results.push(this.$triggers[index]);
            }
        }

        return results;
    }

    /**
     * @param {Array} triggers
     */
    set firedTriggers(triggers) {
        this.$triggers = triggers;

        return this;
    }

    /**
     * @returns {Array}
     */
    get notFiredTriggers() {
        var results = [];

        for (let index in this.$triggers) {
            if (this.$triggers[index].resolved === undefined || this.$triggers[index].resolved === false) {
                results.push(this.$triggers[index]);
            }
        }

        return results;
    }

    /**
     * @param {Object} dataLayerState
     * @return {TagSummary}
     */
    addDataLayerState(dataLayerState) {
        this.$dataLayerStates.push(dataLayerState);

        return this;
    }

    /**
     * @param {Object} dataLayerState
     * @return {Booleam}
     */
    hasDataLayerState(dataLayerState) {
        for(let index in this.$dataLayerStates) {
            if(this.$dataLayerStates[index] === dataLayerState) {
                return true;
            }
        }

        return false;
    }

    /**
     * @returns {number}
     */
    increaseFiredCount() {
        this.$fired++;

        return this;
    }

    /**
     * return void
     */
    markResolvedTriggers(resolvedTriggerIds) {

        for (let index in this.$triggers) {

            this.$triggers[index].resolved = resolvedTriggerIds.indexOf(this.$triggers[index].id) > -1;

        }

    }

    /**
     * return void
     */
    markResolvedConditions(triggerId, resolveConditionsIndexes) {

        for (let index in this.$triggers[triggerId].conditions) {

            this.$triggers[triggerId].conditions[index].resolved = false;

        }

        for (let index in resolveConditionsIndexes) {

            this.$triggers[triggerId].conditions[index].resolved = true;

        }

    }

    isRespectVisitorsPrivacy (doNotTrackEnabled) {
        return this.respectVisitorsPrivacy && doNotTrackEnabled;
    }

    isFiredMoreThenOnce () {
        return this.firedCount > 1 && !this.disableInDebugMode;
    }

    isFiredOnce () {
        return this.firedCount === 1 && !this.disableInDebugMode;
    }

    isFired () {
        return this.firedCount > 0 && !this.disableInDebugMode;
    }

    isDisabled () {
        return this.disableInDebugMode;
    }

}

angular
    .module('stg.debugger')
    .value('stg.debugger.TagSummary', TagSummary);
