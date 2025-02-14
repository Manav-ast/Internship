<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="my-4">
            <a href="/notes" class="text-blue-500 hover:underline">Back to all notes</a>
        </p>
        <p class="mb-10"><?= htmlspecialchars($note['body'])?> </p>

        <a href="/note/edit?id=<?= $note['id'] ?>" class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Edit</a>
        
        <form action="" method="POST" class="mt-4">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4" type="submit">
                Delete
            </button>
        </form>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>