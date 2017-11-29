module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    // Composer commands
    composer : {
        options : {
            usePhp: true,
            composerLocation: '/usr/bin/composer'
        },
        apaiio: {
            options: {
                cwd: 'assets/ApaiIO',
                composerLocation: '/usr/local/bin/composer update'
            }
        },
        twitter: {
            options: {
                cwd: 'assets/twitter',
                composerLocation: '/usr/local/bin/composer update'
            }
        }
    }

  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-composer');

  // Default task(s).
    // register task
    grunt.registerTask('default', [
        'composer'
    ]);
};