<template>
    <section class="submit-email hero is-primary">
        <div class="hero-body">
            <div class="container">
                <div class="columns">
                    <div class="column">
                        <h1 class="title">
                            Primary title
                        </h1>
                        <h2 class="subtitle">
                            Primary subtitle
                        </h2>
                    </div>
                    <div class="column">
                        <p class="control has-icons-left">
                            <input v-model="email" class="input" type="email" placeholder="Email">
                            <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                            </span>
                            <button class="button is-danger">Submit</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                email: ''
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import '../variables';

    .submit-email {
        background-color: $ebony-clay;
    }
</style>