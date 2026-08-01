<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Portfolio Settings') }}
        </h2>
    </x-slot>

    <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100">
        <div class="p-6 lg:p-8 text-gray-900">
                    <form id="settingsForm" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Developer Name</label>
                                    <input type="text" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $settings['name'] ?? '' }}">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tagline / Title</label>
                                    <input type="text" name="tagline" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $settings['tagline'] ?? '' }}" placeholder="e.g. Professional Enterprise App Developer">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Contact Email</label>
                                    <input type="email" name="contact_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $settings['contact_email'] ?? '' }}">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Phone</label>
                                    <input type="text" name="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $settings['phone'] ?? '' }}">
                                </div>
                            </div>
                            
                            <!-- Right Column -->
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">About Me</label>
                                    <textarea name="about" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $settings['about'] ?? '' }}</textarea>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Profile Image</label>
                                    @if(isset($settings['profile_image']))
                                        <img src="{{ $settings['profile_image'] }}" class="h-24 w-24 rounded-full object-cover mb-3" alt="Profile Image">
                                    @endif
                                    <input type="file" name="profile_image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                </div>
                            </div>

                        </div>
                        
                        <div class="mt-6 flex justify-end">
                            <button type="button" id="saveBtn" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                Save Settings
                            </button>
                        </div>
                    </form>
                </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('saveBtn').addEventListener('click', function() {
            let form = document.getElementById('settingsForm');
            let formData = new FormData(form);
            
            let btn = this;
            btn.innerHTML = 'Saving...';
            btn.disabled = true;
            
            fetch('/admin/settings', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                btn.innerHTML = 'Save Settings';
                btn.disabled = false;
                
                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire('Error!', data.message || 'Something went wrong', 'error');
                }
            })
            .catch(error => {
                btn.innerHTML = 'Save Settings';
                btn.disabled = false;
                Swal.fire('Error!', 'An unexpected error occurred.', 'error');
                console.error('Error:', error);
            });
        });
    </script>
    @endpush
</x-app-layout>
