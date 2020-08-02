<template>
    <div class="content-editor-main">
        <input type="hidden" name="content_id" :value="contentId" />

        <div class="content-editor-toolbar">
        <a href="#" @click.prevent="showData" class="content-editor-button">Data</a>
        <a href="#" @click.prevent="showLayout" class="content-editor-button">Layout</a>
        <a href="#" @click.prevent="showPreview" class="content-editor-button">Preview</a>
        </div>

        <div class="content-editor-views">
        <layout-view :content="content" :components="components" v-if="!loading && currentMode === 'layout'"></layout-view>
        <preview-view :content="content" v-if="!loading && currentMode === 'preview'"></preview-view>
        <data-view :content="content" v-if="!loading && currentMode === 'data'"></data-view>
        </div>
    </div>
</template>

<script>
    import ContentApi from '../services/ContentApi'
    import ComponentsApi from '../services/ComponentsApi'

    export default {
        props: {
            id: { type: String },
            mode: {
                type: String,
                default: "layout",
            },
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
                this.currentMode = "data";
            },
            showLayout: function() {
                this.loadLayout();
                this.currentMode = "layout";
            },
            showPreview: function() {
                this.currentMode = "preview";
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
            save: function() {
                if( this.saving == true )  {
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
            }
        },
        computed: {
            contentId: function() {
                if( this.content == null ) {
                    return this.id;
                }

                return this.content.id;
            }
        },
        mounted() {
            ComponentsApi.getComponents().then(output => {
                this.components = output;
            })
            .catch(error => {
                console.log(error);
            })

            this.loadLayout();

            window.contentEditor = this;

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
</style>
