import axios from 'axios'

export default {
    get(content_id) {
        return axios.get( window.contentEditorBaseUrl + '/content/' + content_id )
            .then( response => {
                return response.data;
            })
    },
    render(content_id) {
        return axios.get( window.contentEditorBaseUrl + '/content/' + content_id + '/render' )
            .then( response => {
                return response.data;
            })
    },
    store(content_id, data) {
        return axios.post( window.contentEditorBaseUrl + '/content/' + content_id + '/store', data )
            .then( response => {
                return response.data;
            })
    },
    addComponent(content_id, componentClass) {
        var data = new FormData();
        data.append( 'componentClass', componentClass );

        return axios.post( window.contentEditorBaseUrl + '/content/' + content_id + '/addComponent', data )
            .then( response => {
                return response.data;
            })
    }
}
