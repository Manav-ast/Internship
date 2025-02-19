<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:space-x-4 mb-6">
            <div class="flex-1 p-4 bg-gray-100 rounded-lg text-center mb-4 sm:mb-0">
                <p class="text-sm">Lifetime Expenses (&#8377;) :</p>

                <span id="lifetime-expenses" class="font-semibold text-lg"><?= $total[0]['total'] ?? '0' ?></span>
            </div>
            <div class="flex-1 p-4 bg-gray-100 rounded-lg text-center mb-4 sm:mb-0">
                <p class="text-sm">Total this Month (&#8377;) :</p>
                <span id="total-expenses" class="font-semibold text-lg"><?= $monthTotal[0]['monthTotal'] ?? '0' ?></span>
            </div>
            <div class="flex-1 p-4 bg-gray-100 rounded-lg text-center">
                <p class="text-sm">Highest this Month (&#8377;) :</p>
                <span id="highest-expense" class="font-semibold text-lg"><?= $maxExpense[0]['maxExpense'] ?? '0' ?></span>
            </div>
        </div>

        <!-- Group-Wise Total Expenses Table -->
        <div class="overflow-x-auto mt-4 max-h-72">
            <div id="group-total-container">
                <table class="min-w-full bg-gray-100 border border-gray-300 rounded-lg mt-2 overflow-hidden">
                    <thead>
                        <tr class="bg-green-500 text-white rounded-t-lg">
                            <th class="py-2 px-4 text-left">Group Name</th>
                            <th class="py-2 px-4 text-left">Total Expenses</th>
                        </tr>
                    </thead>
                    <tbody class="rounded-b-lg">
                        <?php foreach ($group_totals as $group) : ?>
                            <tr>
                                <td class="py-2 px-4"><?= $group['group_name'] ?></td>
                                <td class="py-2 px-4"><span>&#8377; </span><?= $group['total_expense'] ?: 0 ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php require('partials/footer.php') ?>