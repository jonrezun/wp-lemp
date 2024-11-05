const { merge } = require('webpack-merge');
const common = require('./webpack.config.common');

module.exports = merge(common, {
    mode: 'production',
    module: {
        rules: [
            // {
            //     test: /\.css$/,
            //     use: [
            //         {
            //             loader: MiniCssExtractPlugin.loader,
            //         },
            //         'css-loader'
            //     ]
            // },
        ]
    },
    // plugins: [
    //     new MiniCssExtractPlugin({
    //         filename: "[name].[hash].css"
    //     })
    // ]
})