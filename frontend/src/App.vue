<template>
    <div id="app">
        <navigation></navigation>
        <router-view/>
        <page-footer></page-footer>
    </div>
</template>

<script>
	import Navigation from '@/components/widgets/Navigation';
	import PageFooter from '@/components/widgets/Footer';

	export default {
		components: {
			Navigation,
			PageFooter
		}
	};
</script>

<style>
</style>
