import axios from 'axios'

export default {
    get(content_id) {
        return axios.get( '/content/' + content_id )
            .then( response => {
                return response.data;
            })
    },
    render(content_id) {
        return axios.get( '/content/' + content_id + '/render' )
            .then( response => {
                return response.data;
            })
    },
    store(content_id, data) {
        return axios.post( '/content/' + content_id + '/store', data )
            .then( response => {
                return response.data;
            })
    }
}
