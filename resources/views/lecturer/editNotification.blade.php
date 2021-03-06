@extends('layouts.listingL')
@section('listing.content')

<div class="row">
    <div class="col-md-6 mx-auto">
        <div role="main" class="cover my-auto ">
            <div class="card">
                <div class="card-header text-dark">
                  <p class="lead">Edit Announcement</p>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        {{method_field('PUT')}}
                        <input class="form-control" type="text" name="title" placeholder="Announcement Name" required value="{{$notification->title}}"><br/>
                        <input class="form-control" type="hidden" name="type" value="level"><br/>
                        <textarea class="form-control" type="text" name="content" placeholder="Announcement Description" required >{{$notification->content}}</textarea><br>
                        <select class="form-control" name="level_id" required>
                            <option value="">Select Level</option>
                                @foreach($levels as $level)
                                    <option value="{{ $level->id }}" @if ($level == $notification->level) selected  @endif>{{ $level->level }}</option>
                                @endforeach
                        </select>

                        <input type="hidden" name="lecturer_id" value="{{ Auth::user()->lecturer->id }}">

                        <button class="btn btn-lg btn-dark mt-5 form-control">Edit Announcement</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
