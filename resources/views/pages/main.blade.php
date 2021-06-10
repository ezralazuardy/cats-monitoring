@extends('layout.base_layout')

@include('plugins.datatables')

@section('content')
    <body class="antialiased">
    <div
        class="relative items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-6 lg:px-8 py-8 lg:py-10">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <h1 class="text-indigo-400 font-black text-3xl">
                    {{ env('APP_NAME') }}
                </h1>
                <div class="flex lg:justify-end text-sm text-gray-500 pt-3">
                    <button type="button" onclick="refreshDetection()" class="flex link focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="w-4 h-4">
                            <polyline points="1 4 1 10 7 10"></polyline>
                            <polyline points="23 20 23 14 17 14"></polyline>
                            <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
                        </svg>
                        <span class="ml-2">Refresh</span>
                    </button>
                    <button type="button" onclick="removeAllDetection($(this))"
                            class="flex link focus:outline-none ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="w-4 h-4">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path
                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                        <span class="ml-2">Remove All</span>
                    </button>
                </div>
            </div>
            <div class="mt-5 bg-white dark:bg-gray-700 overflow-x-scroll lg:overflow-hidden shadow sm:rounded-lg">
                <div class="p-4 lg:pt-6 lg:pl-5 lg:pr-5 lg:pb-4 mt-6 lg:mt-0 rounded shadow dark:text-white">
                    <table id="thermal-scanner">
                        <thead>
                        <tr>
                            <th data-priority="1">Type</th>
                            <th data-priority="2">Temperature</th>
                            <th data-priority="3">Timestamp</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 sm:text-left">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="w-4 h-4">
                            <path d="M5 12.55a11 11 0 0 1 14.08 0"></path>
                            <path d="M1.42 9a16 16 0 0 1 21.16 0"></path>
                            <path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path>
                            <line x1="12" y1="20" x2="12.01" y2="20"></line>
                        </svg>
                        <div class="mt-1 ml-2 text-left">
                            <span>Last Sync:</span>
                            <span
                                id="latest-ack">{{ empty($latestAck) ? 'Unknown' : $latestAck->created_at->diffForHumans() }}</span>
                        </div>

                    </div>
                </div>
                <div class="ml-4 text-left text-sm text-gray-500 mt-1">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} + Arduino Uno R3 = 💖
                </div>
            </div>
        </div>
    </div>
    </body>
    @push('js')
        <script type="text/javascript">
            let datatable;
            let currentIds = [];

            $(document).ready(function () {
                datatable = $('#thermal-scanner').DataTable({
                    serverSide: true,
                    ajax: `{{ route('detection.datatable') }}`,
                    pageLength: 10,
                    columns: [
                        {
                            data: 'temperature',
                            name: 'temperature'
                        },
                        {
                            data: 'temperature',
                            name: 'temperature'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        }
                    ],
                    order: [
                        [2, 'desc']
                    ],
                    columnDefs: [
                        {
                            render: function (data) {
                                if (data >= 30 || data <= 36)
                                    return `<div style="padding-top: 0.1em; padding-bottom: 0.1rem" class="text-xs px-3 bg-green-200 text-green-900 rounded-full">Normal</div>`;
                                return `<div style="padding-top: 0.1em; padding-bottom: 0.1rem" class="text-xs px-3 bg-red-200 text-red-900 rounded-full">Abnormal</div>`;
                            },
                            targets: 0
                        },
                        {
                            render: function (data) {
                                return `${data} °Celcius`;
                            },
                            targets: 1
                        }
                    ],
                    rowCallback: function (row, data) {
                        $('td', row).addClass('dark:bg-gray-600 text-center');
                    },
                    drawCallback: setDatatableTheme
                });
                setInterval(function () {
                    refreshDetection();
                }, 2500);
            });

            async function refreshDetection() {
                datatable.ajax.reload();
                await refreshLatestAck();
            }

            async function refreshLatestAck() {
                axios.get('{{ route('ack.latest') }}')
                    .then(function (response) {
                        $('#latest-ack').text(response.data.data.timestamp);
                    });
            }

            async function removeAllDetection(button) {
                $(button).prop('disabled', true);
                await axios.post('{{ route('detection.reset') }}').then(refreshDetection);
                $(button).prop('disabled', false);
            }
        </script>
    @endpush
@endsection
