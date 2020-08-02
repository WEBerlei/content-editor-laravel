<template>
    <div id="component-editor-form" v-html="content">
        <p class="loading" v-if="loading">Loading...</p>
    </div>
</template>

<script>
    import ComponentEditorsApi from '../services/ComponentsApi'
    import ComponentsApi from '../services/ComponentsApi'

    export default {
        props: {
            componentId: null,
            componentClass: null,
        },
        data: () => ({
            content: "",
            loading: true,
        }),
        computed: {},
        methods: {
            save: function() {
                var formData = new FormData()
                var self = this;

                formData.append( 'componentId', this.componentId );
                formData.append( 'componentClass', this.componentClass );

                var inputs = document.getElementsByClassName('content-editor-input');

                for (let i = 0; i < inputs.length; i++) {
                    formData.append( inputs[ i ].name, inputs[ i ].value );
                }

                ComponentsApi.saveEditor( formData ).then(output => {
                    if( output.isValid == true )
                    {
                        self.$emit( 'onSave', output.newPreview );
                    }
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {

                })
            }
        },
        mounted() {
            ComponentEditorsApi.getEditor( this.componentId, this.componentClass ).then(output => {
                this.content = output;
            })
            .catch(error => {
                console.log(error);
                this.content = error;
            })
            .finally(() => {
                this.loading = false;
            })
        }
    };
</script>

<style scoped>

</style>
