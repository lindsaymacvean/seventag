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

let StateSummary;
let TagSummary;
/**
 * @name Report
 */
class Report {
    /**
     * @param {Debugger} $debugger
     * @param {StateSummary} $StateSummary
     * @param {TagSummary} $TagSummary
     * @param {DataLayerLimitedStack} $dataLayerLimitedStack
     */
    constructor($debugger, $StateSummary, $TagSummary, $dataLayerLimitedStack, $filter) {

        let $this = this;

        StateSummary = $StateSummary;
        TagSummary = $TagSummary;
        this.$filter = $filter;

        this.$debugger = $debugger;

        this.$dataLayerLimitedStack = $dataLayerLimitedStack;

        this.stateSummary = new StateSummary();

        let tagTree = $debugger.getTagTree();

        // Prepare tag summary
        let tagSummary;

        for (let tag in tagTree) {
            tagSummary = new TagSummary();
            tagSummary.id = tagTree[tag].id;
            tagSummary.name = tagTree[tag].name;
            tagSummary.code = tagTree[tag].code;
            tagSummary.firedTriggers = tagTree[tag].triggers;
            tagSummary.disableInDebugMode = tagTree[tag].disableInDebugMode;
            tagSummary.respectVisitorsPrivacy = tagTree[tag].respectVisitorsPrivacy;

            this.stateSummary.addTagSummary(tagTree[tag].id, tagSummary);
        }

        // Run for the first time
        this.updateSummary();

        $debugger.addListenerContainerStates(() => {
            $this.updateSummary();
        });
}

    /**
     * Update report summary about states
     */
    updateSummary() {

        let states = this.$debugger.getDataLayerStates(),
            tagSummary;

        while(states.length) {

            let state = states.shift();

            let tags = state.tags;

            let summary = new StateSummary();

            summary.dataLayerElement = state.dataLayerElement;
            summary.variableCollection = state.variableCollection;

            for (let tag in tags) {

                tagSummary = new TagSummary();
                tagSummary.id = tags[tag].id;
                tagSummary.name = tags[tag].name;
                tagSummary.code = tags[tag].code;
                tagSummary.firedTriggers = tags[tag].triggers;
                tagSummary.resolved = tags[tag].resolved;
                tagSummary.disableInDebugMode = tags[tag].disableInDebugMode;
                tagSummary.respectVisitorsPrivacy = tags[tag].respectVisitorsPrivacy;

                summary.addTagSummary(tags[tag].id, tagSummary);

                if (tags[tag].resolved) {

                    if (tags[tag].id !== undefined) {

                        let resolvedTriggersIds = [];

                        for (let trigger in tags[tag].triggers) {
                            if (tags[tag].triggers[trigger].resolved) {
                                resolvedTriggersIds.push(tags[tag].triggers[trigger].id);
                            }
                        }

                        this.stateSummary.getTagSummary(tags[tag].id)
                            .increaseFiredCount()
                            .markResolvedTriggers(resolvedTriggersIds);

                    }

                }

            }

            this.$dataLayerLimitedStack.push(summary);

        }

    }

    /**
     * Returns fired tags list
     *
     * @returns {Array}
     */
    getFiredTags() {

        return this.$filter('firedTags')(
            this.stateSummary
                .getTagSummaryCollection()
        );
    }

    /**
     * Returns tags which are fired but disabled
     *
     * @returns {Array}
     */
    getDisabledFiredTags() {

        return this.$filter('firedDisabledTags')(
            this.stateSummary
                .getTagSummaryCollection()
        );
    }

    /**
     * Returns not fired tags list
     *
     * @returns {*}
     */
    getNotFiredTags() {

        return this.$filter('notFiredTags')(
            this.stateSummary
                .getTagSummaryCollection()
        );

    }

    /**
     * @returns {DataLayerLimitedStack}
     */
    get dataLayerLimitedStack() {
        return this.$dataLayerLimitedStack;
    }
}

Report.$inject = [
    'stg.debugger.debugger',
    'stg.debugger.StateSummary',
    'stg.debugger.TagSummary',
    'stg.debugger.dataLayerLimitedStack',
    '$filter'
];

angular
    .module('stg.debugger')
    .service('stg.debugger.report', Report);
