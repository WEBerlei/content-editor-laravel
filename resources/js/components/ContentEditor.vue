<template>
    <div>
        <a href="#" @click="showLayout" class="content-editor-button">Layout</a>
        <a href="#" @click="showPreview" class="content-editor-button">Preview</a>
        <layout-view :content="content" :components="components" v-if="!loading && isShowingLayout"></layout-view>
        <preview-view :content="content" v-if="!loading && !isShowingLayout"></preview-view>

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
            isShowingLayout: true,
        }),
        methods: {
            showLayout: function() {
                this.loadLayout();
                this.isShowingLayout = true;
            },
            showPreview: function() {
                this.isShowingLayout = false;
            },
            loadLayout: function() {
                this.loading = true;
                ContentApi.get( this.id ).then(output => {
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

                ContentApi.store( this.content.id, { sections: output } )
                    .then( output => {
                        console.log( output );
                    })
                    .catch(error => {
                        console.log( error );
                    })
                    .finally(() => {

                    })
            }
        },
        computed: {},
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
