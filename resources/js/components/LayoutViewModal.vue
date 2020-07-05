<template>
    <div class="content-editor-modal" v-if="isOpen">
        <div class="modal-box">
            <component-editor></component-editor>
        </div>

    </div>
</template>

<script>
    export default {
        props: {},
        data: () => ({
            isOpen: false,
        }),
        computed: {},
        mounted() {

        },
        methods: {
            open: function() {
                this.isOpen = true;
            }
        }
    };
</script>

<style scoped>
    .modal-box {
        background-color: #f6cd61 ;
        border: 1px solid #000;
        margin: 1em auto;
        display: inline-block;
        font-family: sans-serif;
        padding: 1em;
    }
    .content-editor-modal {
        position: absolute;
        background-color: rgba(0, 0, 0, 0.5);
        width: 100%;
        z-index: 1000;
        height: auto;
        min-height: 100%;
        text-align: center;
    }
</style>
