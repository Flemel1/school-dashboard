/**
 * Dashboard Analytics
 */

'use strict';

(function () {
  let cardColor, headingColor, axisColor, shadeColor, borderColor;

  cardColor = config.colors.cardColor;
  headingColor = config.colors.headingColor;
  axisColor = config.colors.axisColor;
  borderColor = config.colors.borderColor;

  // Presence Chart - Area chart
  // --------------------------------------------------------------------
  const presenceChartEl = document.querySelector('#teacherPresenceChart'),
    presenceChartConfig = {
      series: [
        {
          name: 'Kehadiran',
          data: [24, 21, 30, 22, 42, 26]
        },
        {
          name: 'Tidak Masuk',
          data: [30, 40, 20, 42, 32, 16]
        },
        {
          name: 'Sakit Masuk',
          data: [30, 40, 20, 42, 32, 16]
        }
      ],
      chart: {
        height: 300,
        toolbar: {
          show: false
        },
        type: 'area'
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 2,
        curve: 'smooth'
      },
      legend: {
        position: 'top',
        show: true
      },
      colors: [config.colors.primary, config.colors.secondary, config.colors.info],
      fill: {
        type: 'gradient',
        gradient: {
          shade: shadeColor,
          shadeIntensity: 0.6,
          opacityFrom: 0.5,
          opacityTo: 0.25,
          stops: [0, 95, 100]
        }
      },
      grid: {
        borderColor: borderColor,
        strokeDashArray: 3,
        padding: {
          top: -20,
          bottom: -8,
          // left: -10,
          right: 8
        }
      },
      xaxis: {
        categories: [2018, 2019, 2020, 2021, 2022, 2023],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: true,
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        }
      },
      yaxis: {
        min: 10,
        max: 50,
        tickAmount: 4
      }
    };
  if (typeof presenceChartEl !== undefined && presenceChartEl !== null) {
    const presenceChart = new ApexCharts(presenceChartEl, presenceChartConfig);
    presenceChart.render();
  }

  // Tingakt Kepuasan Siswa Terhadap Guru - Line Chart
  // --------------------------------------------------------------------
  const teacherSatisfiedChartEl = document.querySelector('#teacherSatisfiedChart'),
    teacherSatisfiedChartConfig = {
      series: [
        {
          data: [24, 21, 30, 22, 42, 26]
        }
      ],
      chart: {
        height: 300,
        toolbar: {
          show: false
        },
        type: 'area'
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 2,
        curve: 'smooth'
      },
      legend: {
        position: 'top',
        show: true
      },
      colors: [config.colors.primary],
      fill: {
        type: 'gradient',
        gradient: {
          shade: shadeColor,
          shadeIntensity: 0.6,
          opacityFrom: 0.5,
          opacityTo: 0.25,
          stops: [0, 95, 100]
        }
      },
      grid: {
        borderColor: borderColor,
        strokeDashArray: 3,
        padding: {
          top: -20,
          bottom: -8,
          // left: -10,
          right: 8
        }
      },
      xaxis: {
        categories: [2018, 2019, 2020, 2021, 2022, 2023],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: true,
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        }
      },
      yaxis: {
        min: 10,
        max: 50,
        tickAmount: 4
      }
    };
  if (typeof teacherSatisfiedChartEl !== undefined && teacherSatisfiedChartEl !== null) {
    const teacherSatisfiedChart = new ApexCharts(teacherSatisfiedChartEl, teacherSatisfiedChartConfig);
    teacherSatisfiedChart.render();
  }
})();
