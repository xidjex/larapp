<template>
        <div class="progress" style="height: 20px;" v-if="state">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%"></div>
        </div>
</template>

<script>

    export default {
        name: 'ProgressBar',
        props: {
            state: Boolean
        }
    }

</script>
