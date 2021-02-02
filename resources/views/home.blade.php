@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Chart</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                    <canvas id="areaChart" height="200" width="772" class="chartjs-render-monitor" style="display: block; width: 772px; height: 200px;"></canvas>
                                </div>
                            </div>

                        </div>


            </div>
        </div>
    </div>
</div>

@endsection



@section('script')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

    <script>
        $( document ).ready(function() {

            $.ajax({
                url: 'getGraph',
                type: 'post',
                data: { _token: '{{csrf_token()}}' },
                dataType: "json",
                success: function( data ) {

                    var counter = [];
                    var day = [];
                    var month = [];
                    var year = [];
                    var amount_type = [];

                    for(var i in data) {
                        counter.push(data[i].data);
                        year.push(data[i].day+ '/'+ data[i].month + '/' + data[i].year);
                        // amount_type.push(data[i].category_type_id);
                    }
                    var ctx = document.getElementById('areaChart').getContext('2d');
                    var chart = new Chart(ctx, {

                        type: 'line',
                        data: {
                            labels: year,
                            datasets: [{
                                label: amount_type,
                                borderColor: 'black',
                                data: counter
                            }]
                        },

                        options: {}
                    });
                },
                error: function() {
                    response([]);
                }
            });
        });
    </script>

@endsection

