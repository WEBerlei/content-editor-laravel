//content-editor-laravel app.js

import ContentEditorComponent from './components/ContentEditorComponent.vue';
import LayoutView from './components/LayoutView';
import LayoutViewModules from './components/LayoutViewModules';
import LayoutViewEditor from './components/LayoutViewEditor';

Vue.component('content-editor', ContentEditorComponent);
Vue.component('layout-view', LayoutView);
Vue.component('layout-view-modules', LayoutViewModules);
Vue.component('layout-view-editor', LayoutViewEditor);
