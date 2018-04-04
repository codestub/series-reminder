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

    export default {
        data() {
            return {
                searchTerm: ''
            }
        },
        computed: {
            ...mapState({
                series: 'series'
            }),
            filteredSeries() {
                return this.series.filter(series => series.title.toLowerCase().includes(this.searchTerm.toLowerCase()));
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