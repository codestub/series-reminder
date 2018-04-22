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
                            <input @keyup.enter="submit" v-model="email" v-validate="'required|email'" class="input" type="email" name="email" placeholder="Email">
                            <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                            </span>
                        </p>
                        <small>{{ errors.first('email') }}</small>
                    </div>
                    <div class="column">
                        <button @click="submit" class="button is-danger">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import { mapActions } from 'vuex';

    export default {
        data() {
            return {
                email: ''
            }
        },
        methods: {
            ...mapActions({
                submitSelection: 'submitSelection'
            }),
            async submit() {
                const success = await this.$validator.validateAll();
                if (success) {
                    this.submitSelection(this.email);
                    alert('passed validation!');
                }
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