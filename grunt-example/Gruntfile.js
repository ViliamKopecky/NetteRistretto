module.exports = function (grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    esteWatch: {
      options: {
        livereload: { enabled: false  },
        dirs: [
          'app',
          'app/**',
          'www',
          'www/**'
        ]
      },
      less: function(filepath) {
        return ['less'];
      },
      css: function(filepath) {
        return ['ristretto:reloadStyles'];
      },
      '*': function(filepath) {
        return ['ristretto:reload'];
      }
    },
    ristretto: {
      options: {
        port: 2014
      }
    },
    less: {
      production: {
        options: { yuicompress: true  },
        files: { 'www/css/screen.css': 'www/less/screen.less' }
      }
    }
  });
  
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-ristretto');
  grunt.loadNpmTasks('grunt-este-watch');

  grunt.registerTask('default', ['ristretto', 'ristretto:reload', 'esteWatch']);
};