<template>
    <div class="series">
        <div class="series__image-wrapper">
            <div class="series__image" :style="{ backgroundImage: `url(${series.image})`}"></div>
        </div>
        <span class="series__title">{{ series.title }}</span>
    </div>
</template>

<script>
    export default {
        props: {
            series: {
                type: Object
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import '../variables';

    .series {
        &__image-wrapper {
            position: relative;
            padding-top: 147.253%;
            background-color: grey;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 3px rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.1);
        }
        &__image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-position: center;
            background-size: cover;
            &:hover {
                border: 2px solid blue;
            }
        }
        &__title {
            color: $white;
        }
    }
</style>