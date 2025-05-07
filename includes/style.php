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
  }

  header {
    background: var(--primary);
    color: var(--white);
    padding: 20px;
    text-align: center;
    font-size: 28px;
    font-weight: bold;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  }
  nav {
    background: var(--secondary);
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    padding: 10px 0;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }

        nav a {
            text-decoration: none;
            color: var(--primary);
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        nav a:hover {
            background-color: var(--secondary);
            color: #fff;
        }
        nav a.active {
            background-color: #4a2f1b;
            color: #fff;
        }
        
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
        }

        .card {
            background-color: white; 
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(138, 90, 0, 0.66);
            padding: 2rem;
            margin: auto;
            width: 100%;
            max-height: 690px;
           
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
}

.page-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: #F8F9FA;
        text-align: center;
        padding: 10px 0;
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

    </style>