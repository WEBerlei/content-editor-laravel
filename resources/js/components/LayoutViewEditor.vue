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

<style scoped>
    .content-editor {
        background-color: #fe8a71;
        flex-grow: 1;
        padding: 0 1em;
    }


</style>
