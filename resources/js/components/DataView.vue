<template>
    <div class="data-view" ref="dataview">
        <div class="component-editor" v-for="editor in editors">
            <component-editor ref="editors" :component-id="editor.id"></component-editor>
        </div>
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
        computed: {
            editors: function() {
                let editors = [];

                for (let i = 0; i < this.content.sections.length; i++) {
                    for( let j = 0; j < this.content.sections[ i ].components.length; j++ ) {
                        let component = this.content.sections[ i ].components[ j ];
                        editors.push( { id: component.id } );
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
            }
        },
        mounted() {
            var form = this.$refs.dataview.closest('form');
            var self = this;

            if( form !== undefined ) {
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
