<div id="editGroupModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Edit Group</h2>
        <form id="editGroupForm" action="/editGroup" method="POST">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="group_id" id="edit_group_id">
            
            <div class="mb-4">
                <label class="block text-gray-700">Group Name</label>
                <input type="text" name="group_name" id="edit_group_name" 
                       placeholder="Enter group name" 
                       class="w-full p-2 border rounded-lg" 
                       required minlength="1" maxlength="255">
                <span class="text-red-500 text-sm error-message" data-field="group_name"></span>
            </div>

            <!-- General error message container -->
            <div class="mb-4 hidden" id="editGroupGeneralError">
                <span class="text-red-500 text-sm error-message" data-field="general"></span>
            </div>

            <div class="flex justify-end">
                <button type="button" onclick="closeEditGroupModal()" 
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditGroupModal(groupId, groupName) {
    // Reset form and errors
    $('#editGroupForm').trigger('reset');
    editGroupValidator.resetForm();
    clearEditGroupErrors();
    
    // Set values
    document.getElementById('edit_group_id').value = groupId;
    document.getElementById('edit_group_name').value = groupName;
    
    // Show modal
    document.getElementById('editGroupModal').classList.remove('hidden');
}

function closeEditGroupModal() {
    document.getElementById('editGroupModal').classList.add('hidden');
    $('#editGroupForm').trigger('reset');
    editGroupValidator.resetForm();
    clearEditGroupErrors();
}

function clearEditGroupErrors() {
    // Clear all error messages
    $('#editGroupModal .error-message').text('');
    // Hide general error container
    $('#editGroupGeneralError').addClass('hidden');
    // Remove error styling from fields
    $('#editGroupModal .border-red-500').removeClass('border-red-500');
}

function displayEditGroupErrors(errors) {
    clearEditGroupErrors();
    
    if (typeof errors === 'object') {
        // Display field-specific errors
        Object.entries(errors).forEach(([field, message]) => {
            const errorSpan = $(`#editGroupModal .error-message[data-field="${field}"]`);
            if (errorSpan.length) {
                errorSpan.text(message);
                // Add error styling to the field
                $(`#editGroupModal [name="${field}"]`).addClass('border-red-500');
            } else if (field === 'general') {
                // Show general error
                $('#editGroupGeneralError').removeClass('hidden')
                    .find('.error-message').text(message);
            }
        });
    } else {
        // Show general error for string error message
        $('#editGroupGeneralError').removeClass('hidden')
            .find('.error-message').text(errors);
    }
}

// Initialize jQuery validation for edit group form
const editGroupValidator = $('#editGroupForm').validate({
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
    errorElement: 'span',
    errorClass: 'text-red-500 text-sm',
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
                    closeEditGroupModal();
                    
                    // Fetch and update the groups list
                    $.ajax({
                        url: '/getGroups',
                        type: 'GET',
                        success: function(groupsData) {
                            // Update the groups dropdown in expense modal
                            const groupSelect = $('#groupSelect');
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
                            // Update expenses list to reflect the new group name
                            fetchAndUpdateExpenses();
                        },
                        error: function() {
                            showToast('Error fetching updated groups list', 'error');
                        }
                    });
                    
                    // Show success message
                    showToast('Group updated successfully!');
                } else {
                    displayEditGroupErrors(response.errors);
                }
            },
            error: function(xhr) {
                let errorMessage = 'An error occurred while updating the group';
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.errors) {
                        displayEditGroupErrors(response.errors);
                        return;
                    }
                } catch (e) {}
                displayEditGroupErrors({ general: errorMessage });
            }
        });
        
        return false;
    }
});

// Toast notification function (if not already defined elsewhere)
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded shadow-lg z-50 animate-fade-in-up ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    } text-white`;
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
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