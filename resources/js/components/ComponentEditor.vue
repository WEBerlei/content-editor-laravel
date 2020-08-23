<template>
    <div id="component-editor-form">
        <div v-html="content">

        </div>
        <p class="loading" v-if="loading">Loading...</p>
    </div>
</template>

<script>
    import ComponentEditorsApi from '../services/ComponentsApi'
    import ComponentsApi from '../services/ComponentsApi'

    import Dropzone from "../dropzone.min"
    import axios from "axios";
    import UploaderApi from "../services/UploaderApi";

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

                this.$nextTick(() => {
                    var dropzones = document.getElementsByClassName( 'myDropzone' );

                    if( dropzones.length > 0 ) {
                        var componentId = this.componentId;

                        for( var di = 0; di < dropzones.length; ++di ) {
                            if( dropzones[di].classList.contains( 'dz-clickable') ) {
                                continue;
                            }

                            var newMaxFiles = dropzones[di].getAttribute( 'max-files' );

                            if( newMaxFiles === undefined ) {
                                newMaxFiles = 1;
                            }

                            var myDropzone = new Dropzone(dropzones[di],
                                {
                                    url: window.contentEditorBaseUrl + "/uploader/post",
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                    },
                                    addRemoveLinks: true,
                                    dictDefaultMessage: 'Datei per Drag and Drop hier hinziehen',
                                    dictCancelUpload: 'Upload abbrechen',
                                    dictUploadCanceled: 'Abgebrochen',
                                    dictCancelUploadConfirmation: 'Den Upload wirklich abbrechen?',
                                    dictRemoveFile: 'Datei entfernen',
                                    dictRemoveFileConfirmation: 'Die Datei wirklich wieder entfernen?',
                                    dictMaxFilesExceeded: 'Es ist nur eine Datei erlaubt.',
                                    maxFiles: newMaxFiles,
                                    realMaxFiles: newMaxFiles,
                                    existingFiles: 0,
                                    params: {
                                        'componentId': this.componentId,
                                    },
                                    maxfilesreached: function (file) {
                                        console.log( 'maxfilesreached' );
                                        this.removeFile(file);
                                    },
                                    success: function (file, response) {
                                        file.newName = response.name;
                                        file.id = response.id;
                                    },
                                    removedfile: function (file) {
                                        if (file.id !== undefined) {
                                            UploaderApi.remove(componentId, file.id).then(output => {

                                            });

                                            if( file.existing === true ) {
                                                this.options.existingFiles--;
                                                this.options.maxFiles = this.options.realMaxFiles - this.options.existingFiles;
                                            }
                                        }

                                        var _ref;
                                        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                                    },
                                    init: function () {
                                        this.on("success", function (file) {
                                            //this.options.currentFiles++;
                                            //this.options.maxFiles = this.options.realMaxFiles - this.options.currentFiles;
                                            //console.log( "success. new maxFiles: " + this.options.maxFiles );
                                        });

                                        var thisDropzone = this;

                                        UploaderApi.getFiles(componentId).then(output => {
                                            for (var i = 0; i < output.length; i++) {
                                                var mockFile = {
                                                    id: output[i].id,
                                                    name: output[i].name,
                                                    size: output[i].size,
                                                    existing: true,
                                                };

                                                thisDropzone.displayExistingFile(mockFile, "", null, null, false);
                                                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, output[i].url);
                                            }

                                            var progress = document.getElementsByClassName('dz-progress');
                                            for (var j = 0; j < progress.length; j++) {
                                                progress[j].style.display = 'none';
                                            }

                                            thisDropzone.options.existingFiles = output.length;
                                            thisDropzone.options.maxFiles = thisDropzone.options.realMaxFiles - thisDropzone.options.existingFiles;
                                        });
                                    }
                                });
                        }
                    }
                });
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
