@extends('layouts.master')


@section('title')
    Bill Splitter
@endsection


@section('content')

    <div class="container" id='border'>
        <img src="images/billsplitter.jpg" alt="billimg">
        <h1>Bill Splitter</h1>
        <p> This is a bill splitter calculator. Choose how many ways to split it and choose the bill total. </p>
        <p> You can also rank the service (suggseted tip would change accordingly, and wether to round the amount or not).</p>

        <form method='GET' action='/' class="form-horizontal">

            <div class="form-group">
                <label for='pplCount' class="control-label col-sm-2">Split how many ways?</label>
                <div class="col-sm-10">
                    <input type='text' name='pplCount' id='pplCount' class='form-control' value='@if($errors->get('pplCount')){{old('pplCount')}}@else{{$pplCount or ''}}@endif'>
                    * required
                </div>
            </div>

            <div class="form-group">
                <label for='billSum' class="control-label col-sm-2">How much was the tab?</label>
                <div class="col-sm-10">
                    <input type='text' name='billSum' id='billSum' class='form-control' value='@if($errors->get('billSum')){{old('billSum')}}@else{{$billSum or ''}}@endif'>
                    * required
                </div>
            </div>

            <div class="form-group">
                <label for='serviceScore' class="control-label col-sm-2">How was the service?</label>
                <div class='col-sm-10'>
                    <select name='serviceScore' id='serviceScore' class='form-control'>
                        <option value='' {{ ($serviceScore == '') ? 'SELECTED' : '' }}>Please Choose</option>
                        <option value='bad' {{ ($serviceScore == 'bad') ? 'SELECTED' : '' }}>Bad</option>
                        <option value='average' {{ ($serviceScore == 'average') ? 'SELECTED' : '' }}>Average</option>
                        <option value='good' {{ ($serviceScore == 'good') ? 'SELECTED' : '' }}>Good</option>
                        <option value='excellent' {{ ($serviceScore == 'excellent') ? 'SELECTED' : '' }}>Excellent</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                  <label for='roundUp' class="control-label col-sm-2">Round up? </label>
                  <input type='checkbox' name='roundUp' id='roundUp' {{ ($roundUp) ? 'CHECKED' : '' }}>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type='submit' value='Calculate' class="btn btn-default">
                </div>
            </div>
        </form>
    </div>

    @if(count($errors) > 0)
        <div class='alert alert-danger'>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @elseif ($dividedBill > 0)
        <div class="alert alert-success" role="alert">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            Everyone owes $<?=$dividedBill?> . Recommended tip is %<?=$recommendedTip?>, that means that each individual should put $<?=$personalTip?> as tip
        </div>
    @endif

@endsection
