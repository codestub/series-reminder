<template>
    <div class="home">
        <call-to-action></call-to-action>
        <selection></selection>
        <submit-email></submit-email>
    </div>
</template>

<script>
    import CallToAction from '@/components/widgets/CallToAction';
    import Selection from '@/components/widgets/Selection';
    import SubmitEmail from '@/components/widgets/SubmitEmail';
    import store from '@/store';

    export default {
        beforeRouteEnter: async (to, from, next) => {
            await store.dispatch('getSeries');
            next();
        },
        components: {
            CallToAction,
            Selection,
            SubmitEmail
        }
    }
</script>

<style lang="scss" scoped>
    @import '../variables.scss';

    .home {
        
    }
</style>