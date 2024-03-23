@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($notes->count())
                <div class="list-group">
                    @foreach ($notes as $note)
                        <div class="list-group-item">
                            <h5>{{ $note->title }}</h5>
                            <p>{{ $note->content }}</p>
                            <small>Created at: {{ $note->created_at->format('Y-m-d H:i:s') }}</small>
                            <small>Updated at: {{ $note->updated_at->format('Y-m-d H:i:s') }}</small>
                            <div class="mt-2">
                                <!-- Edit Note Link -->
                                <a href="{{ route('notes.edit', $note) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                                <!-- Delete Note Form -->
                                <form action="{{ route('notes.destroy', $note) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this note?')">{{ __('Delete') }}</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>{{ __('No notes found.') }}</p>
            @endif
        </div>
    </div>
@endsection
