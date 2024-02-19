@extends('layouts.master')

@section('title', __( 'lang_v1.view_user' ))
@section('css')

<style>
    .my-custom-tabs {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px; /* Adjust the margin as needed */
        background-color: #f8f9fa; /* Optional: Set a background color */
        padding: 10px; /* Optional: Add padding to the container */
    }

    .my-custom-tabs li {
        flex-grow: 1;
        text-align: center;
    }

    .my-custom-tabs a {
        display: block;
        padding: 10px; /* Adjust the padding as needed */
        text-decoration: none;
        color: #495057; /* Optional: Set the text color */
        background-color: #ffffff; /* Optional: Set the background color */
        border: 1px solid #dee2e6; /* Optional: Set the border color */
        border-radius: 5px; /* Optional: Set border radius */
    }

    /*  */
</style>
@endsection
@section('content')
    <!-- Main content -->
    {{-- <section class="content"> --}}
      {{--   <div class="row">
         
            <div class="col-lg-4 mg-b-20 mg-lg-b-0 mt-5">
                {!! Form::select('user_id', $users, $user->id , ['class' => 'form-control select2', 'id' => 'user_id']); !!}
            </div>
        </div>
        <br> --}}





     
        <div class="row ">


            <div class="col-md-12">

            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
 <!-- Profile Image -->
 <div class="card box-primary">
    <div class="card-body card-profile">
   {{--      @php
            if(isset($user->media->display_url)) {
                $img_src = $user->media->display_url;
            } else {
                $img_src = 'https://ui-avatars.com/api/?name='.$user->first_name;
            }
        @endphp

        <img class="profile-user-img img-responsive img-circle" src="{{$img_src}}" alt="User profile picture">
 --}}
    {{--     <h3 class="profile-username text-center">
           
        </h3>

        <p class="text-muted text-center" title="@lang('user.role')">
          
        </p> --}}
        <div class="d-flex justify-content-between mg-b-20">
            <div>
                <h5 class="main-profile-name"> {{$user->user_full_name}}</h5>
                <p class="main-profile-name-text">  {{$user->role_name}}</p>
            </div>
        </div>
        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>@lang( 'business.username' )</b>
                <a class="pull-right">{{$user->username}}</a>
            </li>
            <li class="list-group-item">
                <b>@lang( 'business.email' )</b>
                <a class="pull-right">{{$user->email}}</a>
            </li>
            <li class="list-group-item">
                <b>{{ __('lang_v1.status_for_user') }}</b>
                @if($user->status == 'active')
                    <span class="label label-success pull-right">
                        @lang('business.is_active')
                    </span>
                @else
                    <span class="label label-danger pull-right">
                        @lang('lang_v1.inactive')
                    </span>
                @endif
            </li>
        </ul>
        @can('user.update')
            <a href="{{action([\App\Http\Controllers\ManageUserController::class, 'edit'], [$user->id])}}" class="btn btn-primary btn-small">
                <i class="glyphicon glyphicon-edit"></i>
                @lang("messages.edit")
            </a>
        @endcan
        </div>
    <!-- /.box-body -->
</div>
                    </div></div></div>

           
            </div>











            <div class="col-md-12">
                <div class="nav-tabs-custom" >
                    <div class="container">
                        <ul class="nav nav-tabs nav-justified my-custom-tabs">
                            <li class="active">
                                <a href="#user_info_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-user" aria-hidden="true"></i> @lang('lang_v1.user_info')</a>
                            </li>
                    
                            <li>
                                <a href="#documents_and_notes_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-paperclip" aria-hidden="true"></i> @lang('lang_v1.documents_and_notes')</a>
                            </li>
                    
                            <li>
                                <a href="#activities_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-pen-square" aria-hidden="true"></i> @lang('lang_v1.activities')</a>
                            </li>
                        </ul>
                    </div>
                    
                 
                    

                    <div class="tab-content card">
                        <div class="tab-pane active card-body" id="user_info_tab" >
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                            <p><strong>@lang( 'lang_v1.cmmsn_percent' ): </strong> {{$user->cmmsn_percent}}%</p>
                                    </div>
                                    <div class="col-md-6">
                                        @php
                                            $selected_contacts = ''
                                        @endphp
                                        @if(count($user->contactAccess)) 
                                            @php
                                                $selected_contacts_array = [];
                                            @endphp
                                            @foreach($user->contactAccess as $contact) 
                                                @php
                                                    $selected_contacts_array[] = $contact->name; 
                                                @endphp
                                            @endforeach 
                                            @php
                                                $selected_contacts = implode(', ', $selected_contacts_array);
                                            @endphp
                                        @else 
                                            @php
                                                $selected_contacts = __('lang_v1.all'); 
                                            @endphp
                                        @endif
                                        <p>
                                            <strong>@lang( 'lang_v1.allowed_contacts' ): </strong>
                                                {{$selected_contacts}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                      {{--       @include('user.show_details') --}}
                        </div>
                        <div class="tab-pane" id="documents_and_notes_tab">
                            <!-- model id like project_id, user_id -->
                            <input type="hidden" name="notable_id" id="notable_id" value="{{$user->id}}">
                            <!-- model name like App\User -->
                            <input type="hidden" name="notable_type" id="notable_type" value="App\User">
                            <div class="document_note_body">
                            </div>
                        </div>
                        <div class="tab-pane" id="activities_tab">
                            <div class="row">
                                <div class="col-md-12">
                                    @include('activity_log.activities')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- </section>     --}}
@endsection











@section('javascript')
    <!-- document & note.js -->
    @include('documents_and_notes.document_and_note_js')

    <script type="text/javascript">
        $(document).ready( function(){
            $('#user_id').change( function() {
                if ($(this).val()) {
                    window.location = "{{url('/users')}}/" + $(this).val();
                }
            });
        });
    </script>
@endsection