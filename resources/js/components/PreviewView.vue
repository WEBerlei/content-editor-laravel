<template>
    <div class="preview-view" v-html="preview">

    </div>
</template>

<script>
    import ContentApi from "../services/ContentApi";

    export default {
        components: {
        },
        props: {
            content: null,
        },
        data: () => ({
            preview: "",
        }),
        computed: {},
        methods: {

        },
        mounted() {
            ContentApi.render( this.content.id )
                .then( output => {
                    this.preview = output;
                })
                .catch(error => {
                    console.log( error );
                })
                .finally(() => {

                })
        }
    };
</script>

<style scoped>
    .preview-view {
        width: 100%;
        border: 1px solid #000;
    }
</style>
