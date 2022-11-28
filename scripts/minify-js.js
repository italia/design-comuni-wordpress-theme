const UglifyJS = require("uglify-js");
const {walk} = require('./utils');
const fs = require('fs');

walk('./assets-src/js', (path) => {
    if (path.endsWith('.js')) {
        const minified = UglifyJS.minify(fs.readFileSync(path, 'utf8'))
        if (minified.code) {
            fs.writeFileSync(path.replace('assets-src', 'assets'), minified.code)
        }
    }
});
