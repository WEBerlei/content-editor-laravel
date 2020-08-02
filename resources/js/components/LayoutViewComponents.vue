<template>
    <div class="components">
        <div class="components-container">
            <div class="components-list" id="components-list">
                <content-editor-component v-for="component in components" v-bind:key="component.id" :component="component"></content-editor-component>
            </div>

            <div id="component-trash" class="component-trash">
                <div class="component-trash-icon">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        components: {
        },
        props: {
            components: {},
        },
        data: () => ({}),
        computed: {},
    };
</script>

<style>
    .svg-icon, .icon {
        width: 3em;
        height: 3em;
        display: inline;
    }

    .svg-icon path,
    .svg-icon polygon,
    .svg-icon rect {
        fill: #ffffff;
    }

    .svg-icon circle {
        stroke: #ffffff;
        stroke-width: 1;
    }
</style>

<style lang="sass">
    @import "./resources/sass/variables.scss"

    .components
        background-color: $content-editor-components-background

    .component
        background-color: $content-editor-component-color

    .component-trash
        background-color: $content-editor-danger
</style>

<style scoped>


    .components {
        flex-grow: 0;
        display: flex;
        flex-direction: column;
    }

    .components-container {
        position: sticky;
        top: 0;
    }

    .component, .component-trash {
        padding: 15px;
        margin: 1em;
        border-radius: 0.25em;
        text-align: center;
        cursor: grab;
        min-width: 120px;
        flex-grow: 1;
    }

    .component-trash {
        width: 150px;
        height: 110px;
        padding: 0;
        flex-grow: 0;
        background-image: url( '/images/trash.svg' );
        background-repeat: no-repeat;
        background-position: center;
        background-size: 3em;
    }

    .component-trash-icon {
        margin-top: 15px;
    }



    .component span, .component-trash span {
        display: block;
        font-family: sans-serif;
        margin-top: 1em;
    }
</style>
