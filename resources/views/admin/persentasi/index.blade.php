@extends('layouts.template_fix')

@section('top_content')
    <li>
        <div class="flex items-center">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
            <a href="#b"
                class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                Persentase
            </a>
        </div>
    </li>
@endsection

@section('modal')
@endsection

@section('content')
    <div class="flex justify-center items-center mt-12">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-screen-lg flex flex-col mx-auto sm:ml-16 sm:-mt-16 lg:ml-32 lg:-mt-15">
            <div class="text-center border-b-2 border-[#667BC3] pb-4 mb-3">
                <h1 class="text-4xl font-bold text-[#667BC3]">
                    SELAMAT DATANG DI WEBSITE ABSENSI FACE RECOGNITION SMK WIKRAMA BOGOR
                </h1>
            </div>
            <div>
                <div id="chart"></div>
            </div>
        </div>
    </div>

    <script>
        // Ambil data siswa dari PHP ke JavaScript
var siswaData = @json($siswa);

// Pisahkan tanggal dan jumlah untuk ditampilkan di chart
var dates = siswaData.map(function(item) {
    return item.date;
});
var counts = siswaData.map(function(item) {
    return item.count;
});

var options = {
  series: [{
      name: 'Jumlah Kehadiran',
      data: counts
  }],
  chart: {
      height: 350,
      type: 'bar',
  },
  plotOptions: {
      bar: {
          borderRadius: 10,
          dataLabels: {
              position: 'top', // top, center, bottom
          },
      }
  },
  dataLabels: {
      enabled: true,
      formatter: function (val) {
          return val;
      },
      offsetY: -20,
      style: {
          fontSize: '12px',
          colors: ["#304758"]
      }
  },
  xaxis: {
      categories: dates, 
      position: 'top',
      axisBorder: {
          show: false
      },
      axisTicks: {
          show: false
      },
      tooltip: {
          enabled: true,
      }
  },
  yaxis: {
      axisBorder: {
          show: false
      },
      axisTicks: {
          show: false,
      },
      labels: {
          show: true,
          formatter: function (val) {
              return val;
          }
      }
  },
  title: {
      text: 'Kehadiran Siswa per Tanggal',
      floating: true,
      offsetY: 330,
      align: 'center',
      style: {
          color: '#444'
      }
  }
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();

    </script>
@endsection
