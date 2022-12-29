<section>
    <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <h1>Create a new category</h1>
        <input type="text" name="name">
        <button type="submit">{{ __('create') }}</button>
    </form>
</section>