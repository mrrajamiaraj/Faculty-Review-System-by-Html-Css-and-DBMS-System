document.addEventListener("DOMContentLoaded", () => {
    // Fetch data from the PHP file
    fetch("total-teachers.php")
        .then((response) => response.json())
        .then((data) => {
            // Display total teachers
            document.getElementById("total-teachers").innerText = data.total_teachers;

            // Populate teachers list
            const teachersList = document.getElementById("teachers-list");
            data.teachers.forEach((teacher) => {
                const teacherBox = document.createElement("div");
                teacherBox.classList.add("teacher-box");

                teacherBox.innerHTML = `
                    <p><strong>ID:</strong> ${teacher.id}</p>
                    <p><strong>Name:</strong> ${teacher.name}</p>
                    <p><strong>Department:</strong> ${teacher.department}</p>
                `;

                teachersList.appendChild(teacherBox);
            });
        })
        .catch((error) => console.error("Error fetching teachers data:", error));
});
