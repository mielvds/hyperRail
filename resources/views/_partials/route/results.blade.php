<div class="row" ng-show="results && connections.length > 0">
    <div class="col-md-9 col-sm-8">
        <hr/>
        <div class="panel-group results" id="accordion">
            <div class="panel panel-default" ng-repeat="conn in connections">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" ng-href="#result-@{{connections.indexOf(conn)}}">
                    <span class="container33">
                        <span class="tleft">
                            @{{ (conn.departure.time)*1000 | date:'HH:mm' }}
                            &rarr;
                            @{{ (conn.arrival.time)*1000 | date:'HH:mm' }}
                        </span>
                        <span class="tcenter">
                            <strong>
                                <i class="fa fa-clock-o"></i>
                                @{{ formatDuration( ((conn.arrival.time-conn.departure.time)/60) ) }}
                            </strong>
                        </span>
                        <span class="tright">
                            <span class="delay-route" ng-if="conn.departure.delay > 0 || conn.departure.canceled == 1 || conn.arrival.canceled == 1">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                            <span ng-if="conn.vias.number > 0">
                                @{{ conn.vias.number }}x <img src="{{ URL::asset('images/stair.svg') }}" />
                            </span>
                        </span>
                    </span>
                        </a>
                    </h4>
                </div>
                <div id="result-@{{connections.indexOf(conn)}}" class="panel-collapse collapse" ng-class="{in : $first}"  >
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">@{{ conn.departure.platform }}</span>
                        <span class="planner-time">
                            <strong>
                                @{{ (conn.departure.time)*1000 | date:'HH:mm' }}
                            </strong>
                        </span>
                        <span class="planner-station">
                            <strong>@{{ conn.departure.station}}</strong>
                        </span>
                        <span class="delay-route" ng-if="conn.departure.delay > 0">
                                <i class="fa fa-exclamation-triangle"></i> + @{{ (conn.departure.delay)/60 }}'
                        </span>
                        <span class="delay-route" ng-if="conn.departure.canceled > 0">
                                <i class="fa fa-exclamation-triangle"></i> canceled
                        </span>
                        </li>
                        <li class="list-group-item" ng-repeat="stop in conn.vias.via">
                            &darr; @{{stop.vehicle.replace("BE.NMBS.","")}} <span class="small">(@{{stop.direction.name}})</span>
                            <br/>
                            <span class="planner-time">
                                <strong>@{{(stop.arrival.time)*1000 | date:'HH:mm'}}</strong>
                            </span>
                            <br/>
                            &rarr; <span class="small">@{{(stop.timeBetween/60)}} {{Lang::get('client.mins')}}</span>

                            <br/>
                            <span class="badge">@{{ stop.departure.platform }}</span>
                        <span class="planner-time"><strong>
                                @{{ (stop.departure.time)*1000 | date:'HH:mm' }}
                            </strong>
                        <span class="delay-route" ng-if="stop.departure.delay > 0">
                                <i class="fa fa-exclamation-triangle"></i> + @{{ (stop.departure.delay)/60 }}'
                        </span>
                        <span class="delay-route" ng-if="stop.departure.canceled > 0">
                                <i class="fa fa-exclamation-triangle"></i> canceled
                        </span>
                        </span>
                        <span class="planner-station">
                        <strong>@{{ stop.station}}</strong>
                        </span>
                            <br/>
                        </li>
                        <li class="list-group-item">
                            &darr; @{{conn.arrival.vehicle.replace("BE.NMBS.","")}} <span class="small">(@{{conn.arrival.direction.name}})</span>
                            <br/>
                            <span class="badge">@{{ conn.arrival.platform }}</span>
                        <span class="planner-time"><strong>
                                @{{ (conn.arrival.time)*1000 | date:'HH:mm' }}
                            </strong></span>
                        <span class="planner-station">
                            <strong>@{{ conn.arrival.station}}</strong>
                        </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="visible-print">
            <br/>
            <p>
                This route was planned on iRail.be. Thank you very much for using our webapp.
            </p>
        </div>
    </div>

    <div class="col-md-3 col-sm-4 hidden-print">
    <hr/>
        <div class="btn-group btn-block btn-botm">
            <a class="btn btn-default btn-50" ng-click="earlier()">
                <i class="fa fa-angle-left"></i>
                {{Lang::get('client.rideEarlier')}}
            </a>
            <a class="btn btn-default btn-50" ng-click="later()">
                {{Lang::get('client.rideLater')}}
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
        <div class="btn-group btn-block btn-botm">
            <a class="btn btn-default btn-50" ng-click="earliest()">
                <i class="fa fa-angle-left"></i>
                <i class="fa fa-angle-left"></i>
                {{Lang::get('client.earliestRide')}}
            </a>
            <a class="btn btn-default btn-50" ng-click="latest()">
                {{Lang::get('client.latestRide')}}
                <i class="fa fa-angle-right"></i>
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
</div>
