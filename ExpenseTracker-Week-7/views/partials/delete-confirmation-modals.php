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
            <form id="deleteExpenseForm" method="POST" action="/deleteExpense" class="mt-4">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" id="deleteExpenseId">
                <div class="flex justify-center space-x-4">
                    <button type="button" onclick="closeDeleteExpenseModal()" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
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
        document.getElementById('deleteGroupId').value = groupId;
        document.getElementById('deleteGroupError').classList.add('hidden');
        document.getElementById('deleteGroupModal').classList.remove('hidden');
    }

    function closeDeleteGroupModal() {
        document.getElementById('deleteGroupModal').classList.add('hidden');
        document.getElementById('deleteGroupError').classList.add('hidden');
    }

    function openDeleteExpenseModal(expenseId) {
        document.getElementById('deleteExpenseId').value = expenseId;
        document.getElementById('deleteExpenseModal').classList.remove('hidden');
    }

    function closeDeleteExpenseModal() {
        document.getElementById('deleteExpenseModal').classList.add('hidden');
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
                        // Show success message
                        const successMessage = document.createElement('div');
                        successMessage.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50 animate-fade-in-up';
                        successMessage.textContent = response.message || 'Group deleted successfully!';
                        
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
                        closeDeleteGroupModal();
                        
                        // Redirect after a brief delay
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 1000);
                    } else {
                        // Show error message in modal
                        const errorDiv = document.getElementById('deleteGroupError');
                        errorDiv.textContent = response.message || 'Error deleting group';
                        errorDiv.classList.remove('hidden');
                    }
                },
                error: function() {
                    // Show error message in modal
                    const errorDiv = document.getElementById('deleteGroupError');
                    errorDiv.textContent = 'An error occurred while deleting the group';
                    errorDiv.classList.remove('hidden');
                }
            });
        });
    });
</script>
