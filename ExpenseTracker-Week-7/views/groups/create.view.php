<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="flex justify-center items-start min-h-screen mt-10">
        <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg">
            <form method="POST" action="/groups">
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Group Name</label>
                        <input type="text" id="name" name="name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 text-left" placeholder="Enter group name...">
                            <?= $_POST['name'] ?? '' ?>
                        </input>
                        <?php if (isset($errors['name'])) : ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['name'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700">Create</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
