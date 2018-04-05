<template>
    <div class="selection">
        <div class="selection__container container">
            <div class="selection__search field">
                <p class="control has-icons-left">
                    <input v-model="searchTerm" class="input" type="text" placeholder="Search">
                    <span class="icon is-small is-left">
                    <i class="fas fa-search"></i>
                    </span>
                </p>
            </div>
            <div class="selection__list">
                <series v-for="item in filteredSeries" :series="item" :key="item.id"></series>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
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
            filteredSeries() {
                return this.searchTerm.length === 0
                    ? this.series
                    : this.fuse.search(this.searchTerm);
            }
        },
        components: {
            Series
        }
    }
</script>

<style lang="scss" scoped>
    .selection {
        &__container {
            margin-top: 2em;
        }
        &__search {
            width: 250px;
        }
        &__list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 1em;
            .series {
                width: 15%;
            }
        }
    }
</style>