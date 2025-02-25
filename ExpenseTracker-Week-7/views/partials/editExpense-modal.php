<div id="editExpenseModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-bold text-gray-700 mb-4">Edit Expense</h2>
        <form id="editExpenseForm" method="POST" action="/editExpense">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" id="editExpenseId">
            
            <div class="mb-4">
                <label class="block text-gray-700">Expense Name</label>
                <input type="text" name="expense_name" id="editExpenseName" 
                       class="w-full p-2 border rounded mt-2" required
                       minlength="1" maxlength="255">
                <span class="text-red-500 text-sm error-message" data-field="expense_name"></span>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700">Amount</label>
                <input type="number" step="0.01" name="amount" id="editExpenseAmount" 
                       class="w-full p-2 border rounded mt-2" required
                       min="0.01">
                <span class="text-red-500 text-sm error-message" data-field="amount"></span>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700">Date</label>
                <input type="date" name="date" id="editExpenseDate" 
                       class="w-full p-2 border rounded mt-2" required>
                <span class="text-red-500 text-sm error-message" data-field="date"></span>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700">Group</label>
                <select name="group_id" id="editExpenseGroup" class="w-full p-2 border rounded mt-2" required>
                    <?php if (!empty($groups)): ?>
                        <?php foreach ($groups as $group): ?>
                            <option value="<?= $group['id'] ?>"><?= htmlspecialchars($group['name']) ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No groups available</option>
                    <?php endif; ?>
                </select>
                <span class="text-red-500 text-sm error-message" data-field="group_id"></span>
            </div>

            <!-- General error message container -->
            <div class="mb-4 hidden" id="editGeneralError">
                <span class="text-red-500 text-sm error-message" data-field="general"></span>
            </div>

            <div class="flex justify-end">
                <button type="button" onclick="closeEditModal()" 
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Update Expense
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(id, name, amount, date, groupId) {
    // Set form values
    document.getElementById('editExpenseId').value = id;
    document.getElementById('editExpenseName').value = name;
    document.getElementById('editExpenseAmount').value = amount;
    document.getElementById('editExpenseDate').value = date;
    document.getElementById('editExpenseGroup').value = groupId;
    
    // Clear any previous errors
    clearEditErrors();
    
    // Show modal
    document.getElementById('editExpenseModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editExpenseModal').classList.add('hidden');
    $('#editExpenseForm').trigger('reset');
    editValidator.resetForm();
    clearEditErrors();
}

function clearEditErrors() {
    // Clear all error messages
    $('#editExpenseModal .error-message').text('');
    // Hide general error container
    $('#editGeneralError').addClass('hidden');
    // Remove error styling from fields
    $('#editExpenseModal .border-red-500').removeClass('border-red-500');
}

function displayEditErrors(errors) {
    clearEditErrors();
    
    if (typeof errors === 'object') {
        // Display field-specific errors
        Object.entries(errors).forEach(([field, message]) => {
            const errorSpan = $(`#editExpenseModal .error-message[data-field="${field}"]`);
            if (errorSpan.length) {
                errorSpan.text(message);
                // Add error styling to the field
                $(`#editExpenseModal [name="${field}"]`).addClass('border-red-500');
            } else if (field === 'general') {
                // Show general error
                $('#editGeneralError').removeClass('hidden')
                    .find('.error-message').text(message);
            }
        });
    } else {
        // Show general error for string error message
        $('#editGeneralError').removeClass('hidden')
            .find('.error-message').text(errors);
    }
}

// Initialize jQuery validation for edit form
const editValidator = $('#editExpenseForm').validate({
    rules: {
        expense_name: {
            required: true,
            minlength: 1,
            maxlength: 255
        },
        amount: {
            required: true,
            number: true,
            min: 0.01
        },
        date: {
            required: true,
            date: true
        },
        group_id: {
            required: true
        }
    },
    messages: {
        expense_name: {
            required: "Please enter an expense name",
            minlength: "Name must be at least 1 character",
            maxlength: "Name cannot exceed 255 characters"
        },
        amount: {
            required: "Please enter an amount",
            number: "Please enter a valid number",
            min: "Amount must be greater than 0"
        },
        date: {
            required: "Please select a date",
            date: "Please enter a valid date"
        },
        group_id: {
            required: "Please select a group"
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
                    // Show success message
                    const successMessage = document.createElement('div');
                    successMessage.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50 animate-fade-in-up';
                    successMessage.textContent = 'Expense updated successfully!';
                    
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
                    closeEditModal();
                    
                    // Redirect after a brief delay to show the message
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 1000);
                } else if (response.errors) {
                    displayEditErrors(response.errors);
                }
            },
            error: function() {
                displayEditErrors({
                    general: 'An error occurred while updating the expense. Please try again.'
                });
            }
        });
        
        return false;
    }
});
</script>
