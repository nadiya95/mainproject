document.addEventListener('DOMContentLoaded', function() {
    const religionSelect = document.getElementById('religion');
    const sectSelect = document.getElementById('sects');
    const sectLabel = document.getElementById('sectLabel');

    const sectOptions = {
        islam: [
            'Sunni', 'Sunni (EK)', 'Sunni (AP)', 'Salafi', 'Shia', 'Other'
        ],
        hinduism: [
            'Shaiva', 'Shakta', 'Vaishnava', 'Smarta', 'Other'
        ],
        christianity: [
            'Catholic', 'Protestant', 'Orthodox', 'Anglican', 'Other'
        ]
    };
      
    religionSelect.addEventListener('change', function() {
        const selectedReligion = this.value;
        if (sectOptions[selectedReligion]) {
            sectLabel.style.display = 'block';
            sectSelect.style.display = 'block';
            sectSelect.innerHTML = '';
            sectOptions[selectedReligion].forEach(function(sect) {
                const option = document.createElement('option');
                option.value = sect.toLowerCase();
                option.textContent = sect;
                sectSelect.appendChild(option);
            });
        } else {
            sectLabel.style.display = 'none';
            sectSelect.style.display = 'none';
        }
    });
});

//fetch state
document.addEventListener('DOMContentLoaded', function() {
    const stateSelect = document.getElementById('state');
    const districtSelect = document.getElementById('district');

    // Fetch and populate states
    // fetch('fetch_states.php')
        // .then(response => response.text())
        // .then(data => {
        //     stateSelect.innerHTML = data; // Populate state dropdown
        // })
        // .catch(error => console.error('Error fetching states:', error));

    // Handle state change to fetch and populate districts
    stateSelect.addEventListener('change', function() {
        const state_name = this.value;
        if (state_name) {
            fetch('fetch_districts.php?state_name=' + state_name)
                .then(response => response.text())
                .then(data => {
                    districtSelect.innerHTML = data; // Populate district dropdown
                })
                .catch(error => console.error('Error fetching districts:', error));
        } else {
            districtSelect.innerHTML = '<option value="">Select District</option>'; // Clear district dropdown
        }
    });
});
//password validation
document.getElementById('password').addEventListener('submit',function(event){
    const password=document.getElementById('password').value;
    const confirmpass=document.getElementById('confirmPassword').value;
    if(password!==confirmpass)
    {
        alert("password and confirm password mismatch!");
        event.preventDefault();
    }
});

// age validation
document.getElementById('registrationForm').addEventListener('submit',function(event){
 const date=new Date(document.getElementById('dob').value);
 const age=new Date().getFullYear() -date.getFullYear();
 if(age<18){
    alert("You must be atleast 18 years old!");
    event.preventDefault();
    
 } 

});