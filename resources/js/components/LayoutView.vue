<template>
    <div class="layout-view">
        <layout-view-modal ref="moduleModal"></layout-view-modal>
        <layout-view-editor></layout-view-editor>
        <layout-view-modules></layout-view-modules>

    </div>
</template>

<script>
    import Sortable from 'sortablejs';
    import LayoutViewModal from "./LayoutViewModal";

    export default {
        components: {
            'layout-view-modal': LayoutViewModal
        },
        props: {},
        data: () => ({ }),
        computed: {},
        methods: {
            makeDropzone(el) {
                return Sortable.create(el, {
                    group: {
                        name: "modules",
                    },
                    onAdd: function (/**Event*/evt) {
                        evt.item.ondblclick = function( event ) {
                            window.contentEditorLayout.$refs.moduleModal.open();
                        };

                        if( window.contentEditorLayout.isLastSectionEmpty() == false ) {
                            let newClone = evt.to.cloneNode();

                            evt.to.parentElement.appendChild(newClone);

                            window.contentEditorLayout.makeDropzone(newClone);
                        }
                    },
                    onRemove: function() {
                        window.contentEditorLayout.trimSections();
                    },
                    fallbackOnBody: true,
                    animation: 150,
                });
            },
            isLastSectionEmpty() {
                return document.getElementById('content-editor').lastElementChild.childElementCount == 0;
            },
            trimSections() {
                while( document.getElementById('content-editor').childElementCount > 1
                    && this.isLastSectionEmpty() == true
                    && document.getElementById('content-editor').lastElementChild.previousElementSibling.childElementCount == 0 )
                {
                    document.getElementById('content-editor').lastElementChild.remove();
                }
            }
        },
        mounted() {
            var sortable = Sortable.create(document.getElementById('modules-list'), {
                group: {
                    name: "modules",
                    pull: 'clone',
                    put: false,
                },
                sort: false,
                animation: 150,
            });

            var dropzone = this.makeDropzone( document.getElementById('module-dropzone') );

            var trash = Sortable.create(document.getElementById('module-trash'), {
                group: {
                    name: "modules",
                    pull: false,
                },
                onAdd: function (/**Event*/evt) {
                    evt.item.remove();
                },
                sort: false,
                animation: 150,
            });

            window.contentEditorLayout = this;
        }
    };
</script>

<style scoped>
    .layout-view {
        position: relative;
        display: flex;

        width: 100%;
        border: 1px solid #000;
    }
</style>
