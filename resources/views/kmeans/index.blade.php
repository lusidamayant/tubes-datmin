@extends('layouts.app')
@section('content')

<div class="pagetitle">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Clustering Golongan Ekonomi</a></li>
            <li class="breadcrumb-item active"> List</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-header">
        <div class="buttons">
           
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-body table-responsive">
                <table class='table datatable table-striped table-bordered' id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama </th>
                            <!-- <th>Alamat</th>
                            <th>Tanggal Lahir</th> -->
                            <th>Jenis Kelamin </th>
                            <th>Pekerjaan Orang Tua</th>
                            <th>Penghasilan Orang Tua</th>
                            <th>Tanggungan Orang Tua</th>
                            <!-- tampil kolom clustering -->
                            @for($centroidIndex = 0; $centroidIndex < $parameterK; $centroidIndex++)
                                <th>C_{{$centroidIndex}}</th>
                            @endfor
                            <th>Cluster</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clusteringSiswaList as $index => $clusterSiswa)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $clusterSiswa->nama }}</td>
                            <!-- <td>{{ $clusterSiswa->alamat }}</td>
                            <td>{{ date_format(date_create($clusterSiswa->tanggal_lahir), 'd M Y') }}</td> -->
                            <td>{{ $clusterSiswa->jenis_kelamin}}</td>
                            <td>{{ $clusterSiswa->pekerjaan_orang_tua}}</td>
                            <td>Rp. {{ number_format($clusterSiswa->pendapatan_orang_tua) }}</td>
                            <td>{{ $clusterSiswa->jumlah_tanggungan_orang_tua }}</td>
                            <!-- tampil data clustering -->
                            @foreach ($clusterSiswa->hasilClustering['jarakDenganCentroidList'] as $index => $jarakCentroid)
                            <td class="{{ $index == $clusterSiswa->hasilClustering['cluster'] ? 'bg-info text-white':'' }}">
                                {{ number_format($jarakCentroid, 2) }}
                            </td>
                            @endforeach
                            <td>{{ $clusterSiswa->hasilClustering['cluster'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

        <div class="col-12 p-5">
            <div id="chart"></div>
        </div>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    window.addEventListener("DOMContentLoaded", () => {
        let clusteringSiswaList = @json($clusteringSiswaList);
        let centroidList = @json($centroidList);
        let perClusterData = [];

        
        <?php 
                for ($clusterIndex = 0; $clusterIndex < $parameterK; $clusterIndex++) {
                    $perCluster = array_filter($clusteringSiswaList->toArray(), function ($data) use (&$clusterIndex){
                        return $data['hasilClustering']['cluster'] == $clusterIndex;
                    });
                    
                    echo 'perClusterData.push(' . json_encode($perCluster) . ');  ';
                }
        ?>
        
        function mapObjToArray(obj) {
            return Object.keys(obj).map(key => obj[key]); 
        }

        var options = {
            series: [
                
            <?php 
                for ($clusterIndex = 0; $clusterIndex < $parameterK; $clusterIndex++) {
                        echo "         
                            {
                                name: 'Centroid $clusterIndex',
                                data: [[centroidList[$clusterIndex].x1, centroidList[$clusterIndex].x2]],
                            },
                        ";
                }
            ?>
                    
                        
            <?php 
                for ($clusterIndex = 0; $clusterIndex < $parameterK; $clusterIndex++) {
                        echo "
                       
                        { name: 'Cluster $clusterIndex', data: [
                            ...perClusterData.map(mapObjToArray)[$clusterIndex].map(item => {
                                return [
                                    Number(item.pendapatan_orang_tua), 
                                    item.jumlah_tanggungan_orang_tua
                                ]
                            })
                        ], },
                        ";
                }
            ?>
        ],
            chart: {
            height: 350,
            type: 'scatter',
                zoom: {
                    enabled: true,
                    type: 'xy'
                }
            },
            xaxis: {
                title: {  
                    text: "Pendapatan Orang Tua",
                },
            },
            yaxis: {
                title: {  
                    text: "Jumlah Tanggungan Orang Tua",
                },
            },

            markers: {
                size: 8,
                discrete: [{
                seriesIndex: 0,
                dataPointIndex: 1,
                fillColor: '#111',
                strokeColor: '#eee',
                size: 8
                }]
            },
            
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
    });
</script>
@section('scripts')
<script>

</script>
@endsection