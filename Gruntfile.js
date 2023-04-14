module.exports = function(grunt) {

    const sass = require('node-sass');
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        // concat:{
        //     js:{
        //         src: ['src/js/jquery.js','src/js/bootstrap.js','src/js/validated.js', 'src/js/slick.js', 'src/js/shuffle.js'],
        //         dest: 'dist/js/scripts.js'
        //     }
        // },
        // uglify:{
        //     build:{
        //         files: [{
        //             src:'dist/js/scripts.js',
        //             dest: 'dist/js/scripts.js'
        //         }]
        //     }
        // },
        cssmin: {
            options: {
              mergeIntoShorthands: false,
              roundingPrecision: -1
            },
            target: {
              files: {
                'assets/css/styles.css': ['assets/vendor/bootstrap/bootstrap.min.css', 'assets/css/raw.css']
              }
            }
        },
        sass: {
            options: {
                implementation: sass,
                sourceMap: false
            },
            dist: {
                files: {
                    'assets/css/raw.css': ['assets/include/scss/unify.scss','assets/include/scss/custom.scss']
                }
            }
        }
    });

    // grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    //grunt.loadNpmTasks('grunt-contrib-uglify-es');
    grunt.loadNpmTasks('grunt-sass');
    grunt.registerTask('default', ['sass','cssmin']);

  };