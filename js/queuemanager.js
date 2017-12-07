/*
 * Copyright (C) $user$, Inc - All Rights Reserved
 *
 *  <other text>
 * @file        queuemanager.js
 * @author      ignatenkovnikita
 * @date        $date$
 */


Highcharts.setOptions({
    global: {
        useUTC: false
    }
});

// Create the chart
Highcharts.stockChart('container', {
    chart: {
        events: {
            load: function () {

                // set up the updating of the chart each second
                var series_1 = this.series[0];
                var series_2 = this.series[1];
                var series_3 = this.series[2];
                setInterval(function () {
                    $.ajax({
                        url: "ajax",
                        method: "GET",
                        // data: {"id": id},
                        dataType: "json",

                        success: function (data) {
                            console.log(data.time);
                            console.log(data.series_1);
                            series_1.addPoint([(new Date()).getTime(), data.series_1], true, true);
                            series_2.addPoint([(new Date()).getTime(), data.series_2], true, true);
                            series_3.addPoint([(new Date()).getTime(), data.series_3], true, true);

                            $('#workers').html(data.workers.join("<br>"));
                        }

                    });

                    var x = (new Date()).getTime(), // current time
                        y = Math.round(Math.random() * 100);
                    console.log(x);
                    // series.addPoint([x, y], true, true);
                }, 1000);
            }
        }
    },

    rangeSelector: {
        buttons: [{
            count: 1,
            type: 'minute',
            text: '1M'
        }, {
            count: 5,
            type: 'minute',
            text: '5M'
        }, {
            type: 'all',
            text: 'All'
        }],
        inputEnabled:
            false,
        selected:
            0
    },

    title: {
        text: 'Queue Stat'
    }
    ,

    exporting: {
        enabled: false
    }
    ,

    series: [{
        name: 'Waiting',
        data: (function () {
            // generate an array of random data
            var data = [],
                time = (new Date()).getTime(),
                i;

            for (i = -5; i <= 0; i += 1) {
                data.push([
                    time + i * 1000,
                    Math.round(0)
                ]);
            }
            return data;
        }())
    },
        {
            name: 'Delayed',
            data: (function () {
                // generate an array of random data
                var data = [],
                    time = (new Date()).getTime(),
                    i;

                for (i = -5; i <= 0; i += 1) {
                    data.push([
                        time + i * 1000,
                        Math.round(0)
                    ]);
                }
                return data;
            }())
        },
        {
            name: 'Reserved',
            data: (function () {
                // generate an array of random data
                var data = [],
                    time = (new Date()).getTime(),
                    i;

                for (i = -5; i <= 0; i += 1) {
                    data.push([
                        time + i * 1000,
                        Math.round(0)
                    ]);
                }
                return data;
            }())
        }
    ]
})
;

