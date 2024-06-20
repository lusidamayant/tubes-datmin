<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;

class KMeansController extends Controller
{
    public function index() {
        $baseModel = new Student();
        $clusteringSiswaList = $baseModel->get();
        $jumlahData = $clusteringSiswaList->count();
        
        $parameterK = 3;


        // ambil centroid awal acak sesuai parameterK
        // $indexCentroidAwalAcak = [];
        // for ($i = 0; $i < $parameterK; $i++) {

        //     $acak = rand(0, $jumlahData - 1);
        //     while(in_array($acak, $indexCentroidAwalAcak)) {
        //         $acak = rand(0, $jumlahData - 1);
        //     }

        //     array_push($indexCentroidAwalAcak, $acak);
        // }

        
        // data acak harusnya tidaklah boleh terlalu acak
        $indexCentroidAwalAcak = [2, 1, 0];

        // ambil data centroid awal dari model data siswa sebanyak parameterK
        $centroidList = [];
        for ($i = 0; $i < $parameterK; $i++) {
            array_push($centroidList, [
                'x1' => $clusteringSiswaList[$indexCentroidAwalAcak[$i]]->pendapatan_orang_tua,
                'x2' => $clusteringSiswaList[$indexCentroidAwalAcak[$i]]->jumlah_tanggungan_orang_tua,
            ]);
        }

        $hasilClusteringLamaList = [];
        
        $iterasiMaksimal = 1000;

        for ($indexIterasi = 0; $indexIterasi < $iterasiMaksimal; $indexIterasi++) {

            $hasilClusteringBaruList = [];

            foreach ($clusteringSiswaList as $indexSiswa => $siswa) {
                
                $x1 = $siswa->pendapatan_orang_tua;
                $x2 = $siswa->jumlah_tanggungan_orang_tua;
                
                // hitung data dengan jarak pada cluster
                $jarakDenganCentroidList = [];
                for ($i = 0; $i < $parameterK; $i++) {
                    $jarak = sqrt(pow($centroidList[$i]['x1'] - $x1, 2) + pow($centroidList[$i]['x2'] - $x2, 2));
                    array_push($jarakDenganCentroidList, $jarak);
                }
                
                // tentukan hasil cluster dengan mencari jarak paling minimal dari hasil perhitungan jarakDenganClusterList
                $jarakMinimal = [
                    'cluster' => 0,
                    'jarak' => $jarakDenganCentroidList[0],
                ];
                
                for ($i = 1; $i < $parameterK; $i++) {
                    if ($jarakDenganCentroidList[$i] < $jarakMinimal['jarak']) {
                        $jarakMinimal = [
                            'cluster' => $i,
                            'jarak' => $jarakDenganCentroidList[$i],
                        ];
                    }
                }
                
                array_push($hasilClusteringBaruList, [
                    // 'savedId' => $siswa->id_student,
                    'dataIndex' => $indexSiswa,
                    'cluster' => $jarakMinimal['cluster'],
                    'jarakDenganCentroidList' => $jarakDenganCentroidList,
                ]);
            }

            if ($indexIterasi >= 1) {
                // ketika sudah iterasi ke 2 dan seterusnya (karena index di mulai dari 0, jadi di ifnya itu >= 1)
                // maka perlu di bandingkan dengan hasil cluster baru dan lama
                // apakah sama persis "jika iya" maka berhentikan iterasi "break"

                $sama = true;

                $old = array_map(fn($item) => $item['cluster'], $hasilClusteringLamaList);
                $new = array_map(fn($item) => $item['cluster'], $hasilClusteringBaruList);
                
                if($old != $new){
                    $sama = false;
                    // break;
                }

                if($sama){
                    $hasilClusteringLamaList = $hasilClusteringBaruList;
                    break;
                }

                // for ($indexHasilClustering = 0; $indexHasilClustering < count($hasilClusteringBaruList); $indexHasilClustering++) {
                //     $hasilClusteringLama = $hasilClusteringLamaList[$indexHasilClustering];
                //     $hasilClusteringBaru = $hasilClusteringBaruList[$indexHasilClustering];
                    
                //     // jika menemukan hasil clustering yang tidak sama dengan yang lama maka tidak sama  
                //     if ($hasilClusteringBaru['cluster'] != $hasilClusteringLama['cluster']) {
                //         $sama = false;
                //         break;
                //     }
                // }


                // if ($sama) {
                //     // jika sama "break" selesai
                //     $hasilClusteringLamaList = $hasilClusteringBaruList;
                //     break;
                // }
            }
            $tempCentroid = [];
            
            // jika tidak sama lakukan pencarian nilai centroid baru dengan menggunakan rata-rata
            for ($clusterIndex = 0; $clusterIndex < $parameterK; $clusterIndex++) {
                // dd($hasilClusteringBaruList);
                $perCluster = array_filter($hasilClusteringBaruList, function ($data) use (&$clusterIndex){
                    return $data['cluster'] == $clusterIndex;
                });
                
                /*
                $inCluster = array_map(function($item)use($clusterIndex){
                    if($item['cluster'] == $clusterIndex){
                        return $item['savedId'];
                    }
                }, $perCluster);

                // $avgX1 = (float)$baseModel->whereIn('id_student', $inCluster)->avg('pendapatan_orang_tua');
                // $avgX2 = (float)$baseModel->whereIn('id_student', $inCluster)->avg('jumlah_tanggungan_orang_tua');
                */

                $jumlahDataPerCluster = count($perCluster);

                // dd($inCluster);
                // dd();

                if ($jumlahDataPerCluster > 0) {
                    /*
                    $rataRataX1 = array_sum(array_map(function($item)use($clusterIndex, $clusteringSiswaList){
                        if($item['cluster'] == $clusterIndex){
                            return (float)$clusteringSiswaList[$item['dataIndex']]->pendapatan_orang_tua;
                        }
                    }, $hasilClusteringBaruList)) / $jumlahDataPerCluster;

                    $rataRataX2 = array_sum(array_map(function($item)use($clusterIndex, $clusteringSiswaList){
                        if($item['cluster'] == $clusterIndex){
                            return (float)$clusteringSiswaList[$item['dataIndex']]->jumlah_tanggungan_orang_tua;
                        }
                    }, $hasilClusteringBaruList)) / $jumlahDataPerCluster;

                    $centroidList[$clusterIndex] =  [
                        'x1' => $rataRataX1,
                        'x2' => $rataRataX2,
                    ];*/
                    $x1Sum = 0;
                    $x2Sum = 0;

                    foreach ($perCluster as $cluster) {
                        $x1Sum += $clusteringSiswaList[$cluster['dataIndex']]->pendapatan_orang_tua;
                        $x2Sum += $clusteringSiswaList[$cluster['dataIndex']]->jumlah_tanggungan_orang_tua;
                    }

                    $rataRataX1 = $x1Sum / $jumlahDataPerCluster;
                    $rataRataX2 = $x2Sum / $jumlahDataPerCluster;

                    // $tempCentroid[$clusterIndex] =  [
                    //     'x1' => $avgX1,
                    //     'x2' => $avgX2,
                    // ];

                    $centroidList[$clusterIndex] =  [
                        'x1' => $rataRataX1,
                        'x2' => $rataRataX2,
                    ];
                }

                // dd($centroidList[$clusterIndex], $tempCentroid);
            }   

            $hasilClusteringLamaList = $hasilClusteringBaruList;
        }

        
        // masukkan data pada hasil clustering pada variabel clusteringSiswaList
        for ($clusterIndex = 0; $clusterIndex < $parameterK; $clusterIndex++) {
            $perCluster = array_filter($hasilClusteringLamaList, function ($data) use (&$clusterIndex){
                return $data['cluster'] == $clusterIndex;
            });
            // dd($perCluster);
            
            $jumlahDataPerCluster = count($perCluster);
            
            if ($jumlahDataPerCluster > 0) {
                foreach ($perCluster as $cluster) {
                    $clusteringSiswaList[$cluster['dataIndex']]->hasilClustering =  $cluster;
                }
            }
        }
    
        return view('kmeans.index', compact('clusteringSiswaList', 'parameterK', 'centroidList'));
    }
}
