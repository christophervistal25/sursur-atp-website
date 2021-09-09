<td class="border-b w-5">
    <div class="flex sm:justify-center items-center ">
        <a class="flex items-center mr-3 rounded-full p-3 bg-white shadow" href="{{ str_replace('public/', '', route('personnel.logs', $person->id)) }}" title="View Profile"> 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye mx-auto"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
        </a>

        <a class="flex items-center bg-white rounded-full p-3 mr-3 shadow" href="{{ str_replace('public/', '', route('personnel.edit', $person->id)) }}" title="Edit Personnel"> 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 mx-auto">
                <path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
            </svg>
        </a>

        @if(!$person->account->status)
            <a class="flex items-center bg-white rounded-full p-3 shadow" href="{{ str_replace('public/', '', route('admin.print.qr', $person->id)) }}" title="View generated I.D"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer mx-auto"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
            </a>
        @endif
    </div>
</td>

