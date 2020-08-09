import axios from 'axios'

export default {
    getFiles( componentId ) {
        let data = {
            componentId: componentId,
        }

        return axios.post( '/uploader/files', data )
            .then( response => {
                return response.data;
            })
    },
    remove( componentId, fileId ) {
        let data = {
            componentId: componentId,
            fileId: fileId,
        }

        return axios.post( '/uploader/remove', data )
            .then( response => {
                return response.data;
            })
    }
}
