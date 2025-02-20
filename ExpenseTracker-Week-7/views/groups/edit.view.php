<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="flex justify-center items-start min-h-screen mt-10">
        <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg">
            <form method="POST" action="/group">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="<?= $group['id'] ?>">
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Group Name</label>
                        <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded text-left" placeholder="Enter group name..." value=" <?= $group['name'] ?? '' ?>">
                        </input>
                        <?php if (isset($errors['name'])) : ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors['name'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mt-4 flex justify-end space-x-4">
                    <a href="/groups" class="bg-gray-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-700">Cancel</a>
                    <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700">Update</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>