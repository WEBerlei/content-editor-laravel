<template>
    <div class="content-editor-main">
        <input type="hidden" name="content_id" :value="contentId" />
        <div class="content-editor-main-container">
            <div class="ce-py-5">
               <span class="toolbar">
                  <a @click.prevent="showData" href="#"
                     class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-primary-700 focus:z-10 focus:outline-none focus:border-primary-300 focus:shadow-outline-orange active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                     v-bind:class="{'bg-primary-400':this.currentMode == 'data', 'text-primary-800':this.currentMode == 'data'}"
                  >
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                      Data
                  </a>
                  <a @click.prevent="showLayout" href="#"
                     class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-primary-700 focus:z-10 focus:outline-none focus:border-primary-300 focus:shadow-outline-orange active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                     v-bind:class="{'bg-primary-400':this.currentMode == 'layout', 'text-primary-800':this.currentMode == 'layout'}"
                  >
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path></svg>
                      Layout
                  </a>
                  <a @click.prevent="showPreview" href="#"
                     class="-ml-px relative inline-flex items-center px-4 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-primary-700 focus:z-10 focus:outline-none focus:border-primary-300 focus:shadow-outline-orange active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                     v-bind:class="{'bg-primary-400':this.currentMode == 'preview', 'text-primary-800':this.currentMode == 'preview'}"
                  >
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                      Preview
                  </a>
                </span>
            </div>
            <div class="ce-py-5">
                <layout-view :content="content" :components="components" v-if="!loading && currentMode === 'layout'"></layout-view>
                <preview-view :content="content" v-if="!loading && currentMode === 'preview'"></preview-view>
                <data-view ref="dataView" :content="content" :components="components" v-if="!loading && currentMode === 'data'"></data-view>
            </div>
        </div>

        <!--<div class="content-editor-toolbar">
        <a href="#" @click.prevent="showData" class="content-editor-button">Data</a>
        <a href="#" @click.prevent="showLayout" class="content-editor-button">Layout</a>
        <a href="#" @click.prevent="showPreview" class="content-editor-button">Preview</a>
        </div>-->

        <!--<div class="content-editor-views">

        </div>-->
    </div>
</template>

<script>
    import ContentApi from '../services/ContentApi'
    import ComponentsApi from '../services/ComponentsApi'
    import LayoutView from "./LayoutView";

    export default {
        props: {
            id: {  },
            mode: {
                type: String,
                default: "data",
            },
        },
        components: {
            'layout-view': LayoutView,
        },
        data: () => ({
            content: null,
            components: null,
            loading: true,
            saving: false,
            currentMode: null,
        }),
        methods: {
            showData: function() {
                this.loadLayout();
                this.setMode( "data" );
            },
            showLayout: function() {
                this.loadLayout();
                this.setMode( "layout" );
            },
            showPreview: function() {
                this.setMode( "preview" );
            },
            loadLayout: function() {
                this.loading = true;
                ContentApi.get( this.contentId ).then(output => {
                    this.content = output;
                })
                    .catch(error => {
                        console.log(error);
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },
            setMode( newMode ) {
                this.onLeaveMode(this.currentMode);
                this.currentMode = newMode;
            },
            onLeaveMode( oldMode ) {
                if( oldMode === "data" ) {
                    this.saveChangesToEditors();
                }
            },
            saveChangesToEditors() {
                if( this.currentMode == "data" ) {
                    this.$refs.dataView.saveEditors();
                }
            },
            save: function() {
                if( this.saving === true )  {
                    return;
                }

                this.saving = true;
                let sections = document.getElementsByClassName( 'content-editor-section' );
                let output = [];
                for (let i = 0; i < sections.length; i++) {
                    let newSection = {
                        id: sections[i].getAttribute('section-id'),
                        components: [],
                    }
                    let components = sections[i].getElementsByClassName('content-editor-component');

                    if (i === sections.length - 1 && components.length === 0 && newSection.id == 0 ) { //Skip last empty section
                        continue;
                    }

                    for (let j = 0; j < components.length; j++) {
                        let newComponent = {
                            id: components[j].getAttribute('component-id'),
                            class: components[j].getAttribute('component-class'),
                        }

                        newSection.components.push(newComponent);
                    }

                    output.push(newSection);
                }

                //console.log( output );

                ContentApi.store( this.contentId, { sections: output } )
                    .then( output => {
                        this.content = output;
                        //console.trace( this.content );
                        var tempComponents = document.getElementsByClassName('content-editor-component');
                        for (let i = 0; i < tempComponents.length; i++) {
                            if( tempComponents[i].getAttribute('newly-created') === "true" ) {
                                tempComponents[i].parentNode.removeChild(tempComponents[i]);
                            }
                        }

                    })
                    .catch(error => {
                        console.log( error );
                    })
                    .finally(() => {
                        this.saving = false;
                    })
            },
            addComponent: function( componentClass ) {
                this.saving = true;
                ContentApi.addComponent( this.contentId, componentClass )
                    .then( output => {
                        this.content = output;
                    })
                    .catch(error => {
                        console.log( error );
                    })
                    .finally(() => {
                        this.saving = false;
                    })
            }
        },
        computed: {
            contentId: function() {

                if( this.content == null ) {
                    if( isNaN( this.id ) || !(this.id > 0) ) {
                        return 0;
                    }

                    return this.id;
                }


                return this.content.id;
            }
        },
        mounted() {
            window.contentEditor = this;

            ComponentsApi.getComponents().then(output => {
                this.components = output;
            })
            .catch(error => {
                console.log(error);
            })

            this.loadLayout();

            if( this.mode )
            this.currentMode = this.mode;
        },
    };
</script>

<style lang="sass">
    @import "./resources/sass/variables.scss"

    .content-editor-button
        background-color: $content-editor-component-color

    .button-red
        background-color: $content-editor-danger

    .content-editor-views
        border: 5px solid $content-editor-component-color
</style>

<style>
    .content-editor-main {

    }

    .content-editor-main-container {
        overflow: hidden;
        margin-left: 0.5rem;
        margin-right: 0.5rem;
    }

    .content-editor-views {

    }

    .content-editor-button {
        color: #fff;
        padding: 15px;
        margin: 1em;
        border-radius: 0.25em;
        text-align: center;
        flex-grow: 1;
        font-family: sans-serif;
        display: inline-block;
        text-decoration: none;
    }

    .trix-button-group--file-tools {
        display: none !important;
    }

    .trix-button--icon-heading-1::before {
        background-image: url( '/images/heading.svg' ) !important;
    }

    .ce-py-5 {
        padding-top: 1.25rem;
        padding-bottom: 1.25rem;
    }

    span.toolbar {
        z-index: 0;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        position: relative;
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
        display: inline-flex;
        border-radius: 0.375rem;
    }
</style>
