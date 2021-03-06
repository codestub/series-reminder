<template>
    <div class="selection">
        <div class="selection__container container">
            <div class="selection__controls field">
                <p class="selection__search control has-icons-left">
                    <input v-model="searchTerm" class="input" type="text" placeholder="Search">
                    <span class="icon is-small is-left">
                    <i class="fas fa-search"></i>
                    </span>
                </p>
                <p class="selection__info">
                    {{ `${selectedSeries.length} series selected` }}
                </p>
            </div>
            <div class="selection__list">
                <series @click.native="handleClickSeries(series)" v-for="series in filteredSeries" :series="series" :key="series.id"></series>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapMutations, mapState } from 'vuex';
    import Series from '@/components/widgets/Series';
    import Fuse from 'fuse.js';

    export default {
        data() {
            return {
                searchTerm: '',
                fuse: null,
                fuseOptions: {
                    shouldSort: true,
                    threshold: 0.6,
                    location: 0,
                    distance: 100,
                    maxPatternLength: 32,
                    minMatchCharLength: 1,
                    keys: ['title']
                }
            }
        },
        created() {
            this.fuse = new Fuse(this.series, this.fuseOptions);
        },
        computed: {
            ...mapState({
                series: 'series'
            }),
            ...mapGetters({
                selectedSeries: 'selectedSeries'
            }),
            filteredSeries() {
                return this.searchTerm.length === 0
                    ? this.series
                    : this.fuse.search(this.searchTerm);
            }
        },
        methods: {
            ...mapMutations({
                toggleSelected: 'toggleSelected'
            }),
            handleClickSeries(series) {
                this.toggleSelected(series.key);
            }
        },
        components: {
            Series
        }
    }
</script>

<style lang="scss" scoped>
    @import '../variables';

    $hd: 1216px;
    $widescreen: 1215px;
    $desktop: 1024px;
    $touch: 768px;

    .selection {
        background-color: $martinique;
        border-bottom: 2px solid $border;
        &__container {
            padding-top: 2em;
            @media all and (max-width: $desktop) {
                padding: 0 1em;
            }
        }
        &__controls {
            display: flex;
            justify-content: space-between;
        }
        &__search {
            width: 250px;
        }
        &__info {
            color: $white;
            text-decoration: underline;
            user-select: none;
        }
        &__list {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin-top: 1em;
            .series {
                margin-bottom: 1em;
                @media all and (min-width: 1216px) {
                    width: 15%;
                    margin-right: 2%;
                    &:nth-child(6n) {
                        margin-right: 0;
                    }
                }
                @media all and (min-width: 1025px) and (max-width: 1215px) {
                    width: 18%;
                    margin-right: 2.5%;
                    &:nth-child(5n) {
                        margin-right: 0;
                    }
                }
                @media all and (min-width: 767px) and (max-width: 1024px) {
                    width: 22.5%;
                    margin-right: 3.333%;
                    &:nth-child(4n) {
                        margin-right: 0;
                    }
                }
                @media all and (max-width: 768px) {
                    width: 30%;
                    margin-right: 5%;
                    &:nth-child(3n) {
                        margin-right: 0;
                    }
                }
            }
        }
    }
</style>