<template>
    <div id="app">
        <navigation></navigation>
        <router-view/>
        <page-footer></page-footer>
    </div>
</template>

<script>
	import Navigation from '@/components/widgets/Navigation.vue';
	import PageFooter from '@/components/widgets/Footer.vue';

	export default {
		components: {
			Navigation,
			PageFooter
		}
	};
</script>

<style>
</style>
