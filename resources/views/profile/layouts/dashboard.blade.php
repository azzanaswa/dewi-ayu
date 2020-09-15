@extends('profile.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Selamat datang, {{Auth::user()->name}} !!!
                </div>
            </div>
        </div>
    </div>
@endsection
