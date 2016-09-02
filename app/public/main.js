;(function($) {
  $(function () {
    // funnel

    drawConversion($('#funnel'));
    drawPurchases($('#area'));
    drawPurchasesPercent($('#pie'));
    drawAverage($('#chart'));
  });

  var drawConversion = function (element) {
    var data = $(element).data('series');
    var res;
    if (!data) {
      throw new Error('Data must be set');
    }
    data = Object.keys(data).map(function(key) {
      return [key, data[key]];
    });
    $(element).highcharts({
        chart: {
            type: 'funnel',
            marginRight: 150
        },
        title: {
            text: 'Conversion',
            x: -50
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b> ({point.y:,.0f})',
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                    softConnector: true
                },
                neckWidth: '50%',
                neckHeight: '25%'
            }
        },
        legend: {
            enabled: false
        },
        series: [{
            name: 'Unique users',
            data: data
        }]
    });
  };
  var drawPurchases = function (element) {
    var data = $(element).data('series');
    if (!data) {
      throw new Error('Data must be set')
    }
    var series = Object.keys(data).map(function(key) {
      return parseFloat(data[key]);
    });
    $(element).highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Specifics of purchase, depending on the platform over the past 30 days'
        },
        xAxis: {
            categories: Object.keys(data),
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Purchases',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Purchases',
            data: series
        }]
    });
  }
  var drawPurchasesPercent = function(element) {
    var data = $(element).data('series');
    if (!data) {
      throw new Error('Data must be set!');
    }

    data = Object.keys(data).map(function(key) {
      return {
        name: key,
        y: parseFloat(data[key])
      };
    });
    $(element).highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Specifics of purchase, depending on the platform over the past 30 days'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: data
        }]
    });
  }
  var drawAverage = function(element) {
    var data = $(element).data('series');
    if (!data) {
      throw new Error('Data must be set!');
    }
    var series = Object.keys(data.data).map(function(key) {
      return {
        name: key,
        data: data.data[key]
      }
    });
    $(element).highcharts({
       chart: {
           type: 'column'
       },
       title: {
           text: 'Monthly Average Days Beetween Registered and Purchase'
       },
       xAxis: {
           categories: data.title,
           crosshair: true
       },
       yAxis: {
           min: 0,
           title: {
               text: 'Days'
           }
       },
       tooltip: {
           headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
           pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
               '<td style="padding:0"><b>{point.y:.1f} days</b></td></tr>',
           footerFormat: '</table>',
           shared: true,
           useHTML: true
       },
       plotOptions: {
           column: {
               pointPadding: 0.2,
               borderWidth: 0
           }
       },
       series: series
   });
  }
})(jQuery);
