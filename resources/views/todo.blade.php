@extends('app')
@section('content')
    <div class="row">
        <div class="col-12">
            <h3>Add Todo</h3>
            <form method="POST" action="{{ route('store') }}">
                @csrf
                <div class="col-6">
                    @if(session()->has('success'))
                        <div class="alert alert-success">{{ session()->get('success') }}</div>
                    @endif

                    @if($errors->any())
                        @foreach($errors->all() as $err)
                            <div class="alert alert-danger">
                                {{ $err }}
                            </div>
                        @endforeach
                    @endif
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" placeholder="enter title.." />
                    <input type="submit" class="btn btn-primary mt-2" value="Submit" />
                </div>
            </form>
        </div>
        <div class="col-6 mt-3">
            <h3>All Todos</h3>
            <div class="card mt-3">
                <ul class="list-group p-3">
                    @foreach($todos as $todo)
                        <li class="list-group-item">
                            {{ $todo->title }}
                            <span class="badge text-bg-{{ $todo->is_completed ? 'success' : 'warning' }}">
                                    {{ $todo->is_completed ? 'Completed' : 'Pending' }}
                                </span>
                            <div class="btn-group float-end">
                                <a href="{{ route('edit', ['id' => $todo->id]) }}" class="btn btn-secondary btn-sm">Edit</a>
                                <form method='POST' class="ms-1" action="{{ route('delete', ['id' => $todo->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
