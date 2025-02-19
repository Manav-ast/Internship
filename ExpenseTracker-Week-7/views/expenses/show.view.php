<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

        <a href="/expenses" class="text-blue-500 hover:underline">Back to all expenses</a>
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
                        <tr>
                            <td class="py-2 px-4"><?= $expense['group_name'] ?></td>
                            <td class="py-2 px-4"><?= $expense['name'] ?></td>
                            <td class="py-2 px-4"><span>&#8377; </span><?= $expense['amount'] ?></td>
                            <td class="py-2 px-4"><?= $expense['created_at'] ?></td>
                            <td class="py-2 px-4 text-center grid gap-1 grid-cols-2">
                                <a href="/expense/edit?id=<?= $expense['id'] ?>" class="text-blue-500 hover:underline">Update</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>