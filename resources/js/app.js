//content-editor-laravel app.js

import ContentEditorComponent from './components/ContentEditor.vue';
import LayoutView from './components/LayoutView';
import LayoutViewModules from './components/LayoutViewModules';
import LayoutViewEditor from './components/LayoutViewEditor';
import LayoutViewModal from './components/LayoutViewModal';
import ComponentEditor from './components/ComponentEditor';
import axios from 'axios'

axios.defaults.baseURL = 'https://foodhub.test/content-editor/api'

Vue.component('content-editor', ContentEditorComponent);
Vue.component('component-editor', ComponentEditor);
Vue.component('layout-view', LayoutView);
Vue.component('layout-view-modules', LayoutViewModules);
Vue.component('layout-view-editor', LayoutViewEditor);
Vue.component('layout-view-modal', LayoutViewModal);
