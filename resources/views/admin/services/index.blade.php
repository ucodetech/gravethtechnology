<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Your Services</h3>
                    <button onclick="openModal()" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">Add New Service</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="servicesList">
                    @forelse($services as $service)
                        <div class="border rounded-lg p-4 shadow-sm relative group" id="service-{{ $service->id }}">
                            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                                <button onclick="editService({{ $service->id }})" class="text-blue-500 hover:text-blue-700 mr-2"><i class="fas fa-edit"></i> Edit</button>
                                <button onclick="deleteService({{ $service->id }})" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i> Delete</button>
                            </div>
                            <div class="text-3xl text-indigo-500 mb-3">
                                {!! $service->icon !!}
                            </div>
                            <h4 class="text-xl font-semibold mb-2">{{ $service->title }}</h4>
                            <p class="text-gray-600 text-sm">{{ $service->description }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-3 text-center py-4">No services added yet.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

    <!-- Service Modal -->
    <div id="serviceModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle">Add Service</h3>
                <div class="mt-2 px-7 py-3 text-left">
                    <form id="serviceForm">
                        @csrf
                        <input type="hidden" id="service_id" name="id">
                        <input type="hidden" id="_method" name="_method" value="POST">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                            <input type="text" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Icon (SVG or FontAwesome)</label>
                            <input type="text" id="icon" name="icon" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="<svg>...</svg>">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required rows="4"></textarea>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</button>
                            <button type="submit" id="saveServiceBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        function openModal() {
            document.getElementById('serviceModal').classList.remove('hidden');
            document.getElementById('serviceForm').reset();
            document.getElementById('service_id').value = '';
            document.getElementById('_method').value = 'POST';
            document.getElementById('modalTitle').innerText = 'Add Service';
        }

        function closeModal() {
            document.getElementById('serviceModal').classList.add('hidden');
        }

        function editService(id) {
            fetch(`/admin/services/${id}/edit`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('service_id').value = data.id;
                    document.getElementById('title').value = data.title;
                    document.getElementById('icon').value = data.icon;
                    document.getElementById('description').value = data.description;
                    document.getElementById('_method').value = 'PUT';
                    document.getElementById('modalTitle').innerText = 'Edit Service';
                    document.getElementById('serviceModal').classList.remove('hidden');
                });
        }

        function deleteService(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/services/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success) {
                            Swal.fire('Deleted!', data.message, 'success').then(() => window.location.reload());
                        }
                    });
                }
            })
        }

        document.getElementById('serviceForm').addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let id = document.getElementById('service_id').value;
            let url = id ? `/admin/services/${id}` : `{{ route('admin.services.store') }}`;
            
            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    closeModal();
                    Swal.fire('Success', data.message, 'success').then(() => window.location.reload());
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
