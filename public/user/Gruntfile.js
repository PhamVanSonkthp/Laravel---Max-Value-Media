module.exports = function(grunt) {
  const sass = require('node-sass');
    grunt.initConfig({
		sass: {
			options: {
                implementation: sass,
                includePaths: ['node_modules/bootstrap-sass/assets/stylesheets']
            },
            dist: {
              options: {
                outputStyle: 'compressed'
              },
              files: [{
                  'dist/assets/css/main.css':                     'scss/main.scss',  							/* 'All main SCSS' */
                  'dist/assets/css/fullcalendar.css':             ["node_modules/fullcalendar/main.min.css"],
                  "dist/assets/css/morris.min.css":               ["node_modules/morris.js/morris.css"],
                  "dist/assets/css/dataTables.min.css":           ["node_modules/datatables.net-bs5/css/dataTables.bootstrap5.css"],
              }]  
            }
        },
        uglify: {
          my_target: {
            files: {
                'dist/assets/bundles/libscripts.bundle.js':                ['node_modules/jquery/dist/jquery.min.js','node_modules/bootstrap/dist/js/bootstrap.bundle.js'], /* main js*/
                'dist/assets/bundles/vendorscripts.bundle.js':             ['dist/assets/plugins/bootstrap-select/js/bootstrap-select.js','dist/assets/plugins/jquery-slimscroll/jquery.slimscroll.js','dist/assets/plugins/node-waves/waves.js','dist/assets/plugins/jquery-sparkline/jquery.sparkline.js','dist/assets/plugins/jquery-countto/jquery.countTo.js'],
                'dist/assets/bundles/mainscripts.bundle.js':               ['js/admin.js','js/demo.js'], /*coman js*/

                'dist/assets/bundles/fullcalendarscripts.bundle.js':       ["node_modules/fullcalendar/main.min.js"],
                'dist/assets/bundles/morrisscripts.bundle.js':             ["node_modules/raphael/raphael.js","node_modules/morris.js/morris.js"],
                'dist/assets/bundles/knob.bundle.js':                      ["node_modules/jquery-knob/dist/jquery.knob.min.js"], /* knob js*/
                'dist/assets/bundles/sparkline.bundle.js':                 ["node_modules/jquery-sparkline/jquery.sparkline.js"],
                'dist/assets/bundles/flotscripts.bundle.js':               ["node_modules/flot-charts/jquery.flot.js","node_modules/flot-charts/jquery.flot.resize.js","node_modules/flot-charts/jquery.flot.pie.js","node_modules/flot-charts/jquery.flot.categories.js","node_modules/flot-charts/jquery.flot.time.js","node_modules/flot-charts/jquery.flot.selection.js"], /* Flot Chart js*/
                'dist/assets/bundles/datatablescripts.bundle.js':          ["node_modules/datatables.net/js/jquery.dataTables.js","node_modules/datatables.net-bs5/js/dataTables.bootstrap5.js","node_modules/datatables.net-responsive/js/dataTables.responsive.js"], /* Jquery DataTable Plugin Js  */
                "dist/assets/bundles/select2.bundle.js":                   ["node_modules/select2/dist/js/select2.js"],
                'dist/assets/bundles/chartscripts.bundle.js':              ['dist/assets/plugins/chartjs/Chart.bundle.js'], /* ChartJs js*/
                'dist/assets/bundles/jvectormap.bundle.js':                ['dist/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js','dist/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'], 
                'dist/assets/bundles/countTo.bundle.js':                   ['dist/assets/plugins/jquery-countto/jquery.countTo.js'], /* CountTo js*/                
                'dist/assets/bundles/footable.bundle.js':                  ['dist/assets/plugins/footable-bootstrap/js/footable.js'],
              }
            }
        }                
    });
    grunt.loadNpmTasks("grunt-sass");
    grunt.loadNpmTasks('grunt-contrib-uglify');
    
    grunt.registerTask("buildcss", ["sass"]);	
    grunt.registerTask("buildjs", ["uglify"]);
};


