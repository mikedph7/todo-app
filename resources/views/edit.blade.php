@extends('app')
@section('content')

    <div class="row">
        <h3>Edit ToDo</h3>
        <form method="POST" action="{{ route('update', [ 'id' => $todo->id ]) }}">
            @csrf
            @method('PUT')
            <div class="col-6">
                <label>Title</label>
                <input type="text" class="form-control mb-1" name="title" value="{{ $todo->title }}" />
                <label for="is_completed">Select Status</label>
                <select name="is_completed" class="form-control">
                    <option value="1" @if($todo->is_completed) selected @endif >Completed</option>
                    <option value="0" @if(!$todo->is_completed) selected @endif >Pending</option>
                </select>
                <input type="submit" class="btn btn-primary mt-2" value="Submit" />
            </div>
        </form>
    </div>

@endsection
