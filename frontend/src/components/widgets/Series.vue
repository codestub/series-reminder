<template>
    <div class="series">
        <div class="series__image-wrapper">
            <div class="series__image" :class="{ 'series__image--selected': series.selected }" :style="{ backgroundImage: `url(${series.image})`}"></div>
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
            cursor: pointer;
        }
        &__image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 2px solid transparent;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-origin: border-box;
            &:hover {
                border: 2px solid $info;
            }
            &--selected {
                border: 2px solid $success;
            }
        }
        &__title {
            color: $white;
            border: 2px solid transparent;
        }
    }
</style>