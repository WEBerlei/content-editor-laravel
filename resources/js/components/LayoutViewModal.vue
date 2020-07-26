<template>
    <div class="content-editor-modal" v-if="isOpen">
        <div class="modal-box">
            <component-editor :component-id="componentId" :component-class="componentClass"></component-editor>
            <a href="#" class="content-editor-button button-save" @click="save()">
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
            <a href="#" class="content-editor-button button-red" @click="cancel()">Cancel</a>
        </div>

    </div>
</template>

<script>
    import ContentApi from "../services/ContentApi";
    import ComponentsApi from '../services/ComponentsApi'

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

                var formData = new FormData()
                formData.append( 'componentId', this.componentId );
                formData.append( 'componentClass', this.componentClass );

                var inputs = document.getElementsByClassName('content-editor-input');

                for (let i = 0; i < inputs.length; i++) {
                    formData.append( inputs[ i ].name, inputs[ i ].value );
                }

                ComponentsApi.saveEditor( formData ).then(output => {
                    if( output.isValid == true )
                    {
                        this.isOpen = false;
                        this.element.querySelector( '.preview' ).innerHTML = output.newPreview;
                    }
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                    this.isSaving = false;
                })
            }
        }
    };
</script>

<style scoped>
    .modal-box {
        min-width: 50%;
        background-color: #f6cd61 ;
        border: 1px solid #000;
        margin: 1em auto;
        display: inline-block;
        font-family: sans-serif;
        padding: 1em;
    }
    .button-save {
        position: relative;
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
    .saving-icon {
        background-color: #3da4ab;
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
