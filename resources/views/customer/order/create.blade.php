@extends('frontend.people.layout.app')
@section('title', 'Create New Work Experience')
@section('active-manu-work', 'active')
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
<h1 class="page-header">Create Work Experience</h1>
<div class="container"> 
    <div style="    padding-right: 19px;padding-bottom: 10px;" class="row">
        <a href="{{ route('mentor.auth.work',$locale) }}" style="float: right;"  class="tabledit-delete-button btn btn-sm btn-primary" style="float: none;"><span class="fa fa-arrow-left"></span> Back </a>
    </div> 
    @include('cp.layouts.error')
        @php ($from = "")
        @php ($to = "")
        @php ($en_position = "")
        @php ($kh_position = "")
        @php ($en_company = "")
        @php ($kh_company = "")
        @php ($en_description = "")
        @php ($kh_description = "")
        @if (Session::has('invalidData'))
            @php ($invalidData = Session::get('invalidData'))
            @php ($from = $invalidData['from'])
            @php ($to = $invalidData['to'])
            @php ($en_position = $invalidData['en_position'])
            @php ($kh_position = $invalidData['kh_position'])
            @php ($en_company = $invalidData['en_company'])
            @php ($kh_company = $invalidData['kh_company'])
            @php ($en_description = $invalidData['en_description'])
            @php ($kh_description = $invalidData['kh_description'])
        @endif
        <form id="form" action="{{ route('mentor.auth.store-work') }}" name="form" method="POST"  enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            
            <div class="form-group row">
            <label class="col-sm-2 form-control-label" for="from">From</label>
            <div class="col-sm-10">
                <input  id="from"
                        name="from"
                        value = "{{ $from }}"
                        type="text"
                        placeholder = "Eg. 2011"
                        class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 form-control-label" for="to">To</label>
            <div class="col-sm-10">
                <input  id="to"
                        name="to"
                        value = "{{ $to }}"
                        type="text"
                        placeholder = "Eg. 2016"
                        class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 form-control-label" for="en_position">Position (EN)</label>
            <div class="col-sm-10">
                <input  id="en_position"
                        name="en_position"
                        value = "{{ $en_position }}"
                        type="text"
                        placeholder = "Eg. Manager"
                        class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 form-control-label" for="kh_position">Position (KH)</label>
            <div class="col-sm-10">
                <input  id="kh_position"
                        name="kh_position"
                        value = "{{ $kh_position }}"
                        type="text"
                        placeholder = "Eg. Manager"
                        class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 form-control-label" for="en_company">Company (EN)</label>
            <div class="col-sm-10">
                <input  id="en_company"
                        name="en_company"
                        value = "{{ $en_company }}"
                        type="text"
                        placeholder = "Eg. DESK"
                        class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 form-control-label" for="kh_company">Company (KH)</label>
            <div class="col-sm-10">
                <input  id="kh_company"
                        name="kh_company"
                        value = "{{ $kh_company }}"
                        type="text"
                        placeholder = "Eg. DESK"
                        class="form-control">
            </div>
        </div>
        <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="kh_description">Description (KH)</label>
                <div class="col-sm-10">
                    <div class="summernote-theme-2">
                        <textarea id="kh_description" name="kh_description" class="form-control ">{{$kh_description}} </textarea>
                    </div>  
                </div>
        </div>
        <div class="form-group row">
                <label class="col-sm-2 form-control-label" for="en_description">Description (EN)</label>
                <div class="col-sm-10">
                    <div class="summernote-theme-2">
                        <textarea id="en_description" name="en_description" class="form-control ">{{$en_description}} </textarea>
                    </div>  
                </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 form-control-label" for="kh_content">Finished</label>
            <div class="col-sm-10">
                <div class="checkbox-toggle">
                    <input id="status-status" type="checkbox"  >
                    <label onclick="booleanForm('status')" for="status-status"></label>
                </div>
                <input type="hidden" name="status" id="status" value="">
            </div>
        </div>

            <div class="form-group row">
                <label class="col-sm-2 form-control-label"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-success"> <fa class="fa fa-plus"></i> Create</button>
                </div>
            </div>
        </form>            
</div>
@endsection