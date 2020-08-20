<template>
    <div class="data-view" ref="dataview">
        <div class="component-editor" v-for="editor in editors">
            <component-editor ref="editors" :component-id="editor.id"></component-editor>
        </div>
        <div class="data-components-list" id="components-list">
            <span class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 transition ease-in-out duration-150"
               >Modul hinzufügen: </span>
            <a href="#" @click.prevent="addComponent(component)" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-primary-700 focus:z-10 focus:outline-none focus:border-primary-300 focus:shadow-outline-orange active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
               v-for="component in components">{{ component.vue_name }}</a>
        </div>
    </div>
</template>

<script>
    import ContentApi from "../services/ContentApi";

    export default {
        components: {
        },
        props: {
            content: Object,
            components: Object,
        },
        data: () => ({
            preview: "",
        }),
        computed: {
            editors: function() {
                let editors = [];

                for (let i = 0; i < this.content.sections.length; i++) {
                    for( let j = 0; j < this.content.sections[ i ].components.length; j++ ) {
                        let component = this.content.sections[ i ].components[ j ];
                        editors.push( { id: component.id, class: component.renderable_type } );
                    }
                }

                return editors;
            }
        },
        methods: {
            saveEditors() {
                 for( let i = 0; i < this.$refs.editors.length; i++ ) {
                    this.$refs.editors[ i ].save();
                 }
            },
            addComponent(component) {
                console.log( "Add " + component.vue_class );
                window.contentEditor.addComponent( component.vue_class );
            },
        },
        mounted() {
            var form = this.$refs.dataview.closest('form');
            var self = this;

            if( form !== null ) {
                form.addEventListener('submit', function(e) {
                    self.saveEditors();
                });
            }
        }
    };
</script>

<style lang="sass">
    @import "./resources/sass/variables.scss"

    .data-view
        //background-color: $content-editor-components-background
</style>

<style scoped>
    .data-view {
        width: 100%;
    }
</style>
