<template>
    <footer class="footer">
        <div class="container">
            <div class="content has-text-centered">
            <p>
                The source code is licensed
                <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
                is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
            </p>
            </div>
        </div>
    </footer>
</template>

<script>
    export default {
        
    }
</script>

<style lang="scss" scoped>
    @import '../variables';

    .footer {
        color: $white;
        background-color: $martinique;
        a {
            color: $white;
        }
    }
</style>