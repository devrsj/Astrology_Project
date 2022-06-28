<div>


    <style type="text/css">
        #shipmentDetails #status{

            height: 500px;
            position:relative;
        }

        #shipmentDetails #status h1{
            margin-top:1em;
            text-align: center;
            font-weight: 600;
        }

        #shipmentDetails #status h1 span{
            color:red;

        }

       /* #shipmentDetails #status:after{
            content: "";
            background: url('assets/img/world-map.png');
            background-size: cover;
            opacity: 0.3;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            position: absolute;
            z-index: -1;
        }*/


        .metaStatus{
            margin-top:-2em;
        }

        #from-to-ac{
            margin-top:-10em;
            background: transparent;

        }

        /*status tracking css starts*/
        @charset "UTF-8";
        @import url(https://fonts.googleapis.com/css?family=Pathway+Gothic+One|Open+Sans:400,700);
        .track-progress {
            margin-top:5em;
            margin-left:1em;
            padding: 10px 10px 0 10px;

            height: 80px;

        }
        .track-progress li {
            list-style-type: none;
            display: inline-block;
            position: relative;
            font: 14px/14px Helvetica, sans-serif;
            text-transform: uppercase;
            text-align: center;
            color: #888888;
            font-weight: bold;
            border-bottom: 4px #bbb solid;
            line-height: 3em;
            width: 25%;
            float: left;

        }
        .track-progress li:after {
            content: "  ";
            /*non-breaking space */
        }
        .track-progress li:before {
            position: relative;
            bottom: -2.0em;
            float: left;
            left: 50%;
            line-height: 1em;
        }
        .metaStatus{
            display:none;
        }

        .metaStatus .meta-label-done{
            font-weight:600;
            color:darkgreen;

        }

        .metaStatus .meta-label-todo{
            font-weight:600;
            color:#aaa;

        }

        .metaStatus span{
            font-weight:600;

        }

        #tracking_no{
            width:800px;
            margin-left:2em;
        }
        @media (max-width: 800px) {
            .track-progress li {
                font-size: 0.7em;
            }
        }
        .track-progress li span {
            padding-left: 0.75em;
        }
        @media (max-width: 640px) {
            #shipmentDetails #status{
                height: 200px;
                position:relative;
            }
            .track-progress {
                margin-left:-0.5em;
                margin-top:1em;
            }
            .track-progress li span {
                display: none;
            }
            .metaStatus{
                display:block;
            }
            #from-to-ac{
                margin-top:3em;
                background: transparent;

            }
            #tracking_no{
                width:260px;
                margin-left:0;
            }

            #tracking_no_btn{
                margin-left:3em;
                margin-top:1em;
            }
        }
        .track-progress{
            margin-left:8em;
        }
        .track-progress li.done {
            color: #444444;
            font-weight: bold;
            border-bottom: 4px green solid;
        }
        .track-progress li.done:before {
            content: "";
            background: green;
            height: 2.2em;
            width: 2.2em;
            line-height: 2.2em;
            border: none;
            border-radius: 2.2em;


        }
        .track-progress li.todo:before {
            content: "";
            background: white;
            border: 0.25em solid #bbb;
            height: 2.2em;
            width: 2.2em;
            border-radius: 0.8em;
            margin-left:1em;
        }
        .track-progress li.todo:last-child:before {
            margin-left:8em;
        }

        .track-progress li.todo:last-child span{
            margin-right:-6em;
        }

        .track-progress em {
            display: none;
            font-weight: 700;
            padding-left: 0.75em;
        }
        .spweight{
            flex-direction: row;
        }
        @media (max-width: 640px) {
            .track-progress em {
                display: inline;
            }
            .track-progress{
                margin-left:2em;
            }
            .track-progress li.todo:last-child:before
            {
                margin-left:1.6em;
            }
            .spweight{
                flex-direction: column;
                align-items: center;
            }
        }

        input:checked ~ .checkmark{
            font-size: 30px;
        }

        .summary-wrapper b{
            line-height: 15px;
        }

        .summary-wrapper p{
            margin-bottom: 0;
            font-size: 14px;
        }

      .column-counter {
            width: 5%;
        }

         .column-description {
            width: 32%;
        }



      .column-location {
            width: 54%;
        }

        .column-location {
            width: 30%;
        }

        .column-time {
            width: 9%;
        }

        .column-piece {
            width: 15%;
        }

        .shipment-summary table{
            border-spacing: 0;
            border-collapse: collapse;
            empty-cells: show;
        }


        .shipment-summary .table th, .shipment-summary .table td{

            font-size: 0.6875rem;
            line-height: 1.1818181818181819;
            border-right: 3px solid #ffffff;
            border-top: 1px solid #d1d1d1;
            padding: 0.36363636363636365em 0.5454545454545454em;
            text-align: left;
            vertical-align: top;
        }


        .table td, .table th{
            padding:5px;font-size: 14px;
        }







        /*status tracking css ends*/

    </style>

<div class="newsletter-section">
    <div class="container">
        <div class="newsletter-area">

            <div class="col-lg-12 p-0">
                {{-- <form  data-toggle="validator"> --}}

                    <form class="newsletter-form" method="get" wire:submit.prevent="checkTracking">
                        <input id="tracking_no" wire:model.defer="awb_no" placeholder="Enter Tracking Code" class="form-control mr-sm-2" name="awb_no"  type="search" aria-label="Search">
                        <button class="default-btn electronics-btn" wire:loading.attr="disabled" wire:click.prevent="checkTracking" id="tracking_no_btn" style="padding:0.9em; line-height: 1em" type="button">Track<span wire:loading wire:target="mount">ing &nbsp; <span class="spinner-border spinner-border-sm"  role="status" aria-hidden="true"></span></span></button>
                    </form>

            </div>
        </div>
    </div>
</div>






@if($shipment&&$awb_no)

<div class="shipment-summary" style="padding: 10px 0px;margin-top: 20px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="map-title text-center" style="font-size: 20px; font-weight: 600; margin-bottom: 20px; color: #222222 ">Result Summary</span></h1>
            </div>
        </div>

        <div class="summary-wrapper" style="padding: 20px;border: solid 1px #666">
            <div class="row">

                <div class="col-lg-1">
                    @if($shipment->status=="Delivered")
                    <form class="mt-3">
                        <input type="checkbox" disabled checked  style="height: 20px;width: 20px">
                    </form>
                    @endif
                </div>

                <div class="col-lg-4">
                    <b>Waybill No: {{ $awb_no }}</b>
                    <br>
                    <b style="color: #004085">
                     {{$shipment->status}}
                    </b>

                </div>
                <div class="col-lg-5">
                    <b>
                        {{date('d M Y ', strtotime(array_keys($shipment_status)[0]))}}

                    </b>
                    <br>
                    <b>
                        Origin Service Area:
                    </b>
                    <p>
                        {{ Str::upper($shipment->from_city?$shipment->from_city:$shipment->from_country) }}
                    </p>
                    <b>
                        Destination Service Area:
                    </b>
                    <p>
                        {{  Str::upper($shipment->to_city?$shipment->to_city:$shipment->to_country) }}
                    </p>

                </div>
                <div class="col-lg-2">
                    <div>
                        <p style='font-weight: 600'>{{ $shipment->shipment_line_items_count }} {{ Str::plural('Piece', $shipment->shipment_line_items_count ) }}</p>
                    </div>

                </div>


            </div>

        </div>


    </div>
</div>

<section class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">


                <div class="card" style="border:thin solid #666;border-radius:0;">
                    <div class="card-body">
                        <table  class="table table-responsive " style="display: inline-table">
                            <colgroup>
                                <col class="column-counter">
                                <col class="column-description">
                                <col class="column-location">
                                <col class="column-time">

                                <col class="column-piece">

                            </colgroup>
                                @php
                                    $count=$shipment->status_count;
                                @endphp
                                @foreach ($shipment_status as $statusDate=>$status)

                                    <thead style="background-color: #eeeeee; font-weight: 600;">
                                        <tr>
                                            <th colspan="2">{{date('d M Y ', strtotime($statusDate))}}</th>
                                            <th>Location</th>
                                            <th>Time</th>
                                            <th>Piece</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($status as $childStatus)

                                        <tr>
                                            <td>{{ $count-- }}</td>
                                            <td>@if($childStatus['link']) <a target="_blank" href="{{ $childStatus['link'] }}"> {{ $childStatus['activities'] }} </a> @else   {{ $childStatus['activities'] }} @endif</td>
                                            <td>{{ $childStatus['location'] }}</td>
                                            <td>{{  date('h:i A', strtotime($childStatus['date'])) }}</td>

                                            <td>{{ $shipment->shipment_line_items_count }} {{ Str::plural('Piece', $shipment->shipment_line_items_count ) }}</td>

                                        </tr>
                                        @endforeach





                                    </tbody>
                                @endforeach

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif




