// ACTIVE USERS CHART

document.addEventListener('DOMContentLoaded', function () {
    const chart1 = Highcharts.chart('activeUserLineChart', {
        chart: {
            type: 'bar',
            scrollablePlotArea: {
                minWidth: 400,
                scrollPositionX: 1
            }
        },

        title: {
            text: 'Products Analytical Report'
        },

        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            labels: {
                overflow: 'justify'
            }
        },
        yAxis: {
            type: 'logarithmic',

            title: {
                text: 'Number of Products'
            }
        },

        series: [{
            name: 'Number of Products Monthly',
            data: [0.1, 2, 45, 1001, 200, 0.33, 10000]
        }]

    });
});

document.addEventListener('DOMContentLoaded', function () {
    const chart1 = Highcharts.chart('activeUsersLineChart', {
        chart: {
            type: 'line',
            scrollablePlotArea: {
                minWidth: 400,
                scrollPositionX: 1
            }
        },

        title: {
            text: 'Products Analytical Report'
        },

        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            labels: {
                overflow: 'justify'
            }
        },
        yAxis: {
            type: 'logarithmic',

            title: {
                text: 'Number of Products'
            }
        },

        series: [{
            name: 'Number of Products Monthly',
            data: [0.1, 2, 45, 1001, 200, 0.33, 10000]
        }]

    });
});