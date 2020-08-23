//content-editor-laravel app.js

import ContentEditor from './components/ContentEditor.vue';
import DataView from './components/DataView';
import PreviewView from './components/PreviewView';
import LayoutView from './components/LayoutView';
import LayoutViewComponents from './components/LayoutViewComponents';
import LayoutViewEditor from './components/LayoutViewEditor';
import LayoutViewModal from './components/LayoutViewModal';

import ComponentEditor from "./components/ComponentEditor";

import ContentEditorComponent from './components/ContentEditorComponent';
import ContentEditorSection from './components/ContentEditorSection';

import Uploader from './components/Uploader';

window.contentEditorBaseUrl = '/content-editor/api'

Vue.component('content-editor', ContentEditor);
Vue.component('data-view', DataView);
Vue.component('preview-view', PreviewView);
Vue.component('layout-view', LayoutView);
Vue.component('layout-view-components', LayoutViewComponents);
Vue.component('layout-view-editor', LayoutViewEditor);
Vue.component('layout-view-modal', LayoutViewModal);

Vue.component('component-editor', ComponentEditor);
Vue.component('content-editor-component', ContentEditorComponent);
Vue.component('content-editor-section', ContentEditorSection);

Vue.component('uploader', Uploader);
