<!-- Delete Group Confirmation Modal -->
<div id="deleteGroupModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full" role="dialog">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Delete Group</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">Are you sure you want to delete this group? This action cannot be undone.</p>
            </div>
            <div id="deleteGroupError" class="mt-2 text-sm text-red-600 hidden"></div>
            <form id="deleteGroupForm" method="POST" action="/deleteGroup" class="mt-4">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" id="deleteGroupId">
                <div class="flex justify-center space-x-4">
                    <button type="button" onclick="closeDeleteGroupModal()" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Expense Confirmation Modal -->
<div id="deleteExpenseModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full" role="dialog">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Delete Expense</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">Are you sure you want to delete this expense? This action cannot be undone.</p>
            </div>
            <div id="deleteExpenseError" class="mt-2 text-sm text-red-600 hidden"></div>
            <form id="deleteExpenseForm" method="POST" action="/deleteExpense" class="mt-4">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" id="deleteExpenseId">
                <div class="flex justify-center space-x-4">
                    <button type="button" onclick="closeDeleteExpenseModal()" class="px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteGroupModal(groupId) {
        $('#deleteGroupId').val(groupId);
        $('#deleteGroupError').addClass('hidden');
        $('#deleteGroupModal').removeClass('hidden');
    }

    function closeDeleteGroupModal() {
        $('#deleteGroupModal').addClass('hidden');
        $('#deleteGroupError').addClass('hidden');
    }

    function openDeleteExpenseModal(expenseId) {
        $('#deleteExpenseId').val(expenseId);
        $('#deleteExpenseError').addClass('hidden');
        $('#deleteExpenseModal').removeClass('hidden');
    }

    function closeDeleteExpenseModal() {
        $('#deleteExpenseModal').addClass('hidden');
    }

    // Handle delete group form submission
    $(document).ready(function() {
        $('#deleteGroupForm').on('submit', function(e) {
            e.preventDefault();
            
            const formData = $(this).serialize();
            
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Close the modal
                        closeDeleteGroupModal();
                        
                        // Update expense modal dropdowns
                        updateExpenseModalDropdowns();
                        
                        // Show success message using jQuery
                        const $successMessage = $('<div>')
                            .addClass('fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50 animate-fade-in-up')
                            .text(response.message || 'Group deleted successfully!');
                        
                        $('body').append($successMessage);
                        
                        // Remove success message after 3 seconds
                        setTimeout(() => {
                            $successMessage.remove();
                        }, 3000);

                        // Update both groups list and expenses
                        $.ajax({
                            url: '/getGroups',
                            type: 'GET',
                            success: function(groupsData) {
                                // Update groups in sidebar
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

                                // Update expense form group select
                                const groupSelect = $('#group_id');
                                if (groupSelect.length) {
                                    groupSelect.empty();
                                    groupSelect.append('<option value="">Select Category</option>');
                                    groupsData.forEach(group => {
                                        groupSelect.append(`<option value="${group.id}">${group.name}</option>`);
                                    });
                                }
                            }
                        });

                        // Update expenses list
                        fetchAndUpdateExpenses();
                    } else {
                        // Show error message using jQuery
                        $('#deleteGroupError')
                            .text(response.message || 'An error occurred while deleting the group.')
                            .removeClass('hidden');
                    }
                },
                error: function() {
                    $('#deleteGroupError')
                        .text('An error occurred while deleting the group. Please try again.')
                        .removeClass('hidden');
                }
            });
        });
    });

    $('#deleteExpenseForm').on('submit', function(e) {
            e.preventDefault();
            
            const formData = $(this).serialize();
            
            $.ajax({
                url: '/deleteExpense',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        // Close the delete modal
                        closeDeleteExpenseModal();
                        
                        // Update the expenses list and summary
                        fetchAndUpdateExpenses();
                        
                        // Show success message
                        showToast('Expense deleted successfully');
                    } else {
                        // Show error in the modal using jQuery
                        $('#deleteExpenseError')
                            .text(response.message || 'Failed to delete expense')
                            .removeClass('hidden');
                    }
                },
                error: function() {
                    // Show error in the modal using jQuery
                    $('#deleteExpenseError')
                        .text('An error occurred while deleting the expense')
                        .removeClass('hidden');
                }
            });
        });

    // Toast notification function (if not already defined elsewhere)
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
