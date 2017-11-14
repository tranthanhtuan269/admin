@extends('layouts.app')

@section('content')
<style type="text/css">
    .add-3-btn{
        margin: 0 10px 0 0;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Username</th>
                          <th scope="col">Email</th>
                          <th scope="col">Status</th>
                          <th scope="col">Expiration Date</th>
                          <th scope="col">Add Time</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $users = App\User::where('status','=',1)->orderBy('id','desc')->get();
                            foreach($users as $user){
                            ?>
                        <tr>
                          <th scope="row">{{ $user->id }}</th>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>@if($user->status == 0)<button class="btn btn-sm btn-default inactive-btn" data-id="{{ $user->id }}">inactive</button>@else<button class="btn btn-sm btn-primary active-btn" data-id="{{ $user->id }}">active</button>@endif</td>
                          <td>{{ date('d-m-Y', strtotime($user->expiration_date)) }}</td>
                          <td><button class="btn btn-sm btn-success add-3-btn" data-id="{{ $user->id }}">+ 3 months</button><button class="btn btn-sm btn-danger remove-3-btn" data-id="{{ $user->id }}">- 3 months</button></td>
                        </tr>
                        <?php 
                            }
                            ?>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.inactive-btn').click(function(){
            var user_id = $(this).attr('data-id');
            var request = $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url: "{{ URL::to('/') }}/active",
                type: "POST",
                data: { 
                    user_id : user_id 
                },
                dataType: "json"
            });

            request.done(function (msg) {
                location.reload();
            });

            request.fail(function (jqXHR, textStatus) {
                
            }); 
        });

        $('.active-btn').click(function(){
            var user_id = $(this).attr('data-id');
            var request = $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url: "{{ URL::to('/') }}/inactive",
                type: "POST",
                data: { 
                    user_id : user_id 
                },
                dataType: "json"
            });

            request.done(function (msg) {
                location.reload();
            });

            request.fail(function (jqXHR, textStatus) {

            }); 
        });

        $('.add-3-btn').click(function(){
            var user_id = $(this).attr('data-id');
            var request = $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url: "{{ URL::to('/') }}/add3time",
                type: "POST",
                data: { 
                    user_id : user_id 
                },
                dataType: "json"
            });

            request.done(function (msg) {
                location.reload();
            });

            request.fail(function (jqXHR, textStatus) {

            }); 
        });

        $('.remove-3-btn').click(function(){
            var user_id = $(this).attr('data-id');
            var request = $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url: "{{ URL::to('/') }}/remove3time",
                type: "POST",
                data: { 
                    user_id : user_id 
                },
                dataType: "json"
            });

            request.done(function (msg) {
                location.reload();
            });

            request.fail(function (jqXHR, textStatus) {

            }); 
        });
    });
</script>
@endsection
