import axios from 'axios'

export default {
    getEditor( componentId, componentClass ) {
        let data = {
            componentId: componentId,
            componentClass: componentClass
        }

        return axios.post( '/component-editor', data )
            .then( response => {
                return response.data;
            })
    },
    saveEditor( formData ) {

        return axios.post( '/component-editor/save', formData )
            .then( response => {
                return response.data;
            })
    },
    getComponents() {
        return axios.get( '/components' )
            .then( response => {
                return response.data;
            })
    }
}
