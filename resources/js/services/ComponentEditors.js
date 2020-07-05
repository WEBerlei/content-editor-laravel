import axios from 'axios'

export default {
    getEditor() {
        return axios.get( '/component-editor/get' )
            .then( response => {
                return response.data;
            })
    }
}
