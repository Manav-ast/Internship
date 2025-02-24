<!-- Add Category Modal -->
<div id="groupModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Add Group</h2>
        <form id="addGroupForm" action="/addGroup" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Group Name</label>
                <input type="text" 
                       name="group_name" 
                       placeholder="Enter group name" 
                       class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       required>
                <div class="text-red-500 text-sm mt-1" id="group_name_error"></div>
            </div>
            
            <!-- General error message container -->
            <div class="mb-4 hidden" id="addGroupError">
                <div class="text-red-500 text-sm"></div>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" 
                        onclick="closeModal()" 
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-150">
                    Cancel
                </button>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-150">
                    Add Group
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal() {
    // Reset form and errors
    $('#addGroupForm').trigger('reset');
    $('#addGroupForm').validate().resetForm();
    clearErrors();
    
    // Show modal
    document.getElementById('groupModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('groupModal').classList.add('hidden');
    $('#addGroupForm').trigger('reset');
    clearErrors();
}

function clearErrors() {
    // Clear field error
    $('#group_name_error').text('');
    // Hide general error container
    $('#addGroupError').addClass('hidden').find('div').text('');
    // Remove error styling
    $('input[name="group_name"]').removeClass('border-red-500');
}

function displayErrors(errors) {
    clearErrors();
    
    if (typeof errors === 'object') {
        if (errors.group_name) {
            $('#group_name_error').text(errors.group_name);
            $('input[name="group_name"]').addClass('border-red-500');
        }
        if (errors.general) {
            $('#addGroupError').removeClass('hidden').find('div').text(errors.general);
        }
    } else if (typeof errors === 'string') {
        $('#addGroupError').removeClass('hidden').find('div').text(errors);
    }
}

$(document).ready(function() {
    $('#addGroupForm').validate({
        rules: {
            group_name: {
                required: true,
                minlength: 1,
                maxlength: 255
            }
        },
        messages: {
            group_name: {
                required: "Please enter a group name",
                minlength: "Group name must be at least 1 character",
                maxlength: "Group name cannot exceed 255 characters"
            }
        },
        errorElement: 'div',
        errorClass: 'text-red-500 text-sm mt-1',
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        highlight: function(element) {
            $(element).addClass('border-red-500');
        },
        unhighlight: function(element) {
            $(element).removeClass('border-red-500');
        },
        submitHandler: function(form) {
            const formData = $(form).serialize();
            
            $.ajax({
                url: form.action,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Close the modal
                        closeModal();
                        
                        // Fetch and update the groups list
                        $.ajax({
                            url: '/getGroups',
                            type: 'GET',
                            success: function(groupsData) {
                                // Update the groups dropdown in expense modal
                                const groupSelect = $('#group_id');
                                const editGroupSelect = $('#editExpenseGroup');
                                groupSelect.empty();
                                editGroupSelect.empty();
                                groupSelect.append('<option value="">Select Category</option>');
                                editGroupSelect.append('<option value="">Select Category</option>');
                                groupsData.forEach(group => {
                                    const option = `<option value="${group.id}">${group.name}</option>`;
                                    groupSelect.append(option);
                                    editGroupSelect.append(option);
                                });
                                
                                // Update the groups list in the sidebar
                                const groupsList = $('.space-y-3');
                                if (groupsList.length) {
                                    groupsList.html(groupsData.map(group => `
                                        <div class="flex items-center justify-between py-2 px-3 bg-gray-50 rounded-lg group hover:bg-gray-100">
                                            <span class="text-gray-700">${group.name}</span>
                                            <div class="hidden group-hover:flex items-center space-x-2">
                                                <button onclick="openEditGroupModal(${group.id}, '${group.name}')" 
                                                        class="text-gray-500 hover:text-blue-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                    </svg>
                                                </button>
                                                <button onclick="openDeleteGroupModal(${group.id})" 
                                                        class="text-gray-500 hover:text-red-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    `).join(''));
                                }
                            },
                            error: function() {
                                showToast('Error fetching updated groups list', 'error');
                            }
                        });
                        
                        // Show success message
                        showToast(response.message || 'Category added successfully!', 'success');
                    } else {
                        displayErrors(response.errors);
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred while adding the category';
                    try {
                        const response = JSON.parse(xhr.responseText);
                        if (response.errors) {
                            displayErrors(response.errors);
                            return;
                        }
                    } catch (e) {}
                    displayErrors({ general: errorMessage });
                }
            });
            
            return false;
        }
    });
});

// Toast notification function
function showToast(message, type = 'success') {
    const $toast = $('<div>')
        .addClass(`fixed bottom-4 right-4 px-6 py-3 rounded shadow-lg z-50 animate-fade-in-up ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`)
        .text(message);
    
    $('body').append($toast);
    
    setTimeout(() => {
        $toast.remove();
    }, 3000);
}
</script>

<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.3s ease-out;
}
</style>