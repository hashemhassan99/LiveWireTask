<div>
    <div class="flex items-center justify-end py-4 text-right">
        <x-jet-button wire:click="showCreateModal">
            Create Invoice
        </x-jet-button>
    </div>

    <table class="w-full divide-y divide-gray-200">
        <thead>
        <tr>
            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-blue-500 tracking-wider">id</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-blue-500 tracking-wider">Driver</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-blue-500 tracking-wider">Category</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-blue-500 tracking-wider">Status</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-blue-500 tracking-wider">Quantity Type</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-blue-500 tracking-wider">Quantity Value</th>
                       <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-blue-500 tracking-wider">Action</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @forelse($invoices as $invoice)
            <tr>
                <td class="px-6 py-3 border-b border-gray-200">{{$invoice->id}}</td>
                <td class="px-6 py-3 border-b border-gray-200">{{$invoice->user->name}}</td>
                <td class="px-6 py-3 border-b border-gray-200">{{$invoice->category->name}}</td>
                <td class="px-6 py-3 border-b border-gray-200">{{$invoice->status}}</td>
                <td class="px-6 py-3 border-b border-gray-200">{{$invoice->quantity_type}}</td>
                <td class="px-6 py-3 border-b border-gray-200">{{$invoice->quantity_value}}</td>
                {{--                <td class="px-6 py-3 border-b border-gray-200">{{$invoice->created_at->format('Y-m-d')}}</td>--}}
                <td class="px-6 py-3 border-b border-gray-200">
                    <div class="flex items-center justify-end py-4 text-right">
                        <x-jet-button wire:click="showUpdateModal({{$invoice->id}})">
                            Edit
                        </x-jet-button>

                    </div>

                </td>
            </tr>
        @empty
            <tr>
                <td class="px-6 py-3 border-b border-gray-200" colspan="8">No Invoice Found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="pt-4">
        {{$invoices->links()}}
    </div>

    <x-jet-dialog-modal wire:model="modalForVisible">
        <x-slot name="title">
            {{$modalId ? 'update Invoice': ' Create Invoice'}}
        </x-slot>
        <x-slot name="content">

            <div class="mt-4">
                <x-jet-label for="user_id" value="user_id"></x-jet-label>
                <select class="rounded block w-full" wire:model="user_id">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
                @error('user_id')
                <span class="text-red-900 text-sm">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="category_id" value="category_id"></x-jet-label>
                <select class="rounded block w-full" wire:model="category_id">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category_id')
                <span class="text-red-900 text-sm">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="quantity_value" value="Quantity"></x-jet-label>
                <select class="rounded" wire:model="quantity_type">
                    <option>Amount</option>
                    <option>Liters</option>
                </select>
                <x-jet-input id="quantity_value" type="number" wire:model="quantity_value" class="w-3/4"></x-jet-input>
                @error('quantity_value')
                <span class="text-red-900 text-sm">{{$message}}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="status" value="Status"></x-jet-label>
                <select class="rounded w-full" wire:model="status">
                    <option value="0">InActive</option>
                    <option value="1">Active</option>
                </select>
            </div>


        </x-slot>

        <x-slot name="footer">
            @if ($modalId)
                <x-jet-button wire:click="update">Update Invoice</x-jet-button>
            @else
                <x-jet-button wire:click="store">Create Invoice</x-jet-button>

            @endif

            <x-jet-secondary-button class="ml-2">
                Cancel
            </x-jet-secondary-button>
        </x-slot>

    </x-jet-dialog-modal>


</div>
