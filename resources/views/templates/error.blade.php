@if ($errors->any())
    <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white">
        <div class="p-3">
                @foreach (array_unique($errors->all()) as $error)
                    <li>{{ $error }}</li>
                @endforeach
        </div>
    </div>
@endif




