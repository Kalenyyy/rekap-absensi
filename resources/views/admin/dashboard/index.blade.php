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
                Dashboard
            </a>
        </div>
    </li>
@endsection

@section('modal')
@endsection

@section('content')
    <div class="flex justify-center items-center mt-12">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-screen-lg flex flex-col mx-auto sm:ml-24 sm:-mt-16 lg:ml-40 lg:-mt-15">
            <div class="text-center border-b-2 border-[#667BC3] pb-4 mb-3">
                <h1 class="text-4xl font-bold text-[#667BC3]">
                    SELAMAT DATANG DI WEBSITE ABSENSI FACE RECOGNITION SMK WIKRAMA BOGOR
                </h1>
            </div>
            <div class="flex justify-end mb-4">
                <select class="bg-blue-400 text-white-700 px-4 py-2 rounded-lg">
                  @foreach ($ruangan as $item)
                  <option value="Selected" selected disabled hidden>Selected</option>
                  <option value="ruang1">{{ $item->nama_ruangan }}</option>
                  @endforeach
                    
                </select>
            </div>
            <div>
                <div id="chart"></div>
            </div>
        </div>
    </div>

    <script>
      var siswaData = @json($siswa->pluck('count'));
      var siswaDates = @json($siswa->pluck('date'));
  
      var options = {
          series: [{
              name: 'Absensi Siswa',
              data: siswaData
          }],
          chart: {
              height: 350,
              type: 'line',
          },
          xaxis: {
              categories: siswaDates,
              labels: {
                  formatter: function(value) {
                      var date = new Date(value);
                      return date.toLocaleDateString('id-ID', {
                          day: 'numeric', month: 'short'
                      });
                  }
              }
          },
          title: {
              text: 'Grafik Absensi Siswa',
              align: 'left',
              style: {
                  fontSize: "16px",
                  color: '#666'
              }
          },
          stroke: {
              width: 5,
              curve: 'smooth'
          },
          fill: {
              type: 'gradient',
              gradient: {
                  shade: 'dark',
                  gradientToColors: ['#FDD835'],
                  shadeIntensity: 1,
                  type: 'horizontal',
                  opacityFrom: 1,
                  opacityTo: 1,
                  stops: [0, 100, 100, 100]
              }
          }
      };
  
      var chart = new ApexCharts(document.querySelector("#chart"), options);
      chart.render();
  </script>
  
@endsection
