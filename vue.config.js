const path = require('path');

module.exports = {
    publicPath: '',
    css: {
        loaderOptions: {
            sass: {
                data: `@import "./resources/sass/variables.scss";`
            }
        }
    }
};
