@extends('customer.layout.app')
@section('title', 'Order')
@section('active-manu-order', 'active')

@section ('tab-css')
    <link href="{{ asset ('public/cp/css/plugin/fileinput/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset ('public/cp/css/plugin/fileinput/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <!-- some CSS styling changes and overrides -->
    <style>
        .kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
            margin: 0;
            padding: 0;
            border: none;
            box-shadow: none;
            text-align: center;
        }
        .kv-avatar .file-input {
            display: table-cell;
            max-width: 220px;
        }
    </style>
    
@endsection

@section ('bottom-js')
	
@endsection
@section ('content')
<h1 class="page-header">Order</h1>
<div class="container"> 
    <div style="    padding-right: 19px;padding-bottom: 10px;" class="row">
        
    </div> 
    <div class="table-responsive">
        <table id="table-edit" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Success</th>
                    <th>Location</th>
                    <th>Address</th>
                    <th>Delevery Time</th>
                    <th>Discount</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @php ($i = 1)
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        
                        <td>{{ $row->location->name }}</td>
                        <td>{{ $row->address }}</td>
                        <td>{{ $row->delivery_time }}</td>
                        <td>{{ $row->discount }}</td>
                        <td><a href="#" onclick="orderDetail({{$row->id}})" class="tabledit-edit-button btn btn-sm btn-success" data-toggle="modal" data-target="#orderDetail" style="float: none;"><span class="fa fa-eye"></span></a></td>
                    </tr>
                
                @endforeach
                
                
            </tbody>
        </table>

    </div >                    
</div>
@endsection