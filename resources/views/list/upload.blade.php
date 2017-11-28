@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                @if($message = Session::get('success'))
                    <div class="alert alert-info alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Success!</strong> {{ $message }}
                    </div>
                @endif
                <div class="panel panel-primary">

                    {!! Session::forget('success') !!}
                    <br/>
                    <div class="form-group" style="margin-top: 15px;padding: 10px;">
                        <a href="{{ URL::to('downloadExcel/xls') }}">
                            <button class="btn btn-success">PARSISIŪSTI Excel xls</button>
                        </a>

                        <a href="{{ URL::to('downloadExcel/xlsx') }}">
                            <button class="btn btn-success">PARSISIŪSTI Excel xlsx</button>
                        </a>
                        <a href="{{ URL::to('downloadExcel/csv') }}">
                            <button class="btn btn-success">PARSISIŪSTI CSV</button>
                        </a>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <form style="margin-top: 15px;padding: 10px;"
                          action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="file" name="import_file"/>
                        <br/>
                        <button class="btn btn-primary">Įkelti failą </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection