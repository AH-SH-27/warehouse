<x-app-layout>
    <x-slot name="header">Manage Categories</x-slot>

    <a href="{{ route('category.create') }}" class="btn btn-primary">Add Category</a>

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('category.edit', $category) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('category.destroy', $category) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
