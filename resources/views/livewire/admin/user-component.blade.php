<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ __('Users') }}
        </h2>
    </x-slot>
   
    <x-table-responsive>

        <div class="px-6 py-4">
            <x-jet-input wire:model.debounce.500ms='search' class="form-control w-full" type="text"
                placeholder="Ingrese el nombre del producto que desea buscar" />
        </div>
        @if (count($users))
        <table class="min-w-full table-auto divide-y divide-gray-200 border-t border-b border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('ID') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('Name') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('Email') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('Role') }}
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">{{ __('Edit') }}</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr wire:key='{{ $user->email }}'>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class=" text-trueGray-700">
                                {{ $user->id }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class=" text-trueGray-700">
                                {{ $user->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class=" text-trueGray-700">
                                {{ $user->email }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class=" text-trueGray-700">
                               
                                @if ($user->roles->count())
                                <p class="rounded-full bg-green-100 text-green-800 px-2 inline-flex leading-5">
                                    {{ __('Administrator') }}
                                </p>
                                   
                                @else
                                <p class="rounded-full bg-yellow-100 text-yellow-700 px-2 inline-flex leading-5">
                                    Sin Rol
                                </p>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <label>
                                <input wire:change='assignRole({{ $user->id }}, $event.target.value)'
                                 {{ count($user->roles) ? 'checked' : ''}} value="1" type="radio" name="{{ $user->email }}">
                                SI
                            </label>
                            <label class="ml-2">
                                <input wire:change='assignRole({{ $user->id }}, $event.target.value)'
                                 {{ count($user->roles) ? '' : 'checked'}} value="0" type="radio" name="{{ $user->email }}">
                                NO
                            </label>
                        </td>
                    </tr>
                @endforeach
                <!-- More people... -->
            </tbody>

        </table>
        @if ($users->hasPages())
            <div class="px-6 py-4 ">
                {{ $users->links() }}
            </div>
        @endif
        @else

        <div class="px-6 py-4 text-center md:text-left">
            No hay ningún registro coincidente
        </div>
        @endif
    </x-table-responsive>
   
        
    
        

    


</div>
