document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            tabButtons.forEach(btn => btn.classList.remove('active'));

            // Hide all tab contents
            tabContents.forEach(content => content.style.display = 'none');

            // Show the clicked tab content
            const targetTab = this.getAttribute('data-tab');
            document.getElementById(`${targetTab}-content`).style.display = 'block';

            // Add active class to the clicked button
            this.classList.add('active');
        });
    });

    // Example function to load profiles
    function loadProfiles() {
        // Load received and sent profiles (to be implemented)
    }

    loadProfiles();
});
