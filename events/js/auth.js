const msalConfig = {
    auth: {
        clientId: "dfb21e6e-2772-4972-8ba3-f68cbf20dbc0",
        authority: "https://login.microsoftonline.com/69f77188-635e-4aa6-8794-339171ab04f8",
        redirectUri: "https://wintergames.sd-lab.nl/events",
    },
    cache: {
        cacheLocation: "sessionStorage", // This configures where your cache will be stored
        storeAuthStateInCookie: false, // Set this to "true" if you are having issues on IE11 or Edge
    },
    system: {	
        loggerOptions: {	
            loggerCallback: (level, message, containsPii) => {	
                if (containsPii) {		
                    return;		
                }		
                switch (level) {		
                    case msal.LogLevel.Error:		
                        return;		
                    case msal.LogLevel.Info:		
                        return;		
                    case msal.LogLevel.Verbose:	
                        return;		
                    case msal.LogLevel.Warning:	
                        return;		
                }	
            }	
        }	
    }
};

const loginRequest = {
    scopes: ["User.Read"]
};

const tokenRequest = {
    scopes: ["User.Read"],
    forceRefresh: false
};

const myMSALObj = new msal.PublicClientApplication(msalConfig);

let username = "";

myMSALObj.handleRedirectPromise()
    .then(handleResponse)
    .catch((error) => {
        console.error(error);
    });

function selectAccount () {
    const currentAccounts = myMSALObj.getAllAccounts();

    if (currentAccounts.length === 0) {
        return;
    } else if (currentAccounts.length > 1) {
        // Add your account choosing logic here
        console.warn("Multiple accounts detected.");
    } else if (currentAccounts.length === 1) {
        username = currentAccounts[0].username;
        showColumns(username);
    }
}

function handleResponse(response) {
    if (response !== null) {
        username = response.account.username;
        showColumns(username);
    } else {
        selectAccount();
    }
}

function signIn() {
    myMSALObj.loginRedirect(loginRequest);
}

function signOut() {
    const logoutRequest = {
        account: myMSALObj.getAccountByUsername(username),
        postLogoutRedirectUri: msalConfig.auth.redirectUri,
    };

    myMSALObj.logoutRedirect(logoutRequest);
}

function getTokenRedirect(request) {
    request.account = myMSALObj.getAccountByUsername(username);

    return myMSALObj.acquireTokenSilent(request)
        .catch(error => {
            console.warn("silent token acquisition fails. acquiring token using redirect");
            if (error instanceof msal.InteractionRequiredAuthError) {
                // fallback to interaction when silent call fails
                return myMSALObj.acquireTokenRedirect(request);
            } else {
                console.warn(error);   
            }
        });
}

function inschrijven(activity) {
    var formData = new FormData();
    formData.append("user", username);
    formData.append("activity", activity);
    formData.append("time", document.getElementById(activity + "SelectBox").value);

    if (document.getElementById(activity + "SelectBox").value === "tijdslot") {
        alert("Er is geen tijdslot geselecteerd...")
        return
    }

    if (activity === "schaatsbaan") {
        if (confirm("Weet je zeker dat je wilt schaatsen van " + document.getElementById(activity + "SelectBox").value + "?")) {
            go();
        } else {
            alert("Inschrijving geannuleerd.")
        }
    } else if (activity === "curlingbaan") {
        if (confirm("Weet je zeker dat je wilt curlen van " + document.getElementById(activity + "SelectBox").value + "?")) {
            go();
        } else {
            alert("Inschrijving geannuleerd.")
        }
    } else if (activity === "skibaan") {
        if (confirm("Weet je zeker dat je wilt skiën van " + document.getElementById(activity + "SelectBox").value + "?")) {
            go();
        } else {
            alert("Inschrijving geannuleerd.")
        }
    } else {
        alert("Ongeldige aanvraag...")
        window.location.reload(true);
    }

    function go() {
        fetch("https://wintergames.sd-lab.nl/events/api/register.php", {
            body: formData,
            method: "post",
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            window.location.reload(true);
        });
    }
}