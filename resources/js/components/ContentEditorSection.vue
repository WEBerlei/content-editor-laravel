<template>
    <div ref="section" class="content-editor-section" :section-id="sectionId">
        <content-editor-component v-for="component in components" v-bind:key="component.id"  :component="component.renderable"></content-editor-component>
    </div>
</template>

<script>
    import ComponentsApi from '../services/ComponentsApi'
    import Sortable from 'sortablejs';

    export default {
        props: {
            section: null,
        },
        data: () => ({

        }),
        computed: {
            components: function() {
                if( this.section == null ) {
                    return [];
                }

                return this.section.components;
            },
            sectionId: function() {
                if( this.section == null ) {
                    return 0;
                }

                return this.section.id;
            }
        },
        mounted() {
            this.$nextTick(() => {
                window.contentEditorLayout.makeDropzone(this.$refs.section);
            });

        }
    };
</script>

<style lang="sass">
    @import "./resources/sass/variables.scss"

    .content-editor-section
        border: 5px dashed $content-editor-component-color
</style>

<style scoped>
    .content-editor-section {
        width: 100%;
        min-height: 150px;
        border-radius: 0.25em;
        display: flex;
        flex-direction: row;

        margin: 1em 0;
    }
</style>
