<td class="border-b w-5">
    @if(!$person->account->status)
        <div class="flex sm:justify-center items-center">
            <a class="flex items-center mr-3 rounded-full p-3 bg-white shadow" href="{{ str_replace('public/', '', route('people.track.show', $person->id)) }}" title="Track Personnel">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin mx-auto"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            </a>
        </div>
    @else
        <span class='px-2 py-1 bg-theme-6 rounded text-xs font-medium text-white rounded-full'>
            Incomplete Information
        </span>
    @endif
</td>

