<template>
    <div class="layout-view">
        <layout-view-editor></layout-view-editor>
        <layout-view-modules></layout-view-modules>
    </div>
</template>

<script>
    import Sortable from 'sortablejs';

    export default {
        props: {},
        data: () => ({}),
        computed: {},
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

            var dropzone = Sortable.create(document.getElementById('module-dropzone'), {
                group: {
                    name: "modules",
                },
                onAdd: function (/**Event*/evt) {
                    let newClone = evt.to.cloneNode();

                    evt.to.parentElement.appendChild( newClone );
                },
                fallbackOnBody: true,
                animation: 150,
            });

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
        }
    };
</script>

<style scoped>
    .layout-view {
        display: flex;

        width: 100%;
        border: 1px solid #000;
    }
</style>
