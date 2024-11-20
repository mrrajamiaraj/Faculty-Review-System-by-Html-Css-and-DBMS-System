document.addEventListener("DOMContentLoaded", () => {
    fetch("total-students.php")
        .then(response => response.json())
        .then(data => {
            // Update total students
            document.getElementById("total-students").textContent = data.total_students;

            // Populate student list
            const studentsList = document.getElementById("students-list");
            data.students.forEach(student => {
                const studentBox = document.createElement("div");
                studentBox.className = "student-box";
                studentBox.innerHTML = `
                    <p><strong>ID:</strong> ${student.id}</p>
                    <p><strong>Name:</strong> ${student.name}</p>
                    <p><strong>Department:</strong> ${student.department}</p>
                `;
                studentsList.appendChild(studentBox);
            });
        })
        .catch(error => console.error("Error fetching data:", error));
});
