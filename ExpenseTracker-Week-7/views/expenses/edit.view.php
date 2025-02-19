<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form id="expense-form" action="/expense" method="POST">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="id" value="<?= $expense['id'] ?>">
                    <select id="expense-group" name="group_id" class="w-full p-2 mb-4 border border-gray-300 rounded">
                        <option value="">Select Expense Group</option>
                        <?php foreach ($groups as $group) : ?>
                            <option value="<?php echo $group['id'] ?>"> <?= $group['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- <input type="hidden" name="group_id" value="<?= $group['id'] ?>"> -->
                    <input type="text" value="<?= $expense['name']?>" id="expense-name" name="name" class="w-full p-2 mb-4 border border-gray-300 rounded" placeholder="Expense Name">
                    <input type="number" value="<?= $expense['amount']?>" id="expense-amount" name="amount" class="w-full p-2 mb-4 border border-gray-300 rounded" placeholder="Amount">
                    <input type="date" id="expense-date" value="<?= $expense['created_at']?>" name="date" class="w-full p-2 mb-4 border border-gray-300 rounded">
                    <button type="submit" class="w-full py-2 bg-green-500 text-white rounded hover:bg-green-600">Add Expense</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>