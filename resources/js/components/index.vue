<template>
    <div class="row mt-4">
        <div class="col-lg-12">

            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">Website Performance Dashboard</h4>
            </div>

        </div>
        <div class="col-xl-12 col-lg-7 m-bottom-30">

            <div class="card broder-0">
                <div class="card-header">
                    <h6>Website Performance</h6>
                    <div class="card-extra">
                        <ul class="perfomence-tab-links card-tab-links mr-3 nav-tabs nav">
                            <li>
                                <a href="#w_perfomence-week" data-toggle="tab" id="w_perfomence-week-tab" role="tab"
                                    area-controls="w_perfomence" aria-selected="false">Week</a>
                            </li>
                        </ul>
                        <div class="dropdown dropleft">
                            <a href="#" role="button" id="performance" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i data-feather="more-horizontal"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="performance">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ends: .card-header -->
                <div class="card-body pt-0">
                    <div class="tab-content perfomence-tab-wrap">
                        <div class="tab-pane fade" id="w_perfomence-week" role="tabpanel"
                            aria-labelledby="w_perfomence-week">
                            <div class="performance-stats nav-tabs nav">
                                <a href="#w_ps_user" data-toggle="tab" id="w_ps_user-tab" role="tab"
                                    area-controls="w_ps_user" aria-selected="false">
                                    <div class="performance-stats__up">
                                        <span>Users</span>
                                        <strong>76.2k <sub>
                                                <i class="la la-arrow-up"></i> 25%</sub>
                                        </strong>
                                    </div>
                                </a>

                                <a href="#w_ps_session" data-toggle="tab" id="w_ps_session-tab" role="tab"
                                    area-controls="w_ps_session" aria-selected="false">
                                    <div class="performance-stats__up">
                                        <span>Sessions</span>
                                        <strong>87.6k <sub>
                                                <i class="la la-arrow-up"></i> 46%</sub>
                                        </strong>
                                    </div>
                                </a>

                                <a href="#w_ps_bRate" class="active" data-toggle="tab" id="w_ps_bRate-tab" role="tab"
                                    area-controls="w_ps_bRate" aria-selected="true">
                                    <div class="performance-stats__down">
                                        <span>Bounce Rate</span>
                                        <strong>45% <sub>
                                                <i class="la la-arrow-down"></i> 12%</sub>
                                        </strong>
                                    </div>
                                </a>

                                <a href="#w_ps_sDuration" data-toggle="tab" id="w_ps_sDuration-tab" role="tab"
                                    area-controls="w_ps_sDuration" aria-selected="false">
                                    <div class="performance-stats__up">
                                        <span>Session Duration</span>
                                        <strong>2m 43s <sub>
                                                <i class="la la-arrow-up"></i> 33%</sub>
                                        </strong>
                                    </div>
                                </a>
                            </div>
                            <!-- ends: .performance-stats -->

                            <div class="wp-chart perfomence-chart">
                                <div class="tab-content">
                                    <div class="tab-pane fade" id="w_ps_user" role="tabpanel"
                                        aria-labelledby="w_ps_user-tab">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="wpChart_U_W"></canvas>
                                            </div>


                                        </div>
                                        <ul class="legend-static">
                                            <li class="custom-label">
                                                <span style="background-color: rgb(95, 99, 242);"></span>Current
                                                Period
                                            </li>
                                            <li class="custom-label">
                                                <span style="background-color: #C6D0DC"></span>Previous Period
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="w_ps_session" role="tabpanel"
                                        aria-labelledby="w_ps_session-tab">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="wpChart_S_W"></canvas>
                                            </div>


                                        </div>
                                        <ul class="legend-static">
                                            <li class="custom-label">
                                                <span style="background-color: rgb(95, 99, 242);"></span>Current
                                                Period
                                            </li>
                                            <li class="custom-label">
                                                <span style="background-color: #C6D0DC"></span>Previous Period
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade active show" id="w_ps_bRate" role="tabpanel"
                                        aria-labelledby="w_ps_bRate-tab">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="wpChart_R_W"></canvas>
                                            </div>


                                        </div>
                                        <ul class="legend-static">
                                            <li class="custom-label">
                                                <span style="background-color: rgb(95, 99, 242);"></span>Current
                                                Period
                                            </li>
                                            <li class="custom-label">
                                                <span style="background-color: #C6D0DC"></span>Previous Period
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="w_ps_sDuration" role="tabpanel"
                                        aria-labelledby="w_ps_user-tab">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="wpChart_Sd_W"></canvas>
                                            </div>


                                        </div>
                                        <ul class="legend-static">
                                            <li class="custom-label">
                                                <span style="background-color: rgb(95, 99, 242);"></span>Current
                                                Period
                                            </li>
                                            <li class="custom-label">
                                                <span style="background-color: #C6D0DC"></span>Previous Period
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="w_perfomence-month" role="tabpanel"
                            aria-labelledby="w_perfomence-month">
                            <div class="performance-stats nav-tabs nav">
                                <a href="#m_ps_user" data-toggle="tab" id="m_ps_user-tab" role="tab"
                                    area-controls="m_ps_user" aria-selected="false">
                                    <div class="performance-stats__up">
                                        <span>Users</span>
                                        <strong>76.2k <sub>
                                                <i class="la la-arrow-up"></i> 25%</sub>
                                        </strong>
                                    </div>
                                </a>

                                <a href="#m_ps_session" data-toggle="tab" id="m_ps_session-tab" role="tab"
                                    area-controls="m_ps_session" aria-selected="false">
                                    <div class="performance-stats__up">
                                        <span>Sessions</span>
                                        <strong>87.6k <sub>
                                                <i class="la la-arrow-up"></i> 46%</sub>
                                        </strong>
                                    </div>
                                </a>

                                <a href="#m_ps_bRate" class="active" data-toggle="tab" id="m_ps_bRate-tab" role="tab"
                                    area-controls="m_ps_bRate" aria-selected="true">
                                    <div class="performance-stats__down">
                                        <span>Bounce Rate</span>
                                        <strong>45% <sub>
                                                <i class="la la-arrow-down"></i> 12%</sub>
                                        </strong>
                                    </div>
                                </a>

                                <a href="#m_ps_sDuration" data-toggle="tab" id="m_ps_sDuration-tab" role="tab"
                                    area-controls="m_ps_sDuration" aria-selected="false">
                                    <div class="performance-stats__up">
                                        <span>Session Duration</span>
                                        <strong>2m 43s <sub>
                                                <i class="la la-arrow-up"></i> 33%</sub>
                                        </strong>
                                    </div>
                                </a>
                            </div>
                            <!-- ends: .performance-stats -->

                            <div class="wp-chart perfomence-chart">
                                <div class="tab-content">
                                    <div class="tab-pane fade" id="m_ps_user" role="tabpanel"
                                        aria-labelledby="m_ps_user-tab">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="wpChart_U_M"></canvas>
                                            </div>


                                        </div>
                                        <ul class="legend-static">
                                            <li class="custom-label">
                                                <span style="background-color: rgb(95, 99, 242);"></span>Current
                                                Period
                                            </li>
                                            <li class="custom-label">
                                                <span style="background-color: #C6D0DC"></span>Previous Period
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="m_ps_session" role="tabpanel"
                                        aria-labelledby="m_ps_session-tab">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="wpChart_S_M"></canvas>
                                            </div>


                                        </div>
                                        <ul class="legend-static">
                                            <li class="custom-label">
                                                <span style="background-color: rgb(95, 99, 242);"></span>Current
                                                Period
                                            </li>
                                            <li class="custom-label">
                                                <span style="background-color: #C6D0DC"></span>Previous Period
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade active show" id="m_ps_bRate" role="tabpanel"
                                        aria-labelledby="m_ps_bRate-tab">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="wpChart_R_M"></canvas>
                                            </div>


                                        </div>
                                        <ul class="legend-static">
                                            <li class="custom-label">
                                                <span style="background-color: rgb(95, 99, 242);"></span>Current
                                                Period
                                            </li>
                                            <li class="custom-label">
                                                <span style="background-color: #C6D0DC"></span>Previous Period
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="m_ps_sDuration" role="tabpanel"
                                        aria-labelledby="m_ps_user-tab">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="wpChart_Sd_M"></canvas>
                                            </div>


                                        </div>
                                        <ul class="legend-static">
                                            <li class="custom-label">
                                                <span style="background-color: rgb(95, 99, 242);"></span>Current
                                                Period
                                            </li>
                                            <li class="custom-label">
                                                <span style="background-color: #C6D0DC"></span>Previous Period
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade active show" id="w_perfomence-year" role="tabpanel"
                            aria-labelledby="w_perfomence-year">
                            <div class="performance-stats nav-tabs nav">
                                <a href="#y_ps_user" data-toggle="tab" id="y_ps_user-tab" role="tab"
                                    area-controls="y_ps_user" aria-selected="false">
                                    <div class="performance-stats__up">
                                        <span>Users</span>
                                        <strong>76.2k <sub>
                                                <i class="la la-arrow-up"></i> 25%</sub>
                                        </strong>
                                    </div>
                                </a>

                                <a href="#y_ps_session" data-toggle="tab" id="y_ps_session-tab" role="tab"
                                    area-controls="y_ps_session" aria-selected="false">
                                    <div class="performance-stats__up">
                                        <span>Sessions</span>
                                        <strong>87.6k <sub>
                                                <i class="la la-arrow-up"></i> 46%</sub>
                                        </strong>
                                    </div>
                                </a>

                                <a href="#y_ps_bRate" class="active" data-toggle="tab" id="y_ps_bRate-tab" role="tab"
                                    area-controls="y_ps_bRate" aria-selected="true">
                                    <div class="performance-stats__down">
                                        <span>Bounce Rate</span>
                                        <strong>45% <sub>
                                                <i class="la la-arrow-down"></i> 12%</sub>
                                        </strong>
                                    </div>
                                </a>

                                <a href="#y_ps_sDuration" data-toggle="tab" id="y_ps_sDuration-tab" role="tab"
                                    area-controls="y_ps_sDuration" aria-selected="false">
                                    <div class="performance-stats__up">
                                        <span>Session Duration</span>
                                        <strong>2m 43s <sub>
                                                <i class="la la-arrow-up"></i> 33%</sub>
                                        </strong>
                                    </div>
                                </a>
                            </div>
                            <!-- ends: .performance-stats -->

                            <div class="wp-chart perfomence-chart">
                                <div class="tab-content">
                                    <div class="tab-pane fade" id="y_ps_user" role="tabpanel"
                                        aria-labelledby="y_ps_user-tab">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="wpChart_U_Y"></canvas>
                                            </div>


                                        </div>
                                        <ul class="legend-static">
                                            <li class="custom-label">
                                                <span style="background-color: rgb(95, 99, 242);"></span>Current
                                                Period
                                            </li>
                                            <li class="custom-label">
                                                <span style="background-color: #C6D0DC"></span>Previous Period
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="y_ps_session" role="tabpanel"
                                        aria-labelledby="y_ps_session-tab">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="wpChart_S_Y"></canvas>
                                            </div>


                                        </div>
                                        <ul class="legend-static">
                                            <li class="custom-label">
                                                <span style="background-color: rgb(95, 99, 242);"></span>Current
                                                Period
                                            </li>
                                            <li class="custom-label">
                                                <span style="background-color: #C6D0DC"></span>Previous Period
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade active show" id="y_ps_bRate" role="tabpanel"
                                        aria-labelledby="y_ps_bRate-tab">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="wpChart_R_Y"></canvas>
                                            </div>


                                        </div>
                                        <ul class="legend-static">
                                            <li class="custom-label">
                                                <span style="background-color: rgb(95, 99, 242);"></span>Current
                                                Period
                                            </li>
                                            <li class="custom-label">
                                                <span style="background-color: #C6D0DC"></span>Previous Period
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="y_ps_sDuration" role="tabpanel"
                                        aria-labelledby="y_ps_user-tab">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="wpChart_Sd_Y"></canvas>
                                            </div>


                                        </div>
                                        <ul class="legend-static">
                                            <li class="custom-label">
                                                <span style="background-color: rgb(95, 99, 242);"></span>Current
                                                Period
                                            </li>
                                            <li class="custom-label">
                                                <span style="background-color: #C6D0DC"></span>Previous Period
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ends: .card-body -->
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        title() {
            return 'Dashboard';
        },
    }

</script>
