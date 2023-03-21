@extends('layouts.dashboard')

@section("title","Profile")

@section('content')
<form action="{{route('profile.update')}}" method="post" class="p-3" >
  @method("PATCH")
    @csrf
    <h3>Edit Profile</h3>
    <div class="from-row d-flex">
        <div class="col-md-6">
            <label for="">First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{$user->profile->first_name}}">
        </div>
        <div class="col-md-6">
            <label for="">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{$user->profile->last_name}}">
        </div>
    </div>
    <div class="from-row d-flex">
        <div class="col-md-4">
            <label for="">Birthday</label>
            <input type="date" name="birthday" class="form-control" value="{{$user->profile->birthday}}">
        </div>
        <div class="col-md-4">
            <label for="">Gender</label>
            <input type="radio" name="gender" class="form-control" value="male" @checked($user->profile->gender == "male")>
            <input type="radio" name="gender" class="form-control" value="female" @checked($user->profile->gender == "female")>
        </div>
    </div>
    <div class="from-row d-flex">
        <div class="col-md-4">
            <label for="">Street Adresse</label>
            <input type="text" name="street_adress" class="form-control" value="{{$user->profile->street_adress}}">
        </div>
        <div class="col-md-4">
            <label for="">City</label>
            <input type="text" name="city" class="form-control" value="{{$user->profile->city}}">
        </div>
        <div class="col-md-4">
            <label for="">State</label>
            <input type="text" name="state" class="form-control" value="{{$user->profile->state}}">
        </div>
    </div>
    <div class="from-row d-flex">
        <div class="col-md-4">
            <label for="">Postal Code</label>
            <input type="text" name="post_code" class="form-control" value="{{$user->profile->post_code}}">
        </div>
        <div class="col-md-4">
            <label for="">Country</label>
            <select name="country" id="" class="form-control">
                @foreach($countries as $country)
                    <option value{{$country}} @selected($country == $user->profile->country)>{{$country}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="">Locale</label>
            <select name="locale" id="" class="form-control">
                @foreach($locale as $local)
                    <option @selected($local == $user->profile->locale)>{{$local}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="from-group p-2">  
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
@endsection