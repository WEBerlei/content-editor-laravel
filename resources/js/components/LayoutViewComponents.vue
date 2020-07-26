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
    .svg-icon {
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
<style scoped>


    .components {
        background-color: #f6cd61 ;
        flex-grow: 0;
        display: flex;
        flex-direction: column;
    }

    .components-container {
        position: sticky;
        top: 0;
    }

    .component, .component-trash {
        background-color: #3da4ab;
        color: #fff;
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
        background-color: #ab3d3d;
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
