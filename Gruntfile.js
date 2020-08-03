'use strict';
module.exports = function(grunt) {

	// load all grunt tasks matching the `grunt-*` pattern
	require('load-grunt-tasks')(grunt);

    var files = [
        // {
        //     expand: true,
        //     cwd: 'media/less',
        //     src: ['*.less'],
        //     dest: 'media/css/',
        //     ext: '.css',
        //     extDot: 'last'
        // },
        // {
        //     expand: true,
        //     cwd: 'media/less/vendor',
        //     src: ['*.less'],
        //     dest: 'media/css/vendor/',
        //     ext: '.css',
        //     extDot: 'last'
        // },
        {
            expand: true,
            cwd: 'wp-content/themes/aloexpert/css/',
            src: ['*.less'],
            dest: 'wp-content/themes/aloexpert/css/',
            ext: '.css',
            extDot: 'last'
        }
    ];

	grunt.initConfig({
        connect: {
            server: {
                options: {
                    port: 8888,
                    hostname: '*',
                    livereload: true,
                    onCreateServer: function(server, connect, options) {
                        var io = require('socket.io').listen(server);
                        io.sockets.on('connection', function(socket) {
                        // do something with socket
                        });
                    }
                }
            }
        },
		watch: {
			options: {
			  livereload: true, // true will refresh brwoser
			},
			styles: {
				files: ['wp-content/themes/aloexpert/css/*.less'],
				tasks: ['newer:less:development']
			},
		    reload: {
		        'files': 'wp-content/themes/aloexpert/css/*.css',
		        'options': {
		            livereload: true
		        }
		    }
		},
		// less - automatically compiles less
		less: {
            development: {
                options: {
                	livereload: true,
                    compress: false,
                    yuicompress: true,
                    optimization: 2
                },
                files: files
            },
            production: {
                options: {
                	livereload: true,
                    compress: true,
                    yuicompress: true,
                    optimization: 2
                },
                files: files
            },
			// dist: {
			// 	options: {
			// 		// I like my css compressed. You can change this to 'expand' for easier to read css
			// 		style: 'compressed',
			// 	},
			// 	// files: {
			// 	// 	'wp-content/themes/aloexpert/css/style/style-v1.css': 'wp-content/themes/aloexpert/css/style/style-v1.less'
			// 	// }
		 //        files: files,
			// }
		}
	});


    // grunt.event.on('watch', function(action, filepath){
    //     // ignore include files, TODO: have naming convention
    //     // if an include file has been changed, all files will be re-compiled
    //     if(filepath.indexOf('.inc.') > -1)
    //         return true;

    //     // might not be the most efficient way to do this
    //     var srcDir = filepath.split('/');
    //     var filename = srcDir[srcDir.length - 1];
    //     delete srcDir[srcDir.length - 1];
    //     srcDir = srcDir.join('/');
    //     var destDir = srcDir.replace(/less/g, 'css');

    //     grunt.config('less.development.files', [{
    //         src: filename,
    //         dest: destDir,
    //         expand: true,
    //         cwd: srcDir,
    //         ext: '.css',
    //         extDot: 'last'
    //     }]);
    // });
    grunt.loadNpmTasks('grunt-contrib-connect');
	grunt.loadNpmTasks('grunt-newer');

	// register tasks, change names of default grunt commands. 
	grunt.registerTask('deploy', ['less:development']);
	grunt.registerTask('default',['watch', 'connect']);

};
