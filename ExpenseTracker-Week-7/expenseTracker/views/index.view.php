<?php require base_path('views/partials/head.php') ?>


<div class="min-h-screen bg-gray-50">

    <!-- Navigation -->
    <div class="fixed top-0 left-0 right-0 z-10 bg-gray-50">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-semibold text-gray-900">Expense Tracker</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button onclick="openExpenseModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add Expense
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Stats Section -->
        <div class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Lifetime Total -->
                    <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Lifetime Total</p>
                                <p class="text-xl font-semibold text-gray-900">₹<?= number_format($totalExpense, 2) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- This Month's Total -->
                    <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">This Month</p>
                                <p class="text-xl font-semibold text-gray-900">₹<?= number_format($thisMonth, 2) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Highest Expense -->
                    <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Highest This Month</p>
                                <p class="text-xl font-semibold text-gray-900">₹<?= number_format($maxExpense, 2) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="pt-[calc(64px+160px)]">
        <main class="scroll-smooth overflow-y-scroll">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Sidebar - Groups -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-medium text-gray-900">Groups</h2>
                            <button onclick="openModal()" class="text-blue-600 hover:text-blue-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </button>
                        </div>
                        <div class="space-y-3">
                            <?php foreach ($groups as $group) : ?>
                                <div class="flex items-center justify-between py-2 px-3 bg-gray-50 rounded-lg group hover:bg-gray-100">
                                    <span class="text-gray-700"><?= htmlspecialchars($group['name']) ?></span>
                                    <div class="hidden group-hover:flex items-center space-x-2">
                                        <button onclick="openEditGroupModal(<?= $group['id'] ?>, '<?= htmlspecialchars($group['name']) ?>')" 
                                                class="text-gray-500 hover:text-blue-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                        </button>
                                        <button onclick="openDeleteGroupModal(<?= $group['id'] ?>)" 
                                                class="text-gray-500 hover:text-red-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
        
                    <!-- Main Content - Expenses List -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="p-6 border-b">
                                <h2 class="text-lg font-medium text-gray-900">Recent Expenses</h2>
                            </div>
                            
                            <?php if (empty($expenses)) : ?>
                                <div class="p-6 text-center text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    <p class="mt-2">No expenses yet. Click "Add Expense" to get started!</p>
                                </div>
                            <?php else : ?>
                                <div class="divide-y divide-gray-200">
                                    <?php foreach ($expenses as $expense) : ?>
                                        <div class="p-6 hover:bg-gray-50 flex items-center justify-between group">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0">
                                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($expense['expense_name']) ?></p>
                                                    <p class="text-sm text-gray-500">
                                                        Group: <?= htmlspecialchars($expense['category_name']) ?> • 
                                                        Date: <?= date('M j, Y', strtotime($expense['date'])) ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <span class="text-lg font-medium text-gray-900">₹<?= number_format($expense['amount'], 2) ?></span>
                                                <div class="hidden group-hover:flex items-center space-x-2">
                                                    <button onclick="openEditExpenseModal(<?= $expense['id'] ?>, '<?= htmlspecialchars($expense['expense_name']) ?>', <?= $expense['amount'] ?>, '<?= $expense['date'] ?>', <?= $expense['group_id'] ?>)" 
                                                            class="text-gray-500 hover:text-blue-600">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                        </svg>
                                                    </button>
                                                    <button onclick="openDeleteExpenseModal(<?= $expense['id'] ?>)" 
                                                            class="text-gray-500 hover:text-red-600">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</div>

<!-- Include Modals -->
<?php 
require base_path('views/expense/expense-modal.php');
require base_path('views/expense/editExpense-modal.php');
require base_path('views/group/group-modal.php');
require base_path('views/group/editGroup-modal.php');
require base_path('views/delete-confirmation-modals.php');
?>

<?php require base_path('views/partials/footer.php') ?>
