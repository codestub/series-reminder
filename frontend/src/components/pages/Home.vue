<template>
    <div>
        <call-to-action></call-to-action>
        <series-list></series-list>
    </div>
</template>

<script>
    import CallToAction from '@/components/widgets/CallToAction';
    import SeriesList from '@/components/widgets/SeriesList';

    export default {
        components: {
            CallToAction,
            SeriesList
        }
    }
</script>

<style lang="scss" scoped>

</style>