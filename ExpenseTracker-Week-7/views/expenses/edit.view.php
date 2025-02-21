<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="flex justify-center items-start min-h-screen mt-10">
        <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg">
            <form id="expense-form" action="/expense" method="POST">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="<?= $expense['id'] ?>">
                <div class="space-y-4">
                    <div>
                        <label for="expense-group" class="block text-sm font-medium text-gray-700 mb-1">Expense Group</label>
                        <select id="expense-group" name="group_id" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select Expense Group</option>
                            <?php foreach ($groups as $group) : ?>
                                <option value="<?= $group['id'] ?>" <?= $expense['group_id'] == $group['id'] ? 'selected' : '' ?>>
                                    <?= $group['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors['group_id'])): ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['group_id'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="expense-name" class="block text-sm font-medium text-gray-700 mb-1">Expense Name</label>
                        <input type="text" id="expense-name" name="name" class="w-full p-2 border border-gray-300 rounded" placeholder="Expense Name" value="<?= $expense['name'] ?>">
                        <?php if (!empty($errors['name'])): ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['name'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="expense-amount" class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                        <input type="number" id="expense-amount" name="amount" class="w-full p-2 border border-gray-300 rounded" placeholder="Amount" value="<?= $expense['amount'] ?>">
                        <?php if (!empty($errors['amount'])): ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['amount'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="expense-date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" id="expense-date" name="date" class="w-full p-2 border border-gray-300 rounded" value="<?= $expense['created_at'] ?>">
                        <?php if (!empty($errors['date'])): ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['date'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="bg-gray-800 text-white font-bold py-2 px-4 rounded hover:bg-gray-600">Update Expense</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
