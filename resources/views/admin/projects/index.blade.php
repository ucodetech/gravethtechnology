<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Your Projects</h3>
                    <button onclick="openModal()" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">Add New Project</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="projectsList">
                    @forelse($projects as $project)
                        <div class="border rounded-lg p-4 shadow-sm relative group overflow-hidden" id="project-{{ $project->id }}">
                            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition z-10 bg-white/80 p-1 rounded-md backdrop-blur-sm">
                                <button onclick="editProject('{{ $project->id }}')" class="text-blue-600 hover:text-blue-800 mr-2"><i class="fas fa-edit"></i> Edit</button>
                                <button onclick="deleteProject('{{ $project->id }}')" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i> Delete</button>
                            </div>
                            
                            @if($project->image)
                                <img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-full h-40 object-cover rounded-md mb-3">
                            @else
                                <div class="w-full h-40 bg-gray-200 rounded-md mb-3 flex items-center justify-center text-gray-500">
                                    <i class="fas fa-image text-3xl"></i>
                                </div>
                            @endif
                            
                            <h4 class="text-xl font-semibold mb-1 truncate">{{ $project->title }}</h4>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $project->description }}</p>
                            
                            @if($project->link)
                                <a href="{{ $project->link }}" target="_blank" class="text-indigo-600 text-sm hover:underline"><i class="fas fa-external-link-alt"></i> View Project</a>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-3 text-center py-4">No projects added yet.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

    <!-- Project Modal -->
    <div id="projectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-10 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-gray-900 text-center mb-4" id="modalTitle">Add Project</h3>
                <form id="projectForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="project_id" name="id">
                    <input type="hidden" id="_method" name="_method" value="POST">
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Title <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Project Link (URL)</label>
                        <input type="url" id="link" name="link" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500" placeholder="https://...">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Image <span class="text-xs text-gray-500 font-normal">(Leave blank to keep current image on edit)</span></label>
                        <input type="file" id="image" name="image" accept="image/*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                        <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500" rows="3"></textarea>
                    </div>
                    
                    <div class="flex items-center justify-between mt-6">
                        <button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition">Cancel</button>
                        <button type="submit" id="saveProjectBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition shadow-md">Save Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        function openModal() {
            document.getElementById('projectModal').classList.remove('hidden');
            document.getElementById('projectForm').reset();
            document.getElementById('project_id').value = '';
            document.getElementById('_method').value = 'POST';
            document.getElementById('modalTitle').innerText = 'Add Project';
            document.getElementById('saveProjectBtn').innerText = 'Save Project';
            document.getElementById('saveProjectBtn').disabled = false;
        }

        function closeModal() {
            document.getElementById('projectModal').classList.add('hidden');
        }

        function editProject(id) {
            fetch('/admin/projects/' + id + '/edit')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('project_id').value = data.id;
                    document.getElementById('title').value = data.title;
                    document.getElementById('link').value = data.link || '';
                    document.getElementById('description').value = data.description || '';
                    document.getElementById('_method').value = 'PUT';
                    document.getElementById('modalTitle').innerText = 'Edit Project';
                    document.getElementById('projectModal').classList.remove('hidden');
                });
        }

        function deleteProject(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/admin/projects/' + id, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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

        document.getElementById('projectForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            let btn = document.getElementById('saveProjectBtn');
            btn.innerText = 'Uploading...';
            btn.disabled = true;

            let formData = new FormData(this);
            let id = document.getElementById('project_id').value;
            let url = id ? '/admin/projects/' + id : '/admin/projects';
            
            // In Laravel, when using PUT with FormData (multipart/form-data),
            // you must use POST method and append _method=PUT to the form (which we did).
            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    closeModal();
                    Swal.fire('Success', data.message, 'success').then(() => window.location.reload());
                } else {
                    btn.innerText = 'Save Project';
                    btn.disabled = false;
                    Swal.fire('Error', data.message || 'Something went wrong', 'error');
                }
            })
            .catch(err => {
                btn.innerText = 'Save Project';
                btn.disabled = false;
                Swal.fire('Error', 'An error occurred during the upload.', 'error');
            });
        });
    </script>
    @endpush
</x-app-layout>
