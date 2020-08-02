<template>
    <div class="content-editor-component" ref="editorComponent" :component-id="component.vue_id" :component-class="component.vue_class" @dblclick="onDoubleClick">
        <div class="component-icon" v-html="component.vue_icon"></div>
        <span class="preview">{{component.vue_name}}</span>
    </div>
</template>

<script>
    import ComponentsApi from '../services/ComponentsApi'

    export default {
        props: {
            component: null,
        },
        data: () => ({

        }),
        methods: {
            onDoubleClick: function(e) {
                window.contentEditorLayout.$refs.moduleModal.open( this.$refs.editorComponent, this.component.vue_id, this.component.vue_class );
            }
        },
        computed: {

        },
        mounted() {

        }
    };
</script>

<style>
    .component-editor > label {
        display: block;
        text-align: left;
        font-size: 0.75em;
        font-weight: bold;
        margin-bottom: 0.5em;
    }
    .component-editor > textarea, .component-editor > input {
        width: 100%;
        padding: 0.5em;
    }
</style>

<style lang="sass">
    @import "./resources/sass/variables.scss"

    .content-editor-component
        background-color: $content-editor-component-color

    .content-editor-component:hover
        box-shadow: 0 0 0pt 4pt $content-editor-component-hover-outline
</style>

<style scoped>
    .component-icon {
        text-align: center;
    }

    .content-editor-component {
        color: #fff;
        padding: 15px;
        margin: 1em;
        border-radius: 0.25em;
        text-align: center;
        cursor: grab;
        min-width: 120px;
        flex-grow: 1;
    }

    .content-editor-component span {
        display: block;
        font-family: sans-serif;
        margin-top: 1em;
    }
</style>
