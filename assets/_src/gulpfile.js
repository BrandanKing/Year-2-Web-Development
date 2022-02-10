/// <binding BeforeBuild='deploy' ProjectOpened='watch' />
"use strict";

// REFERENCES
const 	gulp			=	require("gulp"),
    plumber			=	require("gulp-plumber"),
    notify			=	require("gulp-notify"),
    webpack			=	require("webpack-stream"),
    TerserPlugin	=	require("terser-webpack-plugin");

let		paths;

paths	=	{

    // INPUTS
    js_in: 'js/**/*.js',

    // CHILD OUTPUTS
    js_out: '../_dst/js',
};

// SCRIPTS COMPILER
gulp.task("scripts", (done) => {
    gulp
        .src(paths.js_in)
        .pipe(
            plumber({
                errorHandler: function (err) {
                    notify.onError({
                        title: "Gulp error in " + err.plugin,
                        message: err.toString(),
                    })(err);
                },
            })
        )
        .pipe(
            webpack({
                mode: "production",
                optimization: {
                    usedExports: true,
                    minimizer: [new TerserPlugin()],
                },
                output: {
                    filename: "index.js",
                },
                devtool: "source-map",
                resolve: {
                    extensions: [".js"],
                },
                module: {
                    rules: [
                        {
                            test: /\.js$/,
                            exclude: /node_modules/,
                            use: [
                                {
                                    loader: "babel-loader",
                                    options: {
                                        presets: [
                                            [
                                                "@babel/preset-env",
                                                {
                                                    modules: false,
                                                    useBuiltIns: "usage",
                                                    corejs: 3,
                                                    targets: "> 0.25%, not dead",
                                                },
                                            ],
                                        ],
                                    },
                                },
                            ],
                        },
                    ],
                },
            })
        )
        .pipe(gulp.dest(paths.js_out));

    return done();

});


// WATCH TASK
gulp.task("watch", () => {
    gulp.watch(paths.js_in, gulp.series("scripts"))
});

gulp.task('default', gulp.series('scripts', 'watch'));