<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form id="expense-form" action="/expenses" method="POST">
                    <select id="expense-group" name="group_id" class="w-full p-2 mb-4 border border-gray-300 rounded">
                        <option value="">Select Expense Group</option>
                        <?php foreach ($groups as $group) : ?>
                            <option value="<?= $group['id'] ?>" <?= isset($_POST['group_id']) && $_POST['group_id'] == $group['id'] ? 'selected' : '' ?>>
                                <?= $group['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (!empty($errors['group_id'])): ?>
                        <p class="text-red-500 text-sm"><?= $errors['group_id'] ?></p>
                    <?php endif; ?>

                    <input type="text" id="expense-name" name="name" class="w-full p-2 mb-4 border border-gray-300 rounded" placeholder="Expense Name" value="<?= $_POST['name'] ?? '' ?>">
                    <?php if (!empty($errors['name'])): ?>
                        <p class="text-red-500 text-sm"><?= $errors['name'] ?></p>
                    <?php endif; ?>

                    <input type="number" id="expense-amount" name="amount" class="w-full p-2 mb-4 border border-gray-300 rounded" placeholder="Amount" value="<?= $_POST['amount'] ?? '' ?>">
                    <?php if (!empty($errors['amount'])): ?>
                        <p class="text-red-500 text-sm"><?= $errors['amount'] ?></p>
                    <?php endif; ?>

                    <input type="date" id="expense-date" name="created_at" class="w-full p-2 mb-4 border border-gray-300 rounded" value="<?= $_POST['created_at'] ?? '' ?>">
                    <?php if (!empty($errors['created_at'])): ?>
                        <p class="text-red-500 text-sm"><?= $errors['created_at'] ?></p>
                    <?php endif; ?>

                    <button type="submit" class="w-full py-2 bg-green-500 text-white rounded hover:bg-green-600">Add Expense</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
