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
            minlength: "Name must be at least 1 character",
            maxlength: "Name cannot exceed 255 characters"
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
            type: 'POST', // Keep as POST, we're using _method for PATCH
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Show success message
                    const successMessage = document.createElement('div');
                    successMessage.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50 animate-fade-in-up';
                    successMessage.textContent = 'Group updated successfully!';
                    
                    // Add animation keyframes if not already present
                    if (!document.querySelector('#toast-animation')) {
                        const style = document.createElement('style');
                        style.id = 'toast-animation';
                        style.textContent = `
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
                        `;
                        document.head.appendChild(style);
                    }
                    
                    document.body.appendChild(successMessage);
                    
                    // Close modal
                    closeEditGroupModal();
                    
                    // Redirect after a brief delay to show the message
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 1000);
                } else if (response.errors) {
                    displayEditGroupErrors(response.errors);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                displayEditGroupErrors({
                    general: 'An error occurred while updating the group. Please try again.'
                });
            }
        });
        
        return false;
    }
});
</script>