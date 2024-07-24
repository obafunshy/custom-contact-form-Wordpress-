const path = require('path');

module.exports = {
    mode: 'development',
    entry: './js/simple-contact-form-react.js', // Path to your entry file
    output: {
        path: path.resolve(__dirname, 'js'), // Output directory
        filename: 'simple-contact-form-react.bundle.js', // Output file name
        clean: true
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env', '@babel/preset-react'],
                    },
                },
            },
        ],
    },
    resolve: {
        extensions: ['.js'], // Resolve .js extensions
    },
    devtool: 'source-map', // or 'production' depending on your needs
};
