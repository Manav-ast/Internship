<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="my-4">
            <a href="/groups" class="text-blue-500 hover:underline">Back to all groups</a>
        </p>
        <p class="mb-10"><?= htmlspecialchars($group['name']) ?> </p>

        <a href="/group/edit?id=<?= $group['id'] ?>" class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Edit</a>

        <!-- Delete Button to Open Modal -->
        <button onclick="openModal()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4">
            Delete
        </button>
    </div>
</main>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm">
        <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
        <p>Are you sure you want to delete this group?</p>
        <div class="mt-4 flex justify-end space-x-4">
            <button onclick="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
            <form action="" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="<?= $group['id'] ?>">
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById("deleteModal").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("deleteModal").classList.add("hidden");
    }
</script>

<?php require base_path('views/partials/footer.php') ?>
