@extends('template')
@section('title','Dashboard')

@section('content')
<main class="container">
    <section class="sentiemnts px-3 mt-4">
        <h1>Welcome, <span class="admin">admin</span></h1>
        <p>This is a summary of the latest user sentiments.</p>
        <div class="service-list px-3 mt-4">
            <div class="d-flex gap-5">
                <div class="col-8">
                    <div class="card card card-maub rounded-0 border-0">
                        <div class="card mb-3 border-0">
                            <div class="card-body p-3">
                                <div class="chart">
                                    <canvas id="sentimentChart" class="chart-canvas" height="300px"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sentiment-counts d-flex justify-content-end">
                        <div class="count d-flex justify-content-center fw-semibold positive-count rounded-0 positive w-8">{{ number_format($positiveCount) }} Positive</div>
                        <div class="count d-flex justify-content-center fw-semibold neutral-count rounded-0 neutral w-8">{{ number_format($neutralCount) }} Neutral</div>
                        <div class="count d-flex justify-content-center fw-semibold negative-count rounded-0 negative w-8">{{ number_format($negativeCount) }} Negative</div>
                    </div>
                </div>
                <div class="latest-sentiment col-4" id="latest-sentiments">
                    <h2>Latest Sentiment</h2>
                    @foreach($latestSentiments as $sentiment)
                    <div class="card card-maub rounded-0 mb-3 p-3 border-0">
                        <div class="d-flex gap-4 mb-2">
                            <span class="fs-6">{{ \Carbon\Carbon::parse($sentiment->created_at)->format('m/d/Y') }}</span>
                            <span class="fs-6 fw-semibold">{{ $sentiment->category }}</span>
                        </div>
                        <span class="fs-6 fw-medium">{{ $sentiment->Sentiments }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="popular-sentiment mt-5">
        <h2 class="display-7 fw-medium text-center">
            Popular Sentiment about TJ
        </h2>
        <div class="d-flex justify-content-around mt-4">
            <div class="category col-4">
                <h3 class="display-8 fw-medium">Positive sentiment about TJ</h3>
                <ul>
                    @foreach($mostPopularPositive as $sentiment)
                    <li>{{ $sentiment->Sentiments }}</li>
                    <!-- Add more list items as needed -->
                    @endforeach
                </ul>
            </div>
            <div class="category col-4">
                <h3 class="display-8 fw-medium">Neutral sentiment about TJ</h3>
                <ul>
                    @foreach($mostPopularNeutral as $sentiment)
                    <li>{{ $sentiment->Sentiments }}</li>
                    <!-- Add more list items as needed -->
                    @endforeach
                </ul>
            </div>
            <div class="category col-4">
                <h3 class="display-8 fw-medium">Negative sentiment about TJ</h3>
                <ul>
                    @foreach($mostPopularNegative as $sentiment)
                    <li>{{ $sentiment->Sentiments }}</li>
                    <!-- Add more list items as needed -->
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <section class="report-section my-5 bg-secondary">
        <div class="d-flex justify-content-between" style="padding: 100px 0px;">
            <div class="d-flex flex-column align-items-start">
                <h2 class="display-6 fw-medium">Wanna see monthly reports?</h2>
                <span class="fs-5 fw-light">Or just curious to see all the sentiments?</span>
            </div>
            <div class="d-flex">
                <button>Report</button>
            </div>
        </div>
    </section>
    <section class="detailed-sentiments">
        <div class="tab d-flex">
            <div class="nav-detail d-flex gap-1">
                <button class="tablinks custom-control-button-type btn rounded-0 p-0 w-100 active" onclick="openSection(event, 'Positive')">
                    <div class="select-type d-flex align-items-center justify-content-start justify-content-xl-center w-100 rounded-0 px-4 py-2">
                        <span class="text-black fs-6 fw-semibold">Positive</span>
                    </div>
                </button>
                <button class="tablinks custom-control-button-type btn rounded-0 p-0 w-100" onclick="openSection(event, 'Negative')">
                    <div class="select-type d-flex align-items-center justify-content-start justify-content-xl-center w-100 rounded-0 px-4 py-2">
                        <span class="text-black fs-6 fw-semibold"> Negative </span>
                    </div>
                </button>
                <button class="tablinks custom-control-button-type btn rounded-0 p-0 w-100" onclick="openSection(event, 'Neutral')">
                    <div class="select-type d-flex align-items-center justify-content-start justify-content-xl-center w-100 rounded-0 px-4 py-2">
                        <span class="text-black fs-6 fw-semibold">Neutral</span>
                    </div>
                </button>
            </div>
        </div>
        <div class="detail-machine">
            <div id="Positive" class="tabcontent" style="display: block">
                <h2>{{ number_format($positiveCount) }} sentiments</h2>
                <div class="bar-chart">
                    <canvas id="detailedSentimentChartPositive"></canvas>
                </div>
                <div class="sentiment-details">
                    @foreach($latestPositiveSentiments as $sentiment)
                    <details>
                        <summary>
                            {{ $sentiment->Sentiments }}
                        </summary>
                        <p>
                            {{ $sentiment->Sentiments }}
                        </p>
                    </details>
                    @endforeach
                </div>
            </div>
            <div id="Negative" class="tabcontent" style="display: none">
                <h2>{{ number_format($negativeCount) }} sentiments</h2>
                <div class="bar-chart">
                    <canvas id="detailedSentimentChartNegative"></canvas>
                </div>
                <div class="sentiment-details">
                    @foreach($latestNegativeSentiments as $sentiment)
                    <details>
                        <summary>
                            {{ $sentiment->Sentiments }}
                        </summary>
                        <p>
                            {{ $sentiment->Sentiments }}
                        </p>
                    </details>
                    @endforeach
                </div>
            </div>
            <div id="Neutral" class="tabcontent" style="display: none">
                <h2>{{ number_format($neutralCount) }} sentiments</h2>
                <div class="bar-chart">
                    <canvas id="detailedSentimentChartNeutral"></canvas>
                </div>
                <div class="sentiment-details">
                    @foreach($latestNeutralSentiments as $sentiment)
                    <details>
                        <summary>
                            {{ $sentiment->Sentiments }}
                        </summary>
                        <p>
                            {{ $sentiment->Sentiments }}
                        </p>
                    </details>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
    function openSection(evt, eventName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(eventName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
@endpush