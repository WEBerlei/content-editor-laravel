<template>
    <div>
        <input type="hidden" name="content_id" :value="contentId" />
        <a href="#" @click.prevent="showLayout" class="content-editor-button">Layout</a>
        <a href="#" @click.prevent="showPreview" class="content-editor-button">Preview</a>
        <layout-view :content="content" :components="components" v-if="!loading && displayMode === 0"></layout-view>
        <preview-view :content="content" v-if="!loading && displayMode === 1"></preview-view>
        <!--<data-view :content="content" v-if="!loading && displayMode === 2"></data-view>-->

    </div>
</template>

<script>
    import ContentApi from '../services/ContentApi'
    import ComponentsApi from '../services/ComponentsApi'

    export default {
        props: {
            id: null,
        },
        data: () => ({
            content: null,
            components: null,
            loading: true,
            saving: false,
            displayMode: 0,
        }),
        methods: {
            showData: function() {
                this.displayMode = 2;
            },
            showLayout: function() {
                this.loadLayout();
                this.displayMode = 0;
            },
            showPreview: function() {
                this.displayMode = 1;
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
        },
    };
</script>

<style>
    .content-editor-button {
        background-color: #3da4ab;
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

    .button-red {
        background-color: #ab3d3d;
    }
</style>
