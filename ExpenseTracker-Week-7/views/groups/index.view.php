<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mt-4">
            <a href="/groups/create" class="text-blue-500 hover:bg-gray-800 hover:text-white font-bold py-2 px-4 rounded mt-4">
                <i class="fa-solid fa-plus"></i> Create Group
            </a>
        </p>

        <!-- Groups Table -->
        <div class="overflow-x-auto mt-4 max-h-72">
            <div id="groups-container">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg mt-2 overflow-hidden">
                    <thead>
                        <tr class="bg-gray-800 text-white rounded-t-lg">
                            <th class="py-2 px-4 text-left">Group Name</th>
                            <th class="py-2 px-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="rounded-b-lg">
                        <?php foreach ($groups as $group): ?>
                            <tr>
                                <td class="py-2 px-4">
                                    <?= htmlspecialchars($group['name']) ?>
                                </td>
                                <td class="py-2 px-4 text-center flex justify-center gap-8">
                                    <a href="/group/edit?id=<?= $group['id'] ?>" class="text-gray-800 hover:text-gray-500">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="openGroupModal(<?= $group['id'] ?>)" class="text-red-500 hover:text-red-800">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Delete Confirmation Modal for Groups -->
<div id="deleteGroupModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm">
        <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
        <p>Are you sure you want to delete this group?</p>
        <div class="mt-4 flex justify-end space-x-4">
            <button onclick="closeGroupModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
            <form id="deleteForm" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" id="groupId">
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
            </form>
        </div>
    </div>
</div>

<script>
    function openGroupModal(groupId) {
        document.getElementById("groupId").value = groupId;
        document.getElementById("deleteForm").action = "/group?id=" + groupId;
        document.getElementById("deleteGroupModal").classList.remove("hidden");
    }

    function closeGroupModal() {
        document.getElementById("deleteGroupModal").classList.add("hidden");
    }
</script>

<?php require base_path('views/partials/footer.php') ?>