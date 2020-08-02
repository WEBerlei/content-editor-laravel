<template>
    <div id="content-editor" class="content-editor">
        <content-editor-section v-for="section in content.sections" v-bind:key="section.id" :section="section"></content-editor-section>
        <content-editor-section></content-editor-section>
    </div>
</template>

<script>
    export default {
        props: {
            content: null,
            components: null,
        },
        data: () => ({

        }),
        computed: {},
        mounted() {

        }
    };
</script>

<style lang="sass">
    @import "./resources/sass/variables.scss"

    .content-editor
        background-color: $content-editor-layout-background
</style>

<style scoped>
    .content-editor {
        flex-grow: 1;
        padding: 0 1em;
    }


</style>
