<!-- Add Expense Modal -->
<div id="expenseModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Add Expense</h2>
        <form action="/addExpense" method="POST" id="expenseForm" class="expense-form">
            <div class="mb-4">
                <label class="block text-gray-700">Expense Name</label>
                <input type="text" name="expense_name" placeholder="Enter expense name" 
                       class="w-full p-2 border rounded-lg" required
                       minlength="1" maxlength="255">
                <span class="text-red-500 text-sm error-message" data-field="expense_name"></span>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Amount</label>
                <input type="number" name="amount" placeholder="Enter amount" 
                       class="w-full p-2 border rounded-lg" required
                       min="0.01" step="0.01">
                <span class="text-red-500 text-sm error-message" data-field="amount"></span>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Date</label>
                <input type="date" name="date" id="expenseDate" 
                       class="w-full p-2 border rounded-lg" required>
                <span class="text-red-500 text-sm error-message" data-field="date"></span>
            </div>

            <?php if (!empty($groups)): ?>
                <div class="mb-4">
                    <label class="block text-gray-700">Group</label>
                    <select name="group_id" id="groupSelect" class="w-full p-2 border rounded-lg" required>
                        <?php foreach ($groups as $group): ?>
                            <option value="<?= $group['id'] ?>"><?= htmlspecialchars($group['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="text-red-500 text-sm error-message" data-field="group_id"></span>
                </div>
            <?php else: ?>
                <div class="mb-4">
                    <label class="block text-gray-700">Group</label>
                    <select name="group_id" id="groupSelect" class="w-full p-2 border rounded-lg" required>
                        <option value="">No groups available</option>
                    </select>
                    <span class="text-red-500 text-sm error-message" data-field="group_id"></span>
                </div>
            <?php endif; ?>

            <!-- General error message container -->
            <div class="mb-4 hidden" id="generalError">
                <span class="text-red-500 text-sm error-message" data-field="general"></span>
            </div>

            <div class="flex justify-end">
                <button type="button" onclick="closeExpenseModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Add Expense
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script to Open and Close the Expense Modal -->
<script>
function getCurrentDate() {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

function openExpenseModal() {
    // Reset the form first
    $('#expenseForm').trigger('reset');
    validator.resetForm();
    clearErrors();

    // Set current date
    document.getElementById('expenseDate').value = getCurrentDate();
    
    // Select first group if available
    const groupSelect = document.getElementById('groupSelect');
    if (groupSelect && groupSelect.options.length > 0) {
        groupSelect.selectedIndex = 0;
    }

    // Show the modal
    document.getElementById('expenseModal').classList.remove('hidden');
}

function closeExpenseModal() {
    document.getElementById('expenseModal').classList.add('hidden');
    $('#expenseForm').trigger('reset');
    validator.resetForm();
    clearErrors();
}

function clearErrors() {
    // Clear all error messages
    $('.error-message').text('');
    // Hide general error container
    $('#generalError').addClass('hidden');
    // Remove error styling from fields
    $('.border-red-500').removeClass('border-red-500');
}

function displayServerErrors(errors) {
    clearErrors();
    
    if (typeof errors === 'object') {
        // Display field-specific errors
        Object.entries(errors).forEach(([field, message]) => {
            const errorSpan = $(`.error-message[data-field="${field}"]`);
            if (errorSpan.length) {
                errorSpan.text(message);
                // Add error styling to the field
                $(`[name="${field}"]`).addClass('border-red-500');
            } else if (field === 'general') {
                // Show general error
                $('#generalError').removeClass('hidden')
                    .find('.error-message').text(message);
            }
        });
    } else {
        // Show general error for string error message
        $('#generalError').removeClass('hidden')
            .find('.error-message').text(errors);
    }
}

// Initialize jQuery validation
const validator = $('.expense-form').validate({
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
                    successMessage.textContent = 'Expense added successfully!';
                    
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
                    closeExpenseModal();
                    
                    // Redirect after a brief delay to show the message
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 1000);
                } else if (response.errors) {
                    displayServerErrors(response.errors);
                }
            },
            error: function() {
                displayServerErrors({
                    general: 'An error occurred while saving the expense. Please try again.'
                });
            }
        });
        
        return false;
    }
});
</script>