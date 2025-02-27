        const taskForm = document.getElementById('taskForm');
        const taskInput = document.getElementById('taskInput');
        const taskList = document.getElementById('taskList');

        taskForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (taskInput.value.trim()) {
                addTask(taskInput.value);
                taskInput.value = '';
            }
        });

        function addTask(taskText) {
            const li = document.createElement('li');
            li.innerHTML = `
                <span>${taskText}</span>
                <button class="deleteBtn">Delete</button>
            `;
            li.querySelector('.deleteBtn').addEventListener('click', function() {
                li.remove();
            });
            taskList.appendChild(li);
        }