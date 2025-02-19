<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mt-4">
            <a href="/expenses/create" class="text-blue-500 hover:underline">Add Expense</a>
        </p>
        <!-- Expenses Table -->
        <div class="overflow-x-auto mt-4 max-h-72">
            <div id="group-expenses-container">
                <table class="min-w-full bg-gray-100 border border-gray-300 rounded-lg mt-2 overflow-hidden">
                    <thead>
                        <tr class="bg-green-500 text-white rounded-t-lg">
                            <th class="py-2 px-4 text-left">Group Name</th>
                            <th class="py-2 px-4 text-left">Expense Name</th>
                            <th class="py-2 px-4 text-left">Amount</th>
                            <th class="py-2 px-4 text-left">Date</th>
                            <th class="py-2 px-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="rounded-b-lg">
                        <!-- Expense rows will be dynamically added here -->
                        <?php foreach ($expenses as $exp): ?>
                            <tr>
                                <td class="py-2 px-4"><?= $exp['group_name'] ?></td>
                                <td class="py-2 px-4"><?= $exp['name'] ?></td>
                                <td class="py-2 px-4"><span>&#8377; </span><?= $exp['amount'] ?></td>
                                <td class="py-2 px-4"><?= $exp['created_at'] ?></td>
                                <td class="py-2 px-4 text-center grid gap-1 grid-cols-2">
                                    <a href="/expense?id=<?= $exp['id'] ?>" class="text-blue-500 hover:underline">Update</a>
                                    <button onclick="openModal(<?= $exp['id'] ?>)" class="text-red-500 hover:underline">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm">
        <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
        <p>Are you sure you want to delete this expense?</p>
        <div class="mt-4 flex justify-end space-x-4">
            <button onclick="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
            <form id="deleteForm" action="" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" id="expenseId">
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(expenseId) {
        document.getElementById("expenseId").value = expenseId;
        document.getElementById("deleteModal").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("deleteModal").classList.add("hidden");
    }
</script>

<?php require base_path('views/partials/footer.php') ?>
