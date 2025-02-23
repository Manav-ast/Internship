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
                        // Show success message
                        const successMessage = document.createElement('div');
                        successMessage.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50 animate-fade-in-up';
                        successMessage.textContent = response.message || 'Category added successfully!';
                        
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
                        closeModal();
                        
                        // Redirect after a brief delay
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 1000);
                    } else {
                        displayErrors(response.errors || 'Failed to add category');
                    }
                },
                error: function() {
                    displayErrors('An error occurred while adding the category. Please try again.');
                }
            });
            
            return false;
        }
    });
});
</script>