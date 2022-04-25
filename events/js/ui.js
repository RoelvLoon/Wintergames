const login = document.getElementById("login");
const logout = document.getElementById("logout");
const loginscreen = document.getElementById("loginscreen");
const mainscreen = document.getElementById("main");

function showColumns(username, token) {
    if (typeof login != "undefined" && login != null) {
        login.style.display = "none";
        logout.innerHTML += " (" + `${username}` + ")";
        logout.setAttribute("onclick", "signOut();");
        logout.style.display = "block";
        loginscreen.style.display = "none";
        mainscreen.style.display = "flex";
    } else if (typeof userdata != "undefined" && userdata != null) {
        logout.innerHTML += " (" + `${username}` + ")";
    } else {
        return;
    }
}

function chooseEvent(event){
    let main = document.getElementById("main");

    let schaatsbaan = document.getElementById("schaatsbaan");
    let curlingbaan = document.getElementById("curlingbaan");
    let skibaan = document.getElementById("skibaan");

    if(event === 'schaatsbaan'){

        main.style.display = "none";
        schaatsbaan.style.display =  "flex";
    
    }

    else if(event === 'curlingbaan'){

        main.style.display = "none";
        curlingbaan.style.display =  "flex";
    
    }

    else if(event === 'skibaan'){

        main.style.display = "none";
        skibaan.style.display =  "flex";
    
    }
}