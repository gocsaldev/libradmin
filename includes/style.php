<style>
:root {
    --primary: #8b5e3c;
    --secondary: #d2b48c;
    --background: #f5f0e6;
    --text: #3b2f2f;
    --white: #ffffff;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--background);
    color: var(--text);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    position: relative; /* Creates stacking context */
    z-index: 1; /* Default stacking context for body */
}

header {
    background: var(--primary);
    color: var(--white);
    padding: 20px;
    text-align: center;
    font-size: 28px;
    font-weight: bold;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    position: relative;
    z-index: 1030; /* Adjusted to ensure it's below the modal and backdrop */
}

nav {
    background-color: var(--secondary);
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    padding: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    position: relative;
    z-index: 1030; /* Adjusted to ensure it's below the modal and backdrop */
    width: 100%;
    border-radius: 6px;
}

/* Modal and backdrop fixes */
.modal {
    position: fixed !important; /* Ensures it stays fixed */
    z-index: 1055 !important;   /* Ensures it's above all other elements */
    top: 50%;                  /* Centers modal vertically */
    left: 50%;                 /* Centers modal horizontally */
    transform: translate(-50%, -50%); /* Adjust position to center */
}

.modal-backdrop {
    position: fixed !important; /* Ensures backdrop covers entire screen */
    z-index: 1050 !important;   /* Ensures it's below the modal but above other elements */
    background-color: rgba(0, 0, 0, 0.5); /* Optional: Add a semi-transparent black backdrop */
}

#scrollToTop {
    position: fixed;
    bottom: 20px;
    right: 20px;
    display: none;
    background-color: #8b5e3c;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 100;
}

/* Keep your existing styles for other elements... */
nav a {
    background-color: rgba(255, 255, 255, 0.6);
    padding: 0.5rem 1rem;
    margin: 5px;
    border-radius: 5px;
    text-decoration: none;
    color: var(--primary);
    font-weight: bold;
    transition: background-color 0.3s;
    position: relative;
}

nav a:hover {
    background-color: var(--secondary);
    color: #fff;
}

nav a.active {
    background-color: #4a2f1b;
    color: #fff;
}

.card {
    background-color: white; 
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(138, 90, 0, 0.66);
    padding: 2rem;
    margin: auto;
    width: 100%;
    max-height: 690px;
    position: relative;
    z-index: 10;
}

.card-body {
    background-color: var(--background);
    overflow: scroll;
}

.card-container {
    display: flex;
    justify-content: center;
    padding: 20px;
}

button {
    background-color: #8b5e3c;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s, box-shadow 0.2s;
}

button:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

#scrollToTop {
    position: fixed;
    bottom: 20px;
    right: 20px;
    display: none;
    background-color: #8b5e3c;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 100;
}

.page-footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    background-color: #F8F9FA;
    text-align: center;
    padding: 10px 0;
    z-index: 20;
}

#index-card {
    background: var(--white);
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    text-align: center;
    max-width: 600px;
    width: 100%;
}

#index-card h1 {
    color: var(--primary);
    margin-bottom: 20px;
    font-size: 26px;
}

#index-card ul {
    list-style: none;
    padding: 0;
    margin-top: 20px;
}

#index-card ul li {
    margin-bottom: 15px;
}

#index-card ul li a {
    display: inline-block;
    background: var(--primary);
    color: var(--white);
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    transition: background 0.3s;
}

/* Mobile view styles */
@media (max-width: 768px) {
    nav {
        flex-direction: column;
        align-items: flex-start;
    }

    nav a {
        display: block;
        width: 100%;
    }

    nav ul {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 6px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        padding: 10px;
    }
}

#scrollToTop:hover {
    background-color: #d2b48c;
}

@media (max-width: 600px) {
    nav {
        flex-direction: column;
    }
}

</style>