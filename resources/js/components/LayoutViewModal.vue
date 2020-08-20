<template>
    <div class="content-editor-modal" v-if="isOpen" @keydown.esc="cancel()">
        <div class="fixed inset-0 transition-opacity" style="z-index: 1000">
            <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
        </div>

        <div class="modal-box">

            <component-editor @onSave="saved" ref="componenteditor" :component-id="componentId" :component-class="componentClass"></component-editor>
            <a href="#" class="content-editor-button button-save" @click.prevent="save()">
                <span v-if="isSaving" class="saving-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/> <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5" />
                        <animateTransform attributeName="transform"
                                          attributeType="XML"
                                          type="rotate"
                                          from="0 0 0"
                                          to="360 0 0"
                                          dur="2s"
                                          repeatCount="indefinite"/>
                    </svg>
                </span>
                <span>Save</span>
            </a>
            <a href="#" class="content-editor-button button-red" @click.prevent="cancel()">Cancel</a>
        </div>

    </div>
</template>

<script>
    export default {
        props: {},
        data: () => ({
            isOpen: false,
            isSaving: false,
            element: null,
            componentId: null,
            componentClass: null,
        }),
        computed: {},
        mounted() {
            window.contentEditorLayoutModal = this;

            document.addEventListener('keyup', function (e) {
                if(e.key === "Escape") {
                    if( window.contentEditorLayoutModal.isOpen == true ) {
                        window.contentEditorLayoutModal.cancel();
                    }
                }
            });
        },
        methods: {
            open: function(element, component_id, component_class) {
                if( component_id === 0 )
                {
                    return;
                }

                this.isOpen = true;
                this.isSaving = false;
                this.element = element;
                this.componentId = component_id;
                this.componentClass = component_class;
            },
            cancel: function() {
                this.isOpen = false;
            },
            save: function() {
                this.isSaving = true;

                this.$refs.componenteditor.save();
            },
            saved: function( newPreview ) {
                this.isSaving = false;
                this.isOpen = false;
                this.element.querySelector( '.preview' ).innerHTML = newPreview;
            }
        }
    };
</script>

<style lang="sass">
    @import "./resources/sass/variables.scss"

    .modal-box
        background-color: $content-editor-components-background
</style>

<style scoped>
    .modal-box {
        min-width: 90%;
        border: 1px solid #000;
        margin: 1em auto;
        display: inline-block;
        font-family: sans-serif;
        padding: 1em;
        text-align: left;
        left: 5%;
        position: absolute;
        z-index: 1500;
    }
    .button-save {
        position: relative;
    }
    .content-editor-modal {
        position: absolute;

        left: 0;
        right: 0;
        z-index: 10;
        height: auto;
        min-height: 100%;
        text-align: center;
    }
    .saving-icon {
        width: 100%;
        position: absolute;
        margin-left: auto;
        margin-right: auto;
        left: 0;
        right: 0;
        top: 0.5em;
        padding-top: 0.25em;
        height: 1.5em;
        text-align: center;
    }
</style>
