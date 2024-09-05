<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sentiment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SentimentController extends Controller
{
    public function index()
    {
        // Data untuk sentiment summary
        $positiveCount = Sentiment::where('category', 'positive')->count();
        $neutralCount = Sentiment::where('category', 'neutral')->count();
        $negativeCount = Sentiment::where('category', 'negative')->count();

        // Data untuk latest sentiments
        $latestSentiments = Sentiment::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Data untuk latest Positive sentiments
        $latestPositiveSentiments = Sentiment::where('category', 'positive')->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Data untuk latest Negative sentiments
        $latestNegativeSentiments = Sentiment::where('category', 'negative')->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Data untuk latest Neutral sentiments
        $latestNeutralSentiments = Sentiment::where('category', 'neutral')->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Data untuk most popular sentiments
        $mostPopularPositive = Sentiment::where('category', 'positive')
            ->select('Sentiments', DB::raw('count(*) as count'))
            ->groupBy('Sentiments')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        $mostPopularNeutral = Sentiment::where('category', 'neutral')
            ->select('Sentiments', DB::raw('count(*) as count'))
            ->groupBy('Sentiments')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        $mostPopularNegative = Sentiment::where('category', 'negative')
            ->select('Sentiments', DB::raw('count(*) as count'))
            ->groupBy('Sentiments')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        return view('index', [
            'positiveCount' => $positiveCount,
            'neutralCount' => $neutralCount,
            'negativeCount' => $negativeCount,
            'latestSentiments' => $latestSentiments,
            'latestPositiveSentiments' => $latestPositiveSentiments,
            'latestNegativeSentiments' => $latestNegativeSentiments,
            'latestNeutralSentiments' => $latestNeutralSentiments,
            'mostPopularPositive' => $mostPopularPositive,
            'mostPopularNeutral' => $mostPopularNeutral,
            'mostPopularNegative' => $mostPopularNegative,
        ]);
    }

    public function getSentimentData()
    {
        // Mengambil data dari 7 hari terakhir
        $startDate = Carbon::now()->subDays(7);

        $data = Sentiment::select(
            DB::raw('DATE(created_at) as date'),
            'category',
            DB::raw('count(*) as count')
        )
            ->where('created_at', '>=', $startDate)
            ->groupBy('date', 'category')
            ->orderBy('date')
            ->get();

        // Struktur data untuk chart
        $chartData = [
            'labels' => [],
            'Positive' => [],
            'Neutral' => [],
            'Negative' => [],
        ];

        // Inisialisasi array untuk menyimpan data berdasarkan kategori
        $dates = [];
        $positiveData = [];
        $neutralData = [];
        $negativeData = [];

        // Iterasi data untuk mengelompokkan berdasarkan tanggal
        foreach ($data as $item) {
            $date = $item->date;
            if (!in_array($date, $dates)) {
                $dates[] = $date;
                $positiveData[$date] = 0;
                $neutralData[$date] = 0;
                $negativeData[$date] = 0;
            }
            if ($item->category == 'Positive') {
                $positiveData[$date] = $item->count;
            } elseif ($item->category == 'Neutral') {
                $neutralData[$date] = $item->count;
            } elseif ($item->category == 'Negative') {
                $negativeData[$date] = $item->count;
            }
        }

        // Mengisi data chart berdasarkan tanggal
        foreach ($dates as $date) {
            $chartData['labels'][] = $date;
            $chartData['Positive'][] = $positiveData[$date];
            $chartData['Neutral'][] = $neutralData[$date];
            $chartData['Negative'][] = $negativeData[$date];
        }

        return response()->json($chartData);
    }
}
