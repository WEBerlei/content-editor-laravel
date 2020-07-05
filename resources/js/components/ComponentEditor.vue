<template>
    <div class="module-editor">
        <p class="loading" v-if="loading">Loading...</p>
        {{content}}
    </div>
</template>

<script>
    import ModuleEditorsApi from '../services/ComponentEditors'

    export default {
        props: {},
        data: () => ({
            content: "",
            loading: true,
        }),
        computed: {},
        mounted() {
            ModuleEditorsApi.getEditor().then(output => {
                this.content = output;
            })
            .catch(error => {
                console.log(error);
                this.content = error;
            })
            .finally(() => {
                this.loading = false;
            })
        }
    };
</script>

<style scoped>

</style>
