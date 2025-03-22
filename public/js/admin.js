document.addEventListener("DOMContentLoaded", function () {
    loadGuides(); // Load guides initially

    // Show add guide form
    window.showAddGuideForm = function () {
        document.getElementById('add-guide-form').style.display = 'block';
    }

    function loadAdminSection(section) {
        fetch(`/admin/${section}`)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.text();
            })
            .then(data => {
                document.getElementById('dashboard-section').innerHTML = data;
    
                // Count update after load
                if (section === 'users') {
                    fetch('/admin/users/guides-count')
                        .then(res => res.json())
                        .then(data => document.getElementById('guide-count').innerText = data.total);
    
                    fetch('/admin/users/tourists-count')
                        .then(res => res.json())
                        .then(data => document.getElementById('tourist-count').innerText = data.total);
                }
            })
            .catch(error => {
                showToast('Failed to load section', 'error');
                console.error('Error loading section:', error);
            });
    }
    
    

    // Load guides dynamically
    function loadGuides() {
        fetch('/admin/users/guides')
            .then(response => response.json())
            .then(data => {
                let tableBody = document.getElementById("guides-body");
                tableBody.innerHTML = "";

                if (data.length > 0) {
                    document.getElementById("guides-table").style.display = "table";
                    document.getElementById("loading-guides").style.display = "none";
                } else {
                    document.getElementById("loading-guides").textContent = "No guides found.";
                }

                data.forEach(guide => {
                    let row = `<tr>
                        <td>${guide.name}</td>
                        <td>${guide.email}</td>
                        <td>${guide.experience || "N/A"}</td>
                        <td>
                            <button onclick="deleteGuide(${guide.id})">Remove</button>
                        </td>
                    </tr>`;
                    tableBody.innerHTML += row;
                });
            })
            
            .catch(err => {
                showToast('Error loading guides', 'error');
            });


    }

    // Submit new guide
    window.submitGuide = function () {
        let formData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value,
            password_confirmation: document.getElementById('password_confirmation').value,
            experience: document.getElementById('experience').value,
            certification: document.getElementById('certification').value,
        };

        fetch('/admin/users/guides', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            alert("Guide added successfully");
            loadGuides(); // Refresh guide list
        })
        .catch(err => {
            showToast('Error adding guide', 'error');
        });
        document.getElementById('guide-count').textContent = guides.length;


    }

    // Delete guide
    window.deleteGuide = function (id) {
        fetch(`/admin/users/guides/${id}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            alert("Guide removed successfully");
            loadGuides(); // Refresh list
        })
        .catch(err => {
            showToast('Error removing guide', 'error');
        });
        document.getElementById('guide-count').textContent = guides.length;


    }
});
