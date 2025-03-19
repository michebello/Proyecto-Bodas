// Modal Functions
function openModal(modalId) {
    document.getElementById(modalId).style.display = "block";
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
    
    // Reset any alerts
    const alertElement = document.querySelector(`#${modalId} .alert`);
    if (alertElement) {
        alertElement.style.display = "none";
        alertElement.className = "alert";
        alertElement.textContent = "";
    }
    
    // Reset form if exists
    const formElement = document.querySelector(`#${modalId} form`);
    if (formElement) {
        formElement.reset();
    }
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modals = document.getElementsByClassName("modal");
    for (let i = 0; i < modals.length; i++) {
        if (event.target === modals[i]) {
            closeModal(modals[i].id);
        }
    }
};

// Handle form submissions
document.addEventListener("DOMContentLoaded", function() {
    // Login Form
    const loginForm = document.getElementById("login-form");
    if (loginForm) {
        loginForm.addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(loginForm);
            
            fetch("login.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const alertElement = document.getElementById("login-alert");
                alertElement.textContent = data.message;
                alertElement.style.display = "block";
                
                if (data.status === "success") {
                    alertElement.className = "alert alert-success";
                    setTimeout(function() {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        }
                    }, 1500);
                } else {
                    alertElement.className = "alert alert-danger";
                }
            })
            .catch(error => {
                document.getElementById("login-alert").textContent = "Error de conexión. Inténtalo de nuevo.";
                document.getElementById("login-alert").className = "alert alert-danger";
                document.getElementById("login-alert").style.display = "block";
            });
        });
    }
    
    // Signup Form
    const signupForm = document.getElementById("signup-form");
    if (signupForm) {
        signupForm.addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(signupForm);
            
            fetch("registro.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const alertElement = document.getElementById("signup-alert");
                alertElement.textContent = data.message;
                alertElement.style.display = "block";
                
                if (data.status === "success") {
                    alertElement.className = "alert alert-success";
                    setTimeout(function() {
                        closeModal('signup-modal');
                        openModal('login-modal');
                    }, 1500);
                } else {
                    alertElement.className = "alert alert-danger";
                }
            })
            .catch(error => {
                document.getElementById("signup-alert").textContent = "Error de conexión. Inténtalo de nuevo.";
                document.getElementById("signup-alert").className = "alert alert-danger";
                document.getElementById("signup-alert").style.display = "block";
            });
        });
    }
    
    // Create Wedding Form
    const createWeddingForm = document.getElementById("create-wedding-form");
    if (createWeddingForm) {
        createWeddingForm.addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(createWeddingForm);
            
            fetch("crear_boda.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const alertElement = document.getElementById("wedding-alert");
                alertElement.textContent = data.message;
                alertElement.style.display = "block";
                
                if (data.status === "success") {
                    alertElement.className = "alert alert-success";
                    setTimeout(function() {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        }
                    }, 1500);
                } else {
                    alertElement.className = "alert alert-danger";
                    // Si el error es que necesita iniciar sesión, redirigir al login después de mostrar el mensaje
                    if (data.redirect && data.redirect === '#login-modal') {
                        setTimeout(function() {
                            closeModal('create-wedding-modal');
                            openModal('login-modal');
                        }, 1500);
                    }
                }
            })
            .catch(error => {
                document.getElementById("wedding-alert").textContent = "Error de conexión. Inténtalo de nuevo.";
                document.getElementById("wedding-alert").className = "alert alert-danger";
                document.getElementById("wedding-alert").style.display = "block";
            });
        });
    }
    
    // Filter buttons for providers
    const filterButtons = document.querySelectorAll('.filter-btn');
    if (filterButtons.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                // Aquí iría el código para filtrar proveedores
                // Por ahora solo cambiamos la clase activa
            });
        });
    }
});
