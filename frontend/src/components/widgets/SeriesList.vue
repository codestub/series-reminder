<template>
    <div class="series-list container">
        <series v-for="item in series" :series="item" :key="item.id"></series>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import Series from '@/components/widgets/Series';

    export default {
        computed: {
            ...mapState({
                series: 'series'
            })
        },
        components: {
            Series
        }
    }
</script>

<style lang="scss" scoped>
    .series-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-top: 2em;
        .series {
            width: 15%;
        }
    }
</style>