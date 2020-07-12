<template>
    <form id="component-editor-form" v-html="content">
        <p class="loading" v-if="loading">Loading...</p>
    </form>
</template>

<script>
    import ComponentEditorsApi from '../services/ComponentsApi'

    export default {
        props: {
            componentId: null,
            componentClass: null,

        },
        data: () => ({
            content: "",
            loading: true,
        }),
        computed: {},
        mounted() {
            ComponentEditorsApi.getEditor( this.componentId, this.componentClass ).then(output => {
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
