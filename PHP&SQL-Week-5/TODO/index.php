<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl">
        <h1 class="text-2xl font-bold text-center mb-4">To-Do List</h1>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <input type="text" id="todoInput" placeholder="Enter a task" class="w-full border p-2 rounded-lg">
            <button id="addTaskButton" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Add</button>
        </div>
        <div id="taskCounters" class="grid grid-cols-3 gap-4 mb-4 text-center">
            <p>Total: <span id="totalTasks">0</span></p>
            <p>Open: <span id="openTasks">0</span></p>
            <p>Completed: <span id="completedTasks">0</span></p>
        </div>
        <ul id="todoList" class="list-none space-y-2"></ul>
    </div>

    <script>
        $(document).ready(function () {
            function fetchTasks() {
                $.get('/php/fetch_tasks.php', function (data) {
                    const tasks = JSON.parse(data);
                    $('#todoList').empty();
                    let total = tasks.length;
                    let completed = tasks.filter(t => t.completed == 1).length;
                    let open = total - completed;

                    $('#totalTasks').text(total);
                    $('#openTasks').text(open);
                    $('#completedTasks').text(completed);

                    tasks.forEach(task => {
                        const li = $('<li></li>').addClass(`flex justify-between items-center border p-2 rounded-lg ${task.completed == 1 ? 'bg-green-100' : 'bg-white'}`);
                        const taskDetails = $('<div></div>').addClass('flex-1').append(
                            $('<span></span>').text(task.text).addClass(task.completed == 1 ? 'line-through text-gray-500' : '')
                        );

                        const completeButton = $('<button></button>')
                            .text(task.completed == 1 ? 'Undo' : 'Complete')
                            .addClass(`bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 ${task.completed == 1 ? 'bg-yellow-500 hover:bg-yellow-600' : ''}`)
                            .on('click', function () {
                                $.post('/php/update_task.php', { id: task.id }, function () {
                                    fetchTasks();
                                });
                            });

                        const deleteButton = $('<button></button>').text('Delete')
                            .addClass('bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600')
                            .on('click', function () {
                                $.post('/php/delete_task.php', { id: task.id }, function () {
                                    fetchTasks();
                                });
                            });

                        li.append(taskDetails, completeButton, deleteButton);
                        $('#todoList').append(li);
                    });
                });
            }

            $('#addTaskButton').on('click', function () {
                const taskText = $('#todoInput').val().trim();
                if (!taskText) return;

                $.post('/php/add_task.php', { text: taskText }, function () {
                    $('#todoInput').val('');
                    fetchTasks();
                });
            });

            fetchTasks();
        });
    </script>
</body>
</html>
