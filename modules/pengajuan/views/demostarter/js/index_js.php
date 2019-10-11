<script type="text/javascript">
    /*
     Document: base_pages_dashboard.js
     Author: Rustheme
     Description: Custom JS code used in Dashboard Page (index.html)
     */

    var BasePagesDashboard = function () {
        // Chart.js Chart: http://www.chartjs.org/docs
        var initDashChartJS = function () {

            // Get Chart Containers
            var $dashChartLinesCnt3 = jQuery('.js-chartjs-lines3')[0].getContext('2d');

            // Set global chart options
            var $globalOptions = {
                showScale: false,
                tooltipCornerRadius: 2,
                maintainAspectRatio: false,
                responsive: true,
                animation: false,
                pointDotStrokeWidth: 2,
            };

            // Lines Chart Data 4
		var $dashChartLinesData4 = {
			labels: ['2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014'],
			datasets: [
				{
					label: 'This Week',
					strokeColor: App.colors.blue,
					pointColor: '#fff',
					pointStrokeColor: App.colors.blue,
					data: [20, 25, 40, 30, 45, 40, 55, 40, 48, 40, 42, 50]
				}
			]
		};

          // Init Lines Chart 4
		$dashChartLines4 = new Chart( $dashChartLinesCnt3 ).Line( $dashChartLinesData4, {
			scaleShowHorizontalLines: false,
			bezierCurve: false,
			datasetFill: false,
			pointDotStrokeWidth: 2,
			scaleFontFamily: "'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif",
			scaleFontColor: App.colors.text_muted,
			scaleFontStyle: '500',
			tooltipTitleFontFamily: "'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif",
			tooltipCornerRadius: 2,
			maintainAspectRatio: false,
			responsive: true,
			animation: false,
		});

            
        };

        return {
            init: function () {
                // Init ChartJS chart
                initDashChartJS();
            }
        };
    }();

// Initialize when page loads
    jQuery(function () {
        BasePagesDashboard.init();
    });
</script>