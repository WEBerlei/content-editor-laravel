<template>
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="bg-gray-50 border-b border-gray-200 px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Layout
            </h3>
        </div>
        <div class="">
            <div class="layout-view">
                <layout-view-modal ref="moduleModal"></layout-view-modal>
                <layout-view-editor :content="content" :components="components"></layout-view-editor>
                <layout-view-components :components="components"></layout-view-components>
            </div>
        </div>
    </div>
</template>

<script>
    import Sortable from 'sortablejs';
    import LayoutViewModal from "./LayoutViewModal";

    export default {
        components: {
            'layout-view-modal': LayoutViewModal
        },
        props: {
            content: null,
            components: null,
        },
        data: () => ({ }),
        computed: {},
        methods: {
            makeDropzone(el) {
                return Sortable.create(el, {
                    group: {
                        name: "components",
                    },
                    onAdd: function (/**Event*/evt) {
                        //if( evt.item.getAttribute( "component-id" ) == "0" ) {
                            evt.item.setAttribute("newly-created", "true");
                        //}

                        //console.log( evt.to.getAttribute( "section-id" ) + " - " + evt.from.getAttribute( "section-id" ) );
                        evt.item.ondblclick = function( event ) {
                            window.contentEditorLayout.$refs.moduleModal.open( evt.item, this.getAttribute( 'component-id'), this.getAttribute( 'component-class') );
                        };
                    },
                    onSort: function() {
                        window.contentEditor.save();
                    },
                    onRemove: function() {

                    },

                    fallbackOnBody: true,
                    animation: 150,
                });
            },
            isLastSectionEmpty() {
                return document.getElementById('content-editor').lastElementChild.childElementCount == 0;
            }
        },
        mounted() {
            var sortable = Sortable.create(document.getElementById('components-list'), {
                group: {
                    name: "components",
                    pull: 'clone',
                    put: false,
                },
                sort: false,
                animation: 150,
            });

            var trash = Sortable.create(document.getElementById('component-trash'), {
                group: {
                    name: "components",
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
    }
</style>
