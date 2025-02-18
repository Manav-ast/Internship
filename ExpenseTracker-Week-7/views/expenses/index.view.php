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
                                    <form action="" method="POST">
                                        <input type="hidden" name="_method" value="PATCH">
                                        <input type="hidden" name="id" value="<?= $exp['id'] ?>">
                                        <button class="text-blue-500 hover:underline" type="submit">
                                            Update
                                        </button>
                                    </form>
                                    <form action="" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="<?= $exp['id'] ?>">
                                        <button class="text-red-500 hover:underline" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>