<template>
    <div id="content-editor" class="content-editor">
        <div id="module-dropzone" class="module-dropzone">
        </div>
    </div>
</template>

<script>
    export default {
        props: {},
        data: () => ({}),
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

    .module-dropzone {
        width: 100%;
        border: 5px dashed #3da4ab;
        min-height: 150px;
        border-radius: 0.25em;
        display: flex;
        flex-direction: row;

        margin: 1em 0;
    }

</style>
