<!-- model to open add-group popup -->
<div id="groupModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <!-- Modal Box -->
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Add Group</h2>
        <form id="addGroupForm" action="/addGroup" method="POST">
            <input type="text" name="group_name" placeholder="Enter group name" class="w-full p-2 border rounded-lg mb-4">
            <div class="flex justify-end">
                <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- script to open group model -->
<script>
function openModal() {
    document.getElementById('groupModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('groupModal').classList.add('hidden');
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
                        successMessage.textContent = 'Group added successfully!';
                        document.body.appendChild(successMessage);
                        
                        // Close modal
                        closeModal();
                        
                        // Redirect after a brief delay to show the message
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 1000);
                    } else {
                        // Handle errors
                        alert('Error adding group: ' + response.errors.general);
                    }
                }
            });
            
            return false;
        }
    });
});
</script>