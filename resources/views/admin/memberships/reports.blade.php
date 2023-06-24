@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/memberships-list')}}">Memberships</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Reports</a></li>
            </ol>
        </div>

	</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">
                <div class="card-body">
                    <div class="card-header pt-0 pl-0">
                        <h5 class="card-title">Reports</h5>
                    </div>
                    <div class="row mt-2 mb-3">
                        <div class="col-xl-2 col-xxl-2 col-lg-6 col-md-6 col-sm-6">
                            <div class="widget-stat card">
                                <div class="card-body p-3">
                                    <div class="media ai-icon">
                                        <div class="media-body">
                                            <h6 class="mb-0 text-black text-center"><span class="counter ml-0">{{ $activeMembers }}</span></h6>
                                            <p class="mb-0 text-dark mt-2 text-center" style="font-size:12px;"><i class="fa fa-users"></i> Active Members</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-xxl-2 col-lg-6 col-md-6 col-sm-6">
                            <div class="widget-stat card">
                                <div class="card-body p-3">
                                    <div class="media ai-icon">
                                        <div class="media-body">
                                            <h6 class="mb-0 text-black text-center"><span class="counter ml-0">{{ $inActiveMembers }}</span></h6>
                                            <p class="mb-0 text-dark mt-2 text-center" style="font-size:12px;"><i class="fa fa-users"></i> Inactive Members</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-xxl-2 col-lg-6 col-md-6 col-sm-6">
                            <div class="widget-stat card">
                                <div class="card-body p-3">
                                    <div class="media ai-icon">
                                        <div class="media-body">
                                            <h6 class="mb-0 text-black text-center"><span class="counter ml-0">{{ $totalMembers }}</span></h6>
                                            <p class="mb-0 text-dark mt-2 text-center" style="font-size:12px;"><i class="fa fa-users"></i> Total Members</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-xxl-2 col-lg-6 col-md-6 col-sm-6">
                            <div class="widget-stat card">
                                <div class="card-body p-3">
                                    <div class="media ai-icon">
                                        <div class="media-body">
                                            <h6 class="mb-0 text-black text-center"><span class="counter ml-0">{{ $freeMembers }}</span></h6>
                                            <p class="mb-0 text-dark mt-2 text-center" style="font-size:12px;"><i class="fa fa-users"></i> Active Free Members</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-xxl-2 col-lg-6 col-md-6 col-sm-6">
                            <div class="widget-stat card">
                                <div class="card-body p-3">
                                    <div class="media ai-icon">
                                        <div class="media-body">
                                            <h6 class="mb-0 text-black text-center"><span class="counter ml-0">{{ $paidMembers }}</span></h6>
                                            <p class="mb-0 text-dark mt-2 text-center" style="font-size:12px;"><i class="fa fa-users"></i> Active Paid Members</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-xxl-2 col-lg-6 col-md-6 col-sm-6">
                            <div class="widget-stat card">
                                <div class="card-body p-3">
                                    <div class="media ai-icon">
                                        <div class="media-body">
                                            <h6 class="mb-0 text-black text-center"><span class="counter ml-0">45455</span></h6>
                                            <p class="mb-0 text-dark mt-2 text-center" style="font-size:12px;"><i class="fa fa-users"></i> Avg Mbr Lifetime Val</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active text-uppercase" id="month-tab" data-toggle="tab" href="javascript:void();" role="tab"  aria-selected="true">Monthly</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-uppercase" id="year-tab" data-toggle="tab" role="tab" href="javascript:void();" aria-selected="false">Yearly</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-uppercase" id="all-tab" data-toggle="tab" role="tab" href="javascript:void();" aria-selected="false">All-Time</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" role="tabpanel">
                                            <div class="row mt-4">
                                                <div class="col-md-2 filter-month">
                                                    <label>Month</label>
                                                    <select class="form-control" id="filter-month">
                                                        <option value="1" @if(date('n') == 1) selected @endif>January</option>
                                                        <option value="2" @if(date('n') == 2) selected @endif>February</option>
                                                        <option value="3" @if(date('n') == 3) selected @endif>March</option>
                                                        <option value="4" @if(date('n') == 4)  selected @endif>April</option>
                                                        <option value="5" @if(date('n') == 5) selected @endif>May</option>
                                                        <option value="6" @if(date('n') == 6) selected @endif>June</option>
                                                        <option value="7" @if(date('n') == 7) selected @endif>July</option>
                                                        <option value="8" @if(date('n') == 8) selected @endif>August</option>
                                                        <option value="9" @if(date('n') == 9) selected @endif>September</option>
                                                        <option value="10" @if(date('n') == 10)  selected @endif>October</option>
                                                        <option value="11" @if(date('n') == 11) selected @endif>November</option>
                                                        <option value="12" @if(date('n') == 12) selected @endif>December</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 filter-year">
                                                    <label>Year</label>
                                                    <select class="form-control" id="filter-year">
                                                        <option value="2019" @if(date('Y') == 2019) selected @endif>2019</option>
                                                        <option value="2020" @if(date('Y') == 2020) selected @endif>2020</option>
                                                        <option value="2021" @if(date('Y') == 2021) selected @endif>2021</option>
                                                        <option value="2022" @if(date('Y') == 2022) selected @endif>2022</option>
                                                        <option value="2023" @if(date('Y') == 2023) selected @endif>2023</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Membership</label>
                                                    <select class="form-control" id="filter-membership">
                                                        <option value="">All</option>
                                                        @foreach ($memberships as $id => $membership)
                                                        <option value="{{
                                                            $id }}">{{
                                                        $membership }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-info" id="filter-go">Go</button>
                                                </div>
                                            </div>
                                            <div class="row" id="pie-chart">
                                                <div class="card w-100">
                                                    <div class="card-body">
                                                        <div id="monthly-chart" style="width:100%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2 mb-3">
                                                <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
                                                    <div class="widget-stat card">
                                                        <div class="card-body p-3">
                                                            <div class="media ai-icon">
                                                                <div class="media-body">
                                                                    <h6 class="mb-0 text-black text-center"><span class="counter ml-0 pending">{{ $transactionStatus[0]->pending ?? '' }}</span></h6>
                                                                    <p class="mb-0 text-dark mt-2 text-center" style="font-size:12px;">Pending Transactions</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
                                                    <div class="widget-stat card">
                                                        <div class="card-body p-3">
                                                            <div class="media ai-icon">
                                                                <div class="media-body">
                                                                    <h6 class="mb-0 text-black text-center"><span class="counter ml-0 failed">{{ $transactionStatus[0]->failed ?? '' }}</span></h6>
                                                                    <p class="mb-0 text-dark mt-2 text-center" style="font-size:12px;">Failed Transactions</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
                                                    <div class="widget-stat card">
                                                        <div class="card-body p-3">
                                                            <div class="media ai-icon">
                                                                <div class="media-body">
                                                                    <h6 class="mb-0 text-black text-center"><span class="counter ml-0 refund">{{ $transactionStatus[0]->refunded ?? ''}}</span></h6>
                                                                    <p class="mb-0 text-dark mt-2 text-center" style="font-size:12px;">Refunded Transactions</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
                                                    <div class="widget-stat card">
                                                        <div class="card-body p-3">
                                                            <div class="media ai-icon">
                                                                <div class="media-body">
                                                                    <h6 class="mb-0 text-black text-center"><span class="counter ml-0 complete">{{ $transactionStatus[0]->complete ?? '' }}</span></h6>
                                                                    <p class="mb-0 text-dark mt-2 text-center" style="font-size:12px;">Completed Transactions</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
                                                    <div class="widget-stat card">
                                                        <div class="card-body p-3">
                                                            <div class="media ai-icon">
                                                                <div class="media-body">
                                                                    <h6 class="mb-0 text-black text-center">$<span class="counter ml-0 collect">{{ $transactionStatus[0]->collect ?? '' }}</span></h6>
                                                                    <p class="mb-0 text-dark mt-2 text-center" style="font-size:12px;">Amount Collected</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
                                                    <div class="widget-stat card">
                                                        <div class="card-body p-3">
                                                            <div class="media ai-icon">
                                                                <div class="media-body">
                                                                    <h6 class="mb-0 text-black text-center">$<span class="counter ml-0 refund-amount">{{ $transactionStatus[0]->refund_amount ?? '' }}</span></h6>
                                                                    <p class="mb-0 text-dark mt-2 text-center" style="font-size:12px;">Amount Refunded</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
                                                    <div class="widget-stat card">
                                                        <div class="card-body p-3">
                                                            <div class="media ai-icon">
                                                                <div class="media-body">
                                                                    <h6 class="mb-0 text-black text-center">$<span class="counter ml-0 tax">{{ $transactionStatus[0]->tax ?? '' }}</span></h6>
                                                                    <p class="mb-0 text-dark mt-2 text-center" style="font-size:12px;">Taxes Collected</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
                                                    <div class="widget-stat card">
                                                        <div class="card-body p-3">
                                                            <div class="media ai-icon">
                                                                <div class="media-body">
                                                                    <h6 class="mb-0 text-black text-center">$<span class="counter ml-0 net-amount">{{ $transactionStatus[0]->net_amount ?? '' }}</span></h6>
                                                                    <p class="mb-0 text-dark mt-2 text-center" style="font-size:12px;">Total Net Income </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row record-table">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-responsive-md" id="record-table">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Pending</th>
                                                    <th>Failed</th>
                                                    <th>Complete</th>
                                                    <th>Refunded</th>
                                                    <th>Collected</th>
                                                    <th>Refunded</th>
                                                    <th>Tax</th>
                                                    <th>Net Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($currentMonthRecord) > 0)
                                                @foreach($currentMonthRecord as $key => $value)
                                                <tr>
                                                    <td style="font-size:14px;">{{ $value->date }}</td>
                                                    <td style="font-size:14px;">{{ $value->pending }}</td>
                                                    <td style="font-size:14px;">{{ $value->failed }}</td>
                                                    <td style="font-size:14px;">{{ $value->complete }}</td>
                                                    <td style="font-size:14px;">{{ $value->refunded }}</td>
                                                    <td style="font-size:14px;">${{ $value->collect }}</td>
                                                    <td style="font-size:14px;">${{ $value->refund_amount }}</td>
                                                    <td style="font-size:14px;">${{ $value->tax }}</td>
                                                    <td style="font-size:14px;">${{ $value->net_amount }}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script src="{{ asset('public/admin/js/charts/plugins/apexcharts.min.js') }}"></script>
<script>
    var empDataTable = $('#record-table').DataTable({
        dom: 'Bfrtip',             
        "ordering": false,
        "lengthChange": false,        
        buttons: [
            {
                extend: 'csv',
                text: '<i class="fa fa-download"></i> Export to excel',
                className: 'downloadCSVbtn btn-xs'
            }
            //'csvHtml5',           
        ],
        lengthChange: true,
        searching: false

    });   
    var packages = @json($userMembershipGraph);
    var chart;
        $(function() {
            var options = {
                chart: {
                    height: 320,
                    type: 'pie',
                },
                labels: Object.keys(packages),
                series: Object.values(packages),
                colors: ["#4099ff", "#0e9e4a", "#00bcd4", "#FFB64D", "#FF5370","#fb9aaa"],
                legend: {
                    show: true,
                    position: 'right',
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        inverseColors: true,
                    }
                },
                dataLabels: {
                    enabled: true,
                    dropShadow: {
                        enabled: false,
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            }
            chart = new ApexCharts(
                document.querySelector("#monthly-chart"),
                options
            );
            chart.render();
        });

    $('#myTab .nav-link').click(function(){
        $('#myTab .nav-link').removeClass('active');
        var tabId = $(this).attr('id');
        if(tabId == 'year-tab'){
            $('.filter-month').hide();
        }else if (tabId == 'all-tab'){
            $('.filter-month').hide();
            $('.filter-year').hide();
        }else{
            $('.filter-month').fadeIn();
            $('.filter-year').fadeIn();
        }
        $(this).addClass('active');
        $.ajax({
            url : "{{ url('superadmin/membership/reports') }}",
            data : {'id':tabId},
            beforeSend: function(data){
            },
            success : function(data){
            //   $('#record-table tbody').html('');
              buildChart(data.data.userMembershipGraph);
              if((data.data.transactionStatus).length > 0){
                $('#myTabContent .pending').text(data.data.transactionStatus[0]['pending']);
                $('#myTabContent .failed').text(data.data.transactionStatus[0]['failed']);
                $('#myTabContent .refund').text(data.data.transactionStatus[0]['refunded']);
                $('#myTabContent .complete').text(data.data.transactionStatus[0]['complete']);
                $('#myTabContent .refund-amount').text(data.data.transactionStatus[0]['refund_amount']);
                $('#myTabContent .collect').text(data.data.transactionStatus[0]['collect']);
                $('#myTabContent .tax').text(data.data.transactionStatus[0]['tax']);
                $('#myTabContent .net-amount').text(data.data.transactionStatus[0]['net_amount']);
                $('#myTabContent .counter').counterUp({ delay: 10, time: 2000});               
            }

            if(data.data.currentRecord){
                empDataTable.rows().remove().draw();               
                $.each(data.data.currentRecord, function( index, value ) {
                     empDataTable.row.add([value.date, value.pending, value.failed, value.complete, value.refunded, '$'+value.collect, '$'+value.refund_amount, '$'+value.tax, '$'+value.net_amount]);
                    // $('#record-table tbody').append('<tr><td style="font-size:14px;">'+value.date+'</td> <td style="font-size:14px;">'+value.pending+'</td><td style="font-size:14px;">'+value.failed+'</td> <td style="font-size:14px;">'+value.complete+'</td> <td style="font-size:14px;">'+value.refunded+'</td> <td style="font-size:14px;">$'+value.collect+'</td> <td style="font-size:14px;">$'+value.refund_amount+'</td><td style="font-size:14px;">$'+value.tax+'</td> <td style="font-size:14px;">$'+value.net_amount+'</td></tr>');
                });
                empDataTable.draw();
                $('.record-table').fadeIn();               
              }else{
                $('.record-table').hide();                
              }
            }
        });
    })

    function buildChart(data) {
        chart.destroy();
        var options = {
            chart: {type: 'pie',  height: 320},
            labels: Object.keys(data),
            series:  Object.values(data)
        };
        chart = new ApexCharts(document.querySelector("#monthly-chart"), options);
        chart.render();
    }
    $('#filter-go').click(function(){
        var tabId = $('#myTab .nav-link.active').attr('id');
        var month = $('#filter-month').val();
        var year = $('#filter-year').val();
        var membershipId = $('#filter-membership').val();
        $(this).addClass('active');
        $.ajax({
            url : "{{ url('superadmin/membership/report-filter') }}",
            data : {'month':month, 'year':year, 'membershipId':membershipId, 'id':tabId},
            beforeSend: function(data){

            },
            success : function(data){
              console.log(data);
              //$('#record-table tbody').html('');
              if(data.data.currentRecord){
                $('.record-table').fadeIn();
              }else{
                $('.record-table').hide();
              }

              if($.isEmptyObject(data.data.userMembershipGraph) == true) {
                $('#pie-chart').hide();
              } else{
                $('#pie-chart').show();
                buildChart(data.data.userMembershipGraph);
              }
              $('#myTabContent .pending').text(data.data.transactionStatus[0]['pending']);
              $('#myTabContent .failed').text(data.data.transactionStatus[0]['failed']);
              $('#myTabContent .refund').text(data.data.transactionStatus[0]['refunded']);
              $('#myTabContent .complete').text(data.data.transactionStatus[0]['complete']);
              $('#myTabContent .refund-amount').text(data.data.transactionStatus[0]['refund_amount']);
              $('#myTabContent .collect').text(data.data.transactionStatus[0]['collect']);
              $('#myTabContent .tax').text(data.data.transactionStatus[0]['tax']);
              $('#myTabContent .net-amount').text(data.data.transactionStatus[0]['net_amount']);
              $('.counter').counterUp({ delay: 10, time: 2000});
              empDataTable.rows().remove().draw();
                $.each(data.data.currentRecord, function( index, value ) {
                    //$('#record-table tbody').append('<tr><td style="font-size:14px;">'+value.date+'</td> <td style="font-size:14px;">'+value.pending+'</td><td style="font-size:14px;">'+value.failed+'</td> <td style="font-size:14px;">'+value.complete+'</td> <td style="font-size:14px;">'+value.refunded+'</td> <td style="font-size:14px;">$'+value.collect+'</td> <td style="font-size:14px;">$'+value.refund_amount+'</td><td style="font-size:14px;">$'+value.tax+'</td> <td style="font-size:14px;">$'+value.net_amount+'</td></tr>');
                    empDataTable.row.add([value.date, value.pending, value.failed, value.complete, value.refunded, '$'+value.collect, '$'+value.refund_amount, '$'+value.tax, '$'+value.net_amount]);
                });
                empDataTable.draw()
            }
        });
    })   
    
</script>
@endpush

