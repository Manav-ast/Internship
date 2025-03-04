<!-- Add Expense Modal -->
<div id="expenseModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Add Expense</h2>
        <form id="expenseForm" class="expense-form" onsubmit="return false;">
            <input type="hidden" name="_method" value="POST">
            <div class="mb-4">
                <label class="block text-gray-700">Expense Name</label>
                <input type="text" name="expense_name" placeholder="Enter expense name" 
                       class="w-full p-2 border rounded-lg" required
                       minlength="1" maxlength="255">
                <div class="text-red-500 text-sm mt-1 error-message" data-field="expense_name"></div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Amount</label>
                <input type="number" name="amount" placeholder="Enter amount" 
                       class="w-full p-2 border rounded-lg" required
                       min="0.01" step="0.01">
                <div class="text-red-500 text-sm mt-1 error-message" data-field="amount"></div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Date</label>
                <input type="date" name="date" id="expenseDate" 
                       class="w-full p-2 border rounded-lg" required>
                <div class="text-red-500 text-sm mt-1 error-message" data-field="date"></div>
            </div>

            <?php if (!empty($groups)): ?>
                <div class="mb-4">
                    <label class="block text-gray-700">Group</label>
                    <select name="group_id" id="groupSelect" class="w-full p-2 border rounded-lg" required>
                        <?php foreach ($groups as $group): ?>
                            <option value="<?= $group['id'] ?>"><?= htmlspecialchars($group['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="text-red-500 text-sm mt-1 error-message" data-field="group_id"></div>
                </div>
            <?php else: ?>
                <div class="mb-4">
                    <label class="block text-gray-700">Group</label>
                    <select name="group_id" id="groupSelect" class="w-full p-2 border rounded-lg" required>
                        <option value="">No groups available</option>
                    </select>
                    <div class="text-red-500 text-sm mt-1 error-message" data-field="group_id"></div>
                </div>
            <?php endif; ?>

            <!-- General error message container -->
            <div class="mb-4 hidden" id="generalError">
                <div class="text-red-500 text-sm error-message" data-field="general"></div>
            </div>

            <div class="flex justify-end mt-6 space-x-2">
                <button type="button" onclick="closeExpenseModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Save
                </button>
                <button type="button" id="deleteExpenseBtn" onclick="handleDeleteExpense()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 hidden">
                    Delete
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script to Open and Close the Expense Modal -->
<script>
$(document).ready(function() {
    $('#expenseForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
    });
});

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
    if (groupSelect && groupSelect.options.length > 1) { // Changed from > 0 to > 1 to account for default option
        groupSelect.selectedIndex = 1; // Select the first actual group (index 1)
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
const validator = $('#expenseForm').validate({
    rules: {
        expense_name: {
            required: true,
            minlength: 1,
            maxlength: 255
        },
        amount: {
            required: true,
            min: 0.01
        },
        date: {
            required: true
        },
        group_id: {
            required: true
        }
    },
    messages: {
        expense_name: {
            required: "Please enter an expense name",
            minlength: "Expense name must be at least 1 character",
            maxlength: "Expense name cannot exceed 255 characters"
        },
        amount: {
            required: "Please enter an amount",
            min: "Amount must be greater than 0"
        },
        date: {
            required: "Please select a date"
        },
        group_id: {
            required: "Please select a group"
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
        const isEdit = $(form).find('input[name="_method"]').val() === 'PATCH';
        
        $.ajax({
            url: isEdit ? '/editExpense' : '/addExpense',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Close the modal
                    closeExpenseModal();
                    
                    // Fetch and update the expenses list and summary
                    fetchAndUpdateExpenses();
                    
                    // Show success message
                    showToast(isEdit ? 'Expense updated successfully' : 'Expense added successfully');
                } else {
                    // Display validation errors if any
                    if (response.errors) {
                        displayServerErrors(response.errors);
                    } else {
                        displayServerErrors(response.message || 'An error occurred');
                    }
                }
            },
            error: function(xhr) {
                let errorMessage = 'An error occurred';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                displayServerErrors(errorMessage);
            }
        });
        
        return false; // Prevent default form submission
    }
});

function handleDeleteExpense() {
    const expenseId = $('#expenseForm input[name="id"]').val();
    if (expenseId) {
        openDeleteExpenseModal(expenseId);
        closeExpenseModal();
    }
}

function editExpense(expenseData) {
    // Show the delete button since we're editing an existing expense
    $('#deleteExpenseBtn').removeClass('hidden');
    
    // Set form to edit mode
    const form = $('#expenseForm');
    form.attr('action', '/editExpense');
    
    // Add method override for PATCH
    if (!form.find('input[name="_method"]').length) {
        form.append('<input type="hidden" name="_method" value="PATCH">');
    } else {
        form.find('input[name="_method"]').val('PATCH');
    }
    
    // Set expense ID
    if (!form.find('input[name="id"]').length) {
        form.append('<input type="hidden" name="id">');
    }
    form.find('input[name="id"]').val(expenseData.id);
    
    // Fill in the form fields
    form.find('input[name="expense_name"]').val(expenseData.expense_name);
    form.find('input[name="amount"]').val(expenseData.amount);
    form.find('input[name="date"]').val(expenseData.date);
    form.find('select[name="group_id"]').val(expenseData.group_id);
    
    // Update modal title
    $('#expenseModal h2').text('Edit Expense');
    
    // Show the modal
    openExpenseModal();
    
    // Clear any previous validation errors
    clearErrors();
}

function resetExpenseForm() {
    const form = $('#expenseForm');
    form.attr('action', '/addExpense');
    form.find('input[name="_method"]').val('POST');
    form.find('input[name="id"]').remove();
    form[0].reset();
    $('#expenseModal h2').text('Add Expense');
    $('#deleteExpenseBtn').addClass('hidden');
    clearErrors();
    
    // Set current date
    document.getElementById('expenseDate').value = getCurrentDate();
}

// Function to update expense modal dropdowns
function updateExpenseModalDropdowns() {
    $.ajax({
        url: '/getGroups',
        type: 'GET',
        success: function(groupsData) {
            // Update the groups dropdown in add expense modal
            const groupSelect = $('#groupSelect');
            // Update the groups dropdown in edit expense modal
            const editGroupSelect = $('#editExpenseGroup');
            
            // Clear existing options
            groupSelect.empty();
            editGroupSelect.empty();
            
            // Add default option
            groupSelect.append('<option value="">Select Group</option>');
            editGroupSelect.append('<option value="">Select Group</option>');
            
            // Add group options
            groupsData.forEach(group => {
                const option = `<option value="${group.id}">${group.name}</option>`;
                groupSelect.append(option);
                editGroupSelect.append(option);
            });
        },
        error: function() {
            showToast('Error fetching groups', 'error');
        }
    });
}

// Function to update expense summary
function updateExpenseSummary(summary) {
    // Update Lifetime Total
    $('.text-xl.font-semibold:contains("₹")').first().text(`₹${formatNumber(summary.totalExpense)}`);
    
    // Update This Month's Total
    $('.text-xl.font-semibold:contains("₹")').eq(1).text(`₹${formatNumber(summary.thisMonth)}`);
    
    // Update Highest Expense
    $('.text-xl.font-semibold:contains("₹")').last().text(`₹${formatNumber(summary.maxExpense)}`);
}

// Function to update expenses list
function updateExpensesList(expenses) {
    // Get the main expenses container
    const mainContainer = $('.lg\\:col-span-2 .bg-white.rounded-lg.shadow.overflow-hidden');
    if (!mainContainer.length) {
        console.error('Main expenses container not found');
        return;
    }

    // Get or create the content container
    const headerHtml = `
        <div class="p-6 border-b">
            <h2 class="text-lg font-medium text-gray-900">Recent Expenses</h2>
        </div>
    `;

    if (!expenses || expenses.length === 0) {
        mainContainer.html(`
            ${headerHtml}
            <div class="p-6 text-center text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="mt-2">No expenses yet. Click "Add Expense" to get started!</p>
            </div>
        `);
    } else {
        const expensesList = expenses.map(expense => `
            <div class="p-6 hover:bg-gray-50 flex items-center justify-between group">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">${escapeHtml(expense.expense_name)}</p>
                        <p class="text-sm text-gray-500">
                            Group: ${escapeHtml(expense.category_name)} • 
                            Date: ${formatDate(expense.date)}
                        </p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-lg font-medium text-gray-900">₹${formatNumber(expense.amount)}</span>
                    <div class="hidden group-hover:flex items-center space-x-2">
                        <button onclick="openEditExpenseModal(${expense.id}, '${escapeHtml(expense.expense_name)}', ${expense.amount}, '${expense.date}', ${expense.group_id})" 
                                class="text-gray-500 hover:text-blue-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </button>
                        <button onclick="openDeleteExpenseModal(${expense.id})" 
                                class="text-gray-500 hover:text-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        `).join('');

        mainContainer.html(`
            ${headerHtml}
            <div class="divide-y divide-gray-200">
                ${expensesList}
            </div>
        `);
    }
}

// Function to fetch and update expenses
function fetchAndUpdateExpenses() {
    $.ajax({
        url: '/getExpenses',
        method: 'GET',
        success: function(response) {
            if (response.success) {
                // Update the expenses list
                updateExpensesList(response.expenses);
                // Update the expense summary
                if (response.summary) {
                    updateExpenseSummary(response.summary);
                }
            }
        },
        error: function() {
            showToast('Failed to refresh expenses', 'error');
        }
    });
}

// Helper function to format numbers
function formatNumber(number) {
    return parseFloat(number).toLocaleString('en-IN', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

// Helper function to format dates
function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return date.toLocaleDateString('en-IN', options);
}

// Helper function to escape HTML
function escapeHtml(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}

// Helper function to show toast messages
function showToast(message, type = 'success') {
    const toast = $(`
        <div class="fixed bottom-4 right-4 px-6 py-3 rounded-lg text-white ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} shadow-lg">
            ${message}
        </div>
    `).appendTo('body');
    
    setTimeout(() => {
        toast.fadeOut(300, function() {
            $(this).remove();
        });
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